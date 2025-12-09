<?php

namespace App\Services\Junspro;

use App\Models\Subscription;
use App\Models\ClientProfile;
use App\Models\FreelancerProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Config;

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
     * @param int $hoursPerWeek Valeurs autorisées: 1, 2, 4, 8, 12, 16, 20, 24
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
        $allowedHours = [1, 2, 4, 8, 12, 16, 20, 24];
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
                'status' => $stripeSubscriptionId ? 'active' : 'pending',
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
     * Créer une session Stripe Checkout pour l'abonnement
     *
     * @param ClientProfile $client
     * @param FreelancerProfile $freelancer
     * @param int $hoursPerWeek
     * @param string $deliveryMode
     * @param float $amount
     * @return \Stripe\Checkout\Session
     */
    public function createStripeCheckoutSession(
        ClientProfile $client,
        FreelancerProfile $freelancer,
        int $hoursPerWeek,
        string $deliveryMode,
        float $amount
    ): \Stripe\Checkout\Session {
        // Configurer Stripe
        $stripeSecret = $this->getStripeSecret();
        Stripe::setApiKey($stripeSecret);

        // Préparer les données de l'abonnement pour la session
        $subscriptionData = [
            'client_id' => $client->id,
            'freelancer_id' => $freelancer->id,
            'hours_per_week' => $hoursPerWeek,
            'delivery_mode' => $deliveryMode,
            'amount' => $amount,
        ];

        // Créer la session Stripe Checkout
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Abonnement Junspro - ' . $freelancer->user->first_name . ' ' . $freelancer->user->last_name,
                        'description' => sprintf(
                            '%dh/semaine - Mode: %s (4 semaines)',
                            $hoursPerWeek,
                            $this->getDeliveryModeLabel($deliveryMode)
                        ),
                    ],
                    'unit_amount' => (int)($amount * 100), // Convertir en centimes
                    'recurring' => [
                        'interval' => 'month',
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('subscription.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscription.stripe.cancel'),
            'metadata' => [
                'client_id' => $client->id,
                'freelancer_id' => $freelancer->id,
                'hours_per_week' => $hoursPerWeek,
                'delivery_mode' => $deliveryMode,
                'amount' => $amount,
            ],
            'customer_email' => $client->user->email_address ?? null,
        ]);

        // Sauvegarder les données de l'abonnement en session pour utilisation après paiement
        session([
            'pending_subscription' => $subscriptionData,
            'stripe_checkout_session_id' => $session->id,
        ]);

        return $session;
    }

    /**
     * Récupérer la clé secrète Stripe depuis la base de données
     */
    protected function getStripeSecret(): string
    {
        $stripe = \App\Models\PaymentGateway\OnlineGateway::where('keyword', 'stripe')->first();
        
        if (!$stripe) {
            throw new \RuntimeException('Stripe n\'est pas configuré');
        }

        $stripeConf = is_array($stripe->information) 
            ? $stripe->information 
            : json_decode($stripe->information, true);

        if (!isset($stripeConf['secret'])) {
            throw new \RuntimeException('Clé secrète Stripe non trouvée');
        }

        return $stripeConf['secret'];
    }

    /**
     * Obtenir le label du mode de livraison
     */
    protected function getDeliveryModeLabel(string $deliveryMode): string
    {
        return match($deliveryMode) {
            'express_24h' => 'Express 24h (+30%)',
            'express_48h' => 'Express 48h (+20%)',
            'express_72h' => 'Express 72h (+10%)',
            default => 'Standard',
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

