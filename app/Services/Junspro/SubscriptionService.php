<?php

namespace App\Services\Junspro;

use App\Models\Subscription;
use App\Models\ClientProfile;
use App\Models\FreelancerProfile;
use App\Services\PricingService;
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
    protected PricingService $pricingService;

    public function __construct(PlatformFeeService $platformFeeService, PricingService $pricingService)
    {
        $this->platformFeeService = $platformFeeService;
        $this->pricingService = $pricingService;
    }

    /**
     * Créer un nouvel abonnement
     *
     * @param ClientProfile $client
     * @param FreelancerProfile $freelancer
     * @param int $hoursPerWeek Valeurs autorisées: 1, 2, 4, 8, 12, 16, 20, 24
     * @param string $deliveryMode 'standard', 'express_24h', 'express_48h', 'express_72h'
     * @param string|null $stripeSubscriptionId
     * @param string $format 'visio', 'presentiel', 'mixte' (V2 Étape 1.1)
     * @param array{amount: float, payment_intent_id: string}|null $deposit Infos acompte (V2 Étape 1.2)
     * @return Subscription
     * @throws \InvalidArgumentException
     */
    public function createSubscription(
        ClientProfile $client,
        FreelancerProfile $freelancer,
        int $hoursPerWeek,
        string $deliveryMode = 'standard',
        ?string $stripeSubscriptionId = null,
        string $format = 'visio',
        ?array $deposit = null
    ): Subscription {
        // Validation des heures/semaine
        $allowedHours = [1, 2, 4, 8, 12, 16, 20, 24];
        if (!in_array($hoursPerWeek, $allowedHours)) {
            throw new \InvalidArgumentException("hours_per_week doit être l'une des valeurs: " . implode(', ', $allowedHours));
        }

        // Calculs métier
        $hoursTotalMonth = $hoursPerWeek * 4;
        $baseHourly = (float) $freelancer->hourly_rate;
        $clientHourly = $this->pricingService->getClientHourlyRate($baseHourly);
        $priceBase = $baseHourly * $hoursTotalMonth; // montant mensuel côté base

        // Date de facturation suivante (dans 1 mois)
        $nextBillingAt = now()->addMonth();

        // Validation format (V2 Étape 1.1)
        $allowedFormats = ['visio', 'presentiel', 'mixte'];
        if (!in_array($format, $allowedFormats)) {
            throw new \InvalidArgumentException("format doit être l'une des valeurs: " . implode(', ', $allowedFormats));
        }

        $isActive = $stripeSubscriptionId || $deposit;
        $depositAmount = $deposit['amount'] ?? null;
        $depositPaymentIntentId = $deposit['payment_intent_id'] ?? null;

        return DB::transaction(function () use (
            $client,
            $freelancer,
            $hoursPerWeek,
            $hoursTotalMonth,
            $priceBase,
            $baseHourly,
            $clientHourly,
            $deliveryMode,
            $stripeSubscriptionId,
            $nextBillingAt,
            $format,
            $isActive,
            $depositAmount,
            $depositPaymentIntentId
        ) {
            $subscription = Subscription::create([
                'client_id' => $client->id,
                'freelancer_id' => $freelancer->id,
                'hours_per_week' => $hoursPerWeek,
                'hours_total_month' => $hoursTotalMonth,
                'hours_remaining' => $hoursTotalMonth,
                'price_base' => $priceBase,
                'base_hourly_rate_snapshot' => $baseHourly,
                'client_hourly_rate_snapshot' => $clientHourly,
                'commission_rate_snapshot' => null, // défini après premier paiement
                'delivery_mode' => $deliveryMode,
                'format' => $format,
                'deposit_amount' => $depositAmount,
                'deposit_paid_at' => $depositAmount ? now() : null,
                'deposit_payment_intent_id' => $depositPaymentIntentId,
                'status' => $isActive ? 'active' : 'pending',
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
     * Créer une session Stripe Checkout pour l'acompte présentiel (V2 Étape 1.2)
     * Paiement unique = 1 session (1h) pour sécuriser la réservation en présentiel.
     *
     * @param ClientProfile $client
     * @param FreelancerProfile $freelancer
     * @param int $hoursPerWeek
     * @param string $deliveryMode
     * @param string $format 'presentiel' ou 'mixte'
     * @return \Stripe\Checkout\Session
     */
    public function createDepositCheckoutSession(
        ClientProfile $client,
        FreelancerProfile $freelancer,
        int $hoursPerWeek,
        string $deliveryMode,
        string $format
    ): \Stripe\Checkout\Session {
        $stripeSecret = $this->getStripeSecret();
        Stripe::setApiKey($stripeSecret);

        $baseHourly = (float) $freelancer->hourly_rate;
        $clientHourly = $this->pricingService->getClientHourlyRate($baseHourly);
        $depositAmount = $clientHourly * 1; // 1 session = 1h

        $subscriptionData = [
            'client_id' => $client->id,
            'freelancer_id' => $freelancer->id,
            'hours_per_week' => $hoursPerWeek,
            'delivery_mode' => $deliveryMode,
            'format' => $format,
            'amount' => 0, // pas d'abonnement Stripe récurrent
            'deposit_amount' => $depositAmount,
            'type' => 'deposit',
        ];

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Acompte présentiel - ' . ($freelancer->user->first_name ?? '') . ' ' . ($freelancer->user->last_name ?? ''),
                        'description' => sprintf(
                            'Acompte 1 session (1h) - Format %s - %dh/semaine',
                            $format === 'mixte' ? 'mixte' : 'présentiel',
                            $hoursPerWeek
                        ),
                    ],
                    'unit_amount' => (int) round($depositAmount * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('subscription.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscription.stripe.cancel'),
            'metadata' => array_merge($subscriptionData, ['deposit_amount' => (string) $depositAmount]),
            'customer_email' => $client->user->email_address ?? null,
        ]);

        session([
            'pending_subscription' => $subscriptionData,
            'stripe_checkout_session_id' => $session->id,
        ]);

        return $session;
    }

    /**
     * Créer une session Stripe Checkout pour l'abonnement
     *
     * @param string $format 'visio', 'presentiel', 'mixte' (V2 Étape 1.1)
     * @deprecated Préférence : PaymentIntent Connect (application_fee + destination)
     */
    public function createStripeCheckoutSession(
        ClientProfile $client,
        FreelancerProfile $freelancer,
        int $hoursPerWeek,
        string $deliveryMode,
        float $amount,
        string $format = 'visio'
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
            'format' => in_array($format, ['visio', 'presentiel', 'mixte']) ? $format : 'visio',
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
     * Crée un PaymentIntent Stripe Connect avec application_fee + destination.
     *
     * @param ClientProfile $client
     * @param FreelancerProfile $freelancer
     * @param float $baseRate           Tarif base €/h
     * @param float $hoursTotal         Nombre d'heures (ex: heures/semaine * 4)
     * @param string $currency          ex: 'eur'
     * @param string $freelancerStripeAccountId compte connecté du freelance
     * @param array $extraMetadata      metadata additionnelles
     * @return \Stripe\PaymentIntent
     */
    public function createConnectPaymentIntent(
        ClientProfile $client,
        FreelancerProfile $freelancer,
        float $baseRate,
        float $hoursTotal,
        string $currency,
        string $freelancerStripeAccountId,
        array $extraMetadata = []
    ) {
        $stripeSecret = $this->getStripeSecret();
        Stripe::setApiKey($stripeSecret);

        $commissionRate = $this->pricingService->getCommissionRateForPair($client->id, $freelancer->id);
        $dist = $this->pricingService->computeDistributionForHours($baseRate, $commissionRate, $hoursTotal);

        $amountClient = (int) round($dist['client_total'] * 100); // cents
        $applicationFee = (int) round($dist['platform_total'] * 100); // cents

        $metadata = array_merge($extraMetadata, [
            'client_id' => $client->id,
            'freelancer_id' => $freelancer->id,
            'base_rate' => $baseRate,
            'hours' => $hoursTotal,
        ]);

        return \Stripe\PaymentIntent::create([
            'amount' => $amountClient,
            'currency' => $currency,
            'application_fee_amount' => $applicationFee,
            'transfer_data' => [
                'destination' => $freelancerStripeAccountId,
            ],
            'metadata' => $metadata,
        ]);
    }

    /**
     * Récupérer la clé secrète Stripe depuis la base de données
     */
    public function getStripeSecret(): string
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

    /**
     * Créer un abonnement Pause Souffle (sans freelance spécifique)
     * Utilise un freelance système ou NULL selon la configuration
     *
     * @param ClientProfile $client
     * @param int $hoursPerWeek Valeur minimale pour compatibilité système (généralement 1 ou 2)
     * @param float $priceBase Prix de base pour le pack (depuis Stripe price)
     * @param string|null $stripeSubscriptionId
     * @param array $metadata Métadonnées additionnelles (rituals_per_cycle, total_rituals, etc.)
     * @return Subscription
     * @throws \InvalidArgumentException
     */
    public function createPauseSouffleSubscription(
        ClientProfile $client,
        int $hoursPerWeek,
        float $priceBase,
        ?string $stripeSubscriptionId = null,
        array $metadata = []
    ): Subscription {
        // Validation des heures/semaine (minimum 1 pour compatibilité système)
        if ($hoursPerWeek < 1) {
            $hoursPerWeek = 1;
        }

        // Calculs métier
        // Pour Pause Souffle, hours_total_month représente le nombre réel de rituels par cycle
        $ritualsPerCycle = $metadata['rituals_per_cycle'] ?? ($hoursPerWeek * 4);
        $totalRituals = $metadata['total_rituals'] ?? $ritualsPerCycle;
        $hoursTotalMonth = $totalRituals; // Stocker le nombre réel de rituels
        
        // Pour Pause Souffle, on utilise le prix depuis Stripe (pas de calcul basé sur hourly_rate)
        // Le priceBase est déjà le prix final du pack

        // Date de facturation suivante (dans 4 semaines pour cycle 4 semaines)
        $nextBillingAt = now()->addWeeks(4);

        // Récupérer ou créer un freelance système "Pause Souffle"
        $systemFreelancer = $this->getPauseSouffleSystemFreelancer();

        return DB::transaction(function () use (
            $client,
            $systemFreelancer,
            $hoursPerWeek,
            $hoursTotalMonth,
            $priceBase,
            $stripeSubscriptionId,
            $nextBillingAt,
            $metadata
        ) {
            // Stocker les métadonnées Pause Souffle dans un champ JSON si disponible, sinon dans metadata
            $pauseSouffleMetadata = array_merge([
                'service' => 'pause_souffle',
                'rituals_per_cycle' => $metadata['rituals_per_cycle'] ?? ($hoursPerWeek * 4),
                'total_rituals' => $metadata['total_rituals'] ?? $hoursTotalMonth,
                'addon_qty' => $metadata['addon_qty'] ?? 0,
            ], $metadata);

            $subscription = Subscription::create([
                'client_id' => $client->id,
                'freelancer_id' => $systemFreelancer->id,
                'universe' => 'corporate', // Présence
                'hours_per_week' => $hoursPerWeek,
                'hours_total_month' => $hoursTotalMonth, // Nombre réel de rituels par cycle
                'hours_remaining' => $hoursTotalMonth,
                'price_base' => $priceBase,
                'base_hourly_rate_snapshot' => $hoursTotalMonth > 0 ? ($priceBase / $hoursTotalMonth) : 0,
                'client_hourly_rate_snapshot' => $hoursTotalMonth > 0 ? ($priceBase / $hoursTotalMonth) : 0,
                'commission_rate_snapshot' => null,
                'delivery_mode' => 'standard',
                'format' => 'visio',
                'status' => $stripeSubscriptionId ? 'active' : 'pending',
                'stripe_subscription_id' => $stripeSubscriptionId,
                'next_billing_at' => $nextBillingAt,
            ]);

            // Stocker les métadonnées Pause Souffle (si le modèle a un champ metadata, sinon utiliser une table séparée)
            // Pour l'instant, on les stocke dans les logs et on peut les récupérer via la relation avec PauseSouffleIntake

            Log::info("Abonnement Pause Souffle créé", [
                'subscription_id' => $subscription->id,
                'client_id' => $client->id,
                'hours_per_week' => $hoursPerWeek,
            ]);

            return $subscription;
        });
    }

    /**
     * Récupérer ou créer le freelance système "Pause Souffle"
     */
    protected function getPauseSouffleSystemFreelancer(): FreelancerProfile
    {
        // Chercher un freelance avec un email système ou un identifiant spécial
        $systemEmail = 'pause-souffle@junspro.system';
        $user = \App\Models\User::where('email_address', $systemEmail)->first();

        if (!$user) {
            // Créer l'utilisateur système
            $user = \App\Models\User::create([
                'name' => 'Pause Souffle',
                'first_name' => 'Pause',
                'last_name' => 'Souffle',
                'email_address' => $systemEmail,
                'username' => 'pause-souffle-system',
                'password' => bcrypt(uniqid()), // Mot de passe aléatoire, jamais utilisé
                'status' => 1,
            ]);
        }

        // Créer ou récupérer le profil freelance
        $freelancer = FreelancerProfile::where('user_id', $user->id)->first();

        if (!$freelancer) {
            $freelancer = FreelancerProfile::create([
                'user_id' => $user->id,
                'hourly_rate' => 0, // Pas utilisé pour Pause Souffle
                'reliability_score' => 100,
                'status' => 1,
            ]);
        }

        return $freelancer;
    }
}

