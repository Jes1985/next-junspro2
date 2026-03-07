<?php

namespace App\Console\Commands;

use App\Services\Junspro\AffiliateService;
use Illuminate\Console\Command;

class AffiliateValidate extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'affiliate:validate
                            {--dry-run : Simuler sans appliquer les changements}';

    /**
     * The console command description.
     */
    protected $description = 'Valide les commissions affiliées en attente depuis plus de 7 jours (anti-fraude J+7)';

    /**
     * Execute the console command.
     */
    public function handle(AffiliateService $affiliateService): int
    {
        $dryRun = $this->option('dry-run');

        $this->info('🔍 Validation des commissions affiliées (J+7)...');

        if ($dryRun) {
            $this->warn('⚠  Mode dry-run : aucune modification ne sera appliquée.');
            $this->previewPending($affiliateService);
            return Command::SUCCESS;
        }

        $validated = $affiliateService->validatePendingConversions();

        if ($validated === 0) {
            $this->info('✓  Aucune commission à valider pour le moment.');
        } else {
            $this->info("✓  {$validated} commission(s) validée(s) avec succès.");
        }

        return Command::SUCCESS;
    }

    /**
     * Afficher un aperçu des conversions qui seraient validées (dry-run).
     */
    protected function previewPending(AffiliateService $affiliateService): void
    {
        $cutoff = now()->subDays(\App\Services\Junspro\AffiliateService::VALIDATION_DELAY_DAYS);

        $pending = \App\Models\AffiliateConversion::where('status', 'pending')
            ->where('created_at', '<=', $cutoff)
            ->with('affiliate.user')
            ->get();

        if ($pending->isEmpty()) {
            $this->info('  Aucune commission éligible à la validation.');
            return;
        }

        $this->table(
            ['ID', 'Affilié', 'Filleul ID', 'Montant €', 'Commission €', 'Créée le'],
            $pending->map(fn($c) => [
                $c->id,
                optional($c->affiliate->user)->email ?? "affiliate#{$c->affiliate_id}",
                $c->referred_user_id,
                number_format($c->transaction_amount, 2, ',', ' '),
                number_format($c->commission_amount, 2, ',', ' '),
                $c->created_at->format('d/m/Y H:i'),
            ])
        );

        $total = $pending->sum('commission_amount');
        $this->line('');
        $this->info(sprintf(
            '  Total à valider : %s commission(s) → <comment>%s€</comment>',
            $pending->count(),
            number_format($total, 2, ',', ' ')
        ));
    }
}
