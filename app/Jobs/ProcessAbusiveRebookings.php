<?php

namespace App\Jobs;

use App\Models\AuditLog;
use App\Models\NotificationLog;
use App\Models\Rebooking;
use App\Models\Subscription;
use App\Models\WorkSession;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessAbusiveRebookings implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $activeSubscriptions = Subscription::where('status', 'active')
            ->with(['freelancer.user', 'client.user', 'workSessions.rebooking'])
            ->get();

        foreach ($activeSubscriptions as $subscription) {
            $this->checkAbusiveRebookings($subscription);
        }
    }

    /**
     * Vérifier les reprogrammations abusives pour un abonnement
     */
    protected function checkAbusiveRebookings(Subscription $subscription): void
    {
        $workSessions = WorkSession::where('subscription_id', $subscription->id)
            ->whereHas('rebooking')
            ->with('rebooking')
            ->get();

        $rebookingCount = 0;
        $totalHours = $subscription->hours_per_week * 4; // Heures prévues sur 4 semaines

        foreach ($workSessions as $session) {
            if ($session->rebooking && $session->rebooking->approved) {
                $rebookingCount++;
            }
        }

        // Si plus d'1 reprogrammation par heure prévue → abusif
        if ($rebookingCount > $totalHours) {
            // Activer le transfert pour le client
            // Note: On pourrait ajouter un champ can_transfer sur Subscription si nécessaire
            // Pour l'instant, on notifie le client

            $clientUser = $subscription->client->user ?? null;
            if ($clientUser) {
                NotificationLog::create([
                    'user_id' => $clientUser->id,
                    'channel' => 'email',
                    'type' => 'abusive_rebookings_detected',
                    'content' => json_encode([
                        'subscription_id' => $subscription->id,
                        'freelancer_name' => $subscription->freelancer->user->name ?? 'N/A',
                        'rebooking_count' => $rebookingCount,
                        'total_hours' => $totalHours,
                    ]),
                    'sent_at' => now(),
                ]);
            }

            $clientUser = $subscription->client->user ?? null;
            if ($clientUser) {
                AuditLog::create([
                    'user_id' => $clientUser->id,
                    'action_type' => 'abusive_rebookings_detected',
                    'entity_type' => 'subscription',
                    'entity_id' => $subscription->id,
                    'metadata' => [
                        'rebooking_count' => $rebookingCount,
                        'total_hours' => $totalHours,
                    ],
                ]);
            }

            Log::warning('Abusive rebookings detected', [
                'subscription_id' => $subscription->id,
                'freelancer_id' => $subscription->freelancer_id,
                'rebooking_count' => $rebookingCount,
            ]);
        }
    }
}

