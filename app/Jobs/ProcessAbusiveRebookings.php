<?php

namespace App\Jobs;

use App\Models\AuditLog;
use App\Models\NotificationLog;
use App\Models\Subscription;
use App\Models\WorkSession;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProcessAbusiveRebookings implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('[CRON] Début du traitement des reprogrammations abusives');

        // Récupérer toutes les subscriptions actives
        $activeSubscriptions = Subscription::where('status', 'active')
            ->with(['freelancer.user', 'workSessions'])
            ->get();

        foreach ($activeSubscriptions as $subscription) {
            $this->checkAbusiveRebookings($subscription);
        }

        Log::info('[CRON] Fin du traitement des reprogrammations abusives');
    }

    /**
     * Vérifier les reprogrammations abusives pour une subscription
     */
    protected function checkAbusiveRebookings(Subscription $subscription): void
    {
        $workSessions = $subscription->workSessions()
            ->where('status', 'delivered')
            ->orderBy('start_at', 'desc')
            ->get();

        // Grouper par heure prévue (basé sur hours_per_week)
        $hoursPerWeek = $subscription->hours_per_week;
        $expectedSessionsPerWeek = $hoursPerWeek; // 1 session = 1h

        // Vérifier les 4 dernières semaines
        $fourWeeksAgo = Carbon::now()->subWeeks(4);
        $recentSessions = $workSessions->filter(function ($session) use ($fourWeeksAgo) {
            return $session->start_at && $session->start_at->gte($fourWeeksAgo);
        });

        // Compter les reprogrammations (rebook_count > 0)
        $rebookedSessions = $recentSessions->filter(function ($session) {
            return ($session->rebook_count ?? 0) > 0;
        });

        // Si plus d'1 reprogrammation par heure prévue → abusif
        $rebookCount = $rebookedSessions->count();
        $expectedSessions = $expectedSessionsPerWeek * 4; // 4 semaines

        if ($rebookCount > $expectedSessions) {
            // Activer le transfert
            $subscription->update(['can_transfer' => true]);

            // Notifier le client
            $clientUser = $subscription->client->user ?? null;
            if ($clientUser) {
                NotificationLog::create([
                    'user_id' => $clientUser->id,
                    'channel' => 'email',
                    'type' => 'abusive_rebookings_detected',
                    'content' => json_encode([
                        'subscription_id' => $subscription->id,
                        'rebook_count' => $rebookCount,
                        'expected_sessions' => $expectedSessions,
                        'message' => 'Vous pouvez transférer votre projet à un autre freelance.',
                    ]),
                    'sent_at' => now(),
                ]);
            }

            // Audit log
            AuditLog::create([
                'user_id' => $clientUser->id ?? null,
                'action_type' => 'abusive_rebookings_detected',
                'entity_type' => 'subscription',
                'entity_id' => $subscription->id,
                'metadata' => [
                    'rebook_count' => $rebookCount,
                    'expected_sessions' => $expectedSessions,
                    'freelancer_id' => $subscription->freelancer_id,
                ],
            ]);

            Log::warning('Abusive rebookings detected', [
                'subscription_id' => $subscription->id,
                'rebook_count' => $rebookCount,
                'expected_sessions' => $expectedSessions,
            ]);
        }
    }
}
