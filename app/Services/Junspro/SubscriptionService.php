<?php

namespace App\Services\Junspro;

use App\Models\Subscription;
use App\Models\ClientProfile;
use App\Models\FreelancerProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Service de gestion des abonnements
 */
class SubscriptionService
{
    protected PlatformFeeService $platformFeeService;

    public function __construct(PlatformFeeService $platformFeeService)
    {
        $this->platformFeeService = $platformFeeService;
    }

    /**
     * Créer un nouvel abonnement
     *
     * @param ClientProfile $client
     * @param FreelancerProfile $freelancer
     * @param int $hoursPerWeek Valeurs autorisées: 1, 2, 3, 4, 5, 8
     * @param string $deliveryMode 'standard', 'express_24h', 'express_48h', 'express_72h'
     * @param string|null $stripeSubscriptionId
     * @return Subscription
     * @throws \InvalidArgumentException
     */
    public function createSubscription(
        ClientProfile $client,
        FreelancerProfile $freelancer,
        int $hoursPerWeek,
        string $deliveryMode = 'standard',
        ?string $stripeSubscriptionId = null
    ): Subscription {
        // Validation des heures/semaine
        $allowedHours = [1, 2, 3, 4, 5, 8];
        if (!in_array($hoursPerWeek, $allowedHours)) {
            throw new \InvalidArgumentException("hours_per_week doit être l'une des valeurs: " . implode(', ', $allowedHours));
        }

        // Calculs métier
        $hoursTotalMonth = $hoursPerWeek * 4;
        $priceBase = $freelancer->hourly_rate * $hoursPerWeek * 4;

        // Calcul du prix final avec Express
        $finalPrice = $this->calculateFinalPrice($priceBase, $deliveryMode);

        // Date de facturation suivante (dans 1 mois)
        $nextBillingAt = now()->addMonth();

        return DB::transaction(function () use (
            $client,
            $freelancer,
            $hoursPerWeek,
            $hoursTotalMonth,
            $priceBase,
            $deliveryMode,
            $stripeSubscriptionId,
            $nextBillingAt
        ) {
            $subscription = Subscription::create([
                'client_id' => $client->id,
                'freelancer_id' => $freelancer->id,
                'hours_per_week' => $hoursPerWeek,
                'hours_total_month' => $hoursTotalMonth,
                'hours_remaining' => $hoursTotalMonth,
                'price_base' => $priceBase,
                'delivery_mode' => $deliveryMode,
                'status' => 'active',
                'stripe_subscription_id' => $stripeSubscriptionId,
                'next_billing_at' => $nextBillingAt,
            ]);

            Log::info("Abonnement créé", [
                'subscription_id' => $subscription->id,
                'client_id' => $client->id,
                'freelancer_id' => $freelancer->id,
                'hours_per_week' => $hoursPerWeek,
            ]);

            return $subscription;
        });
    }

    /**
     * Calculer le prix final avec Express
     *
     * @param float $priceBase
     * @param string $deliveryMode
     * @return float
     */
    public function calculateFinalPrice(float $priceBase, string $deliveryMode): float
    {
        return match($deliveryMode) {
            'express_24h' => $priceBase * 1.30,
            'express_48h' => $priceBase * 1.20,
            'express_72h' => $priceBase * 1.10,
            default => $priceBase,
        };
    }

    /**
     * Consommer des heures d'un abonnement
     *
     * @param Subscription $subscription
     * @param float $hours
     * @return bool
     */
    public function consumeHours(Subscription $subscription, float $hours): bool
    {
        if ($subscription->hours_remaining < $hours) {
            return false;
        }

        $subscription->hours_remaining -= $hours;
        $subscription->save();

        return true;
    }

    /**
     * Renouveler l'abonnement (cycle mensuel)
     *
     * @param Subscription $subscription
     * @return Subscription
     */
    public function renewSubscription(Subscription $subscription): Subscription
    {
        if ($subscription->status !== 'active') {
            throw new \RuntimeException("Impossible de renouveler un abonnement non actif");
        }

        $subscription->hours_remaining = $subscription->hours_total_month;
        $subscription->next_billing_at = now()->addMonth();
        $subscription->save();

        return $subscription;
    }

    /**
     * Mettre en pause un abonnement
     *
     * @param Subscription $subscription
     * @return Subscription
     */
    public function pauseSubscription(Subscription $subscription): Subscription
    {
        $subscription->status = 'paused';
        $subscription->save();

        return $subscription;
    }

    /**
     * Reprendre un abonnement en pause
     *
     * @param Subscription $subscription
     * @return Subscription
     */
    public function resumeSubscription(Subscription $subscription): Subscription
    {
        if ($subscription->status !== 'paused') {
            throw new \RuntimeException("L'abonnement n'est pas en pause");
        }

        $subscription->status = 'active';
        $subscription->save();

        return $subscription;
    }

    /**
     * Annuler un abonnement
     *
     * @param Subscription $subscription
     * @return Subscription
     */
    public function cancelSubscription(Subscription $subscription): Subscription
    {
        $subscription->status = 'cancelled';
        $subscription->save();

        return $subscription;
    }
}

