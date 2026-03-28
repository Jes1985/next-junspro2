<?php

namespace App\Console\Commands;

use App\Mail\PsMonthlyStatsMail;
use App\Models\PsAmbassadeur;
use App\Models\PsConversion;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Envoi des bilans mensuels à tous les ambassadeurs Pause Souffle actifs.
 *
 * Usage :
 *   php artisan ps:send-monthly-stats              → mois précédent
 *   php artisan ps:send-monthly-stats --month=2026-02   → mois spécifique
 *
 * Planifié automatiquement le 1er de chaque mois à 08:00 (Kernel.php)
 */
class PsSendMonthlyStats extends Command
{
    protected $signature   = 'ps:send-monthly-stats {--month= : Mois au format YYYY-MM (défaut : mois précédent)}';
    protected $description = 'Envoyer les bilans mensuels à tous les ambassadeurs Pause Souffle actifs';

    public function handle(): int
    {
        $monthInput = $this->option('month');
        $month      = $monthInput
            ? Carbon::createFromFormat('Y-m', $monthInput)->startOfMonth()
            : now()->subMonth()->startOfMonth();

        $monthLabel = $month->locale('fr')->translatedFormat('F Y');
        $start      = $month->copy()->startOfMonth();
        $end        = $month->copy()->endOfMonth();

        $ambassadeurs = PsAmbassadeur::where('status', 'active')->with('user')->get();

        $this->info("Envoi bilans {$monthLabel} → {$ambassadeurs->count()} ambassadeur(s)...");

        $sent = 0;

        foreach ($ambassadeurs as $amb) {
            if (!$amb->user || !$amb->user->email) {
                $this->warn("  ⚠ Ambassadeur #{$amb->id} sans email, ignoré.");
                continue;
            }

            // Stats du mois cible
            $monthConv = PsConversion::where('ambassadeur_id', $amb->id)
                ->whereBetween('created_at', [$start, $end])
                ->get();

            // Stats du mois précédent (pour comparaison)
            $prevStart = $start->copy()->subMonth();
            $prevConv  = PsConversion::where('ambassadeur_id', $amb->id)
                ->whereBetween('created_at', [$prevStart, $start])
                ->get();

            $clicksMonth = DB::table('ps_ambassador_clicks')
                ->where('ambassadeur_id', $amb->id)
                ->whereBetween('created_at', [$start, $end])
                ->count();

            $prevClicks = DB::table('ps_ambassador_clicks')
                ->where('ambassadeur_id', $amb->id)
                ->whereBetween('created_at', [$prevStart, $start])
                ->count();

            $monthlyStats = [
                'sales_count'      => $monthConv->whereIn('status', ['validated', 'paid'])->count(),
                'pending_count'    => $monthConv->where('status', 'pending')->count(),
                'commission_amt'   => round($monthConv->sum('commission_amount'), 2),
                'clicks_count'     => $clicksMonth,
                'prev_sales'       => $prevConv->whereIn('status', ['validated', 'paid'])->count(),
                'prev_commission'  => round($prevConv->sum('commission_amount'), 2),
                'prev_clicks'      => $prevClicks,
                'total_earned'     => (float) $amb->total_earned,
                'pending_payout'   => (float) $amb->pending_payout,
                'tier_label'       => $amb->tier_label,
                'tier_icon'        => $amb->tier_icon,
                'tracking_link'    => url('/ps/' . $amb->code),
                'ressources_url'   => route('ps.ressources'),
                'landing_url'      => route('presence.ambassadeurs'),
            ];

            try {
                Mail::to($amb->user->email)->send(
                    new PsMonthlyStatsMail($amb->user, $amb, $monthlyStats, $monthLabel)
                );
                $sent++;
                $this->line("  ✓ {$amb->user->email}");
            } catch (\Throwable $e) {
                Log::warning("[PsSendMonthlyStats] Échec envoi ambassadeur #{$amb->id}: {$e->getMessage()}");
                $this->warn("  ⚠ Échec {$amb->user->email} — {$e->getMessage()}");
            }
        }

        $this->info("Terminé : {$sent}/{$ambassadeurs->count()} emails envoyés.");

        return Command::SUCCESS;
    }
}
