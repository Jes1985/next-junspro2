<?php

namespace App\Services\Junspro;

use App\Models\TransferRequest;
use App\Models\Subscription;
use App\Models\ClientProfile;
use App\Models\FreelancerProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Service de gestion des transferts d'abonnement
 */
class TransferService
{
    protected SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Créer une demande de transfert
     *
     * @param ClientProfile $client
     * @param Subscription $subscription
     * @param FreelancerProfile $newFreelancer
     * @param string|null $reason
     * @return TransferRequest
     */
    public function createTransferRequest(
        ClientProfile $client,
        Subscription $subscription,
        FreelancerProfile $newFreelancer,
        ?string $reason = null
    ): TransferRequest {
        if ($subscription->client_id !== $client->id) {
            throw new \Exception("Cette abonnement n'appartient pas à ce client");
        }

        if ($subscription->freelancer_id === $newFreelancer->id) {
            throw new \Exception("Le nouveau freelance est le même que l'ancien");
        }

        return TransferRequest::create([
            'client_id' => $client->id,
            'old_freelancer_id' => $subscription->freelancer_id,
            'new_freelancer_id' => $newFreelancer->id,
            'subscription_id' => $subscription->id,
            'hours_transferred' => $subscription->hours_remaining,
            'reason' => $reason,
            'status' => 'pending',
        ]);
    }

    /**
     * Approuver un transfert
     *
     * @param TransferRequest $transferRequest
     * @return Subscription Nouvel abonnement créé
     */
    public function approveTransfer(TransferRequest $transferRequest): Subscription
    {
        if ($transferRequest->status !== 'pending') {
            throw new \Exception("Cette demande de transfert n'est plus en attente");
        }

        return DB::transaction(function () use ($transferRequest) {
            $oldSubscription = $transferRequest->subscription;
            $newFreelancer = $transferRequest->newFreelancer;

            // Créer un nouvel abonnement avec les heures transférées
            $newSubscription = Subscription::create([
                'client_id' => $transferRequest->client_id,
                'freelancer_id' => $newFreelancer->id,
                'hours_per_week' => $oldSubscription->hours_per_week,
                'hours_total_month' => $oldSubscription->hours_total_month,
                'hours_remaining' => $transferRequest->hours_transferred,
                'price_base' => $newFreelancer->hourly_rate * $oldSubscription->hours_per_week * 4,
                'delivery_mode' => $oldSubscription->delivery_mode,
                'status' => 'active',
                'stripe_subscription_id' => null, // À mettre à jour avec Stripe
                'next_billing_at' => $oldSubscription->next_billing_at,
            ]);

            // Annuler l'ancien abonnement
            $this->subscriptionService->cancelSubscription($oldSubscription);

            // Marquer le transfert comme approuvé
            $transferRequest->status = 'approved';
            $transferRequest->save();

            Log::info("Transfert approuvé", [
                'transfer_request_id' => $transferRequest->id,
                'old_subscription_id' => $oldSubscription->id,
                'new_subscription_id' => $newSubscription->id,
            ]);

            return $newSubscription;
        });
    }

    /**
     * Rejeter un transfert
     *
     * @param TransferRequest $transferRequest
     * @return TransferRequest
     */
    public function rejectTransfer(TransferRequest $transferRequest): TransferRequest
    {
        $transferRequest->status = 'rejected';
        $transferRequest->save();

        return $transferRequest;
    }
}

