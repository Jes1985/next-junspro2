<?php

namespace App\Services\Junspro;

use App\Models\AuditLog;
use App\Models\NotificationLog;
use App\Models\WorkSession;
use Illuminate\Support\Facades\Log;

/**
 * Service de gestion des rectifications automatiques
 */
class RectificationService
{
    /**
     * Traiter une demande de rectification
     *
     * @param WorkSession $workSession
     * @param string $reason
     * @return array ['accepted' => bool, 'message' => string]
     */
    public function processRectificationRequest(WorkSession $workSession, string $reason): array
    {
        $subscription = $workSession->subscription;
        $maxRectifications = $subscription->max_rectifications_per_delivery ?? 2;

        $currentCount = $workSession->rectification_count ?? 0;

        if ($currentCount >= $maxRectifications) {
            // Refuser et proposer alternatives
            $this->notifyRectificationRefused($workSession, $reason);

            AuditLog::create([
                'user_id' => $subscription->client_id,
                'action_type' => 'rectification_refused',
                'entity_type' => 'work_session',
                'entity_id' => $workSession->id,
                'metadata' => [
                    'reason' => $reason,
                    'rectification_count' => $currentCount,
                    'max_allowed' => $maxRectifications,
                ],
            ]);

            return [
                'accepted' => false,
                'message' => "Nombre maximum de rectifications atteint ({$maxRectifications}). Options disponibles : facturation additionnelle ou transfert vers un autre freelance.",
            ];
        }

        // Accepter la rectification
        $workSession->rectification_count = $currentCount + 1;
        $workSession->status = 'rectification_requested';
        $workSession->save();

        $this->notifyRectificationAccepted($workSession, $reason);

        AuditLog::create([
            'user_id' => $subscription->client_id,
            'action_type' => 'rectification_requested',
            'entity_type' => 'work_session',
            'entity_id' => $workSession->id,
            'metadata' => [
                'reason' => $reason,
                'rectification_count' => $workSession->rectification_count,
            ],
        ]);

        Log::info('Rectification accepted', [
            'work_session_id' => $workSession->id,
            'rectification_count' => $workSession->rectification_count,
        ]);

        return [
            'accepted' => true,
            'message' => "Rectification acceptée ({$workSession->rectification_count}/{$maxRectifications}).",
        ];
    }

    /**
     * Notifier le freelance qu'une rectification a été acceptée
     */
    protected function notifyRectificationAccepted(WorkSession $workSession, string $reason): void
    {
        $freelancer = $workSession->freelancer;
        $freelancerUser = $freelancer->user ?? null;
        
        if ($freelancerUser) {
            NotificationLog::create([
                'user_id' => $freelancerUser->id,
                'channel' => 'email',
                'type' => 'rectification_requested',
                'content' => json_encode([
                    'work_session_id' => $workSession->id,
                    'subscription_id' => $workSession->subscription_id,
                    'reason' => $reason,
                    'rectification_count' => $workSession->rectification_count,
                ]),
                'sent_at' => now(),
            ]);
        }
    }

    /**
     * Notifier le client qu'une rectification a été refusée
     */
    protected function notifyRectificationRefused(WorkSession $workSession, string $reason): void
    {
        $subscription = $workSession->subscription;
        $client = $subscription->client;
        $clientUser = $client->user ?? null;

        if ($clientUser) {
            NotificationLog::create([
                'user_id' => $clientUser->id,
                'channel' => 'email',
                'type' => 'rectification_refused',
                'content' => json_encode([
                    'work_session_id' => $workSession->id,
                    'subscription_id' => $workSession->subscription_id,
                    'reason' => $reason,
                    'alternatives' => [
                        'additional_billing' => 'Facturation additionnelle possible',
                        'transfer' => 'Transfert vers un autre freelance possible',
                    ],
                ]),
                'sent_at' => now(),
            ]);
        }
    }
}

