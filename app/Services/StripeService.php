<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Crée une session de checkout Stripe
     */
    public function createCheckoutSession($amount, $missionId)
    {
        // Ajouter 20% de frais de protection Junspro
        $fraisProtection = $amount * 0.20;
        $montantTotal = $amount + $fraisProtection;

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Mission Junspro',
                    ],
                    'unit_amount' => (int)($montantTotal * 100), // Convertir en centimes
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('mission.stripe.success', ['mission_id' => $missionId]),
            'cancel_url' => route('mission.stripe.cancel'),
            'metadata' => [
                'mission_id' => $missionId,
            ],
        ]);

        return $session;
    }

    /**
     * Traite le webhook Stripe
     */
    public function handleWebhook(array $payload)
    {
        $endpointSecret = config('services.stripe.webhook_secret');
        
        try {
            $event = Webhook::constructEvent(
                json_encode($payload),
                request()->header('Stripe-Signature'),
                $endpointSecret
            );
            
            return $event;
        } catch (\Exception $e) {
            Log::error('Stripe webhook error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Effectue un remboursement automatique
     */
    public function refund($paymentIntentId, $amount = null)
    {
        $refundData = ['payment_intent' => $paymentIntentId];
        
        if ($amount) {
            $refundData['amount'] = (int)($amount * 100);
        }

        return \Stripe\Refund::create($refundData);
    }

    /**
     * Crée une session de checkout Stripe pour l'abonnement HomeSwap (99€/an)
     */
    public function createHomeSwapCheckoutSession($userId = null)
    {
        // Montant: 99€/an (avec 10% de frais de protection)
        $montantBase = 99.00;
        $fraisProtection = $montantBase * 0.10;
        $montantTotal = $montantBase + $fraisProtection;

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Abonnement HomeSwap Junspro',
                        'description' => 'Accès complet à la plateforme d\'échange de logement (message & visio)',
                    ],
                    'unit_amount' => (int)($montantTotal * 100), // Convertir en centimes
                    'recurring' => [
                        'interval' => 'year',
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('mission.stripe.success') . '?type=homeswap&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('mission.stripe.cancel'),
            'metadata' => [
                'type' => 'homeswap_subscription',
                'user_id' => $userId,
            ],
            'customer_email' => $userId ? \App\Models\User::find($userId)?->email_address : null,
        ]);

        return $session;
    }

    /**
     * Crée une session de checkout Stripe pour Pause Souffle
     * 
     * @param string $planKey 'trial', 'cycle_4w', ou 'cycle_3m'
     * @param int $intakeId ID de l'intake Pause Souffle
     * @param string|null $customerEmail Email du client
     * @return Session
     * @throws \Exception Si le price_id n'est pas configuré
     */
    public function createPauseSouffleCheckoutSession(string $planKey, int $intakeId, ?string $customerEmail = null)
    {
        // Vérifier que la clé API Stripe est configurée
        $stripeSecret = config('services.stripe.secret');
        if (!$stripeSecret) {
            Log::error('Stripe secret key non configuré dans config/services.php', [
                'env_var' => 'STRIPE_SECRET',
                'config_path' => 'services.stripe.secret'
            ]);
            throw new \Exception("Configuration Stripe invalide: clé API secrète manquante. Vérifiez STRIPE_SECRET dans .env");
        }

        // Vérifier que le price_id est configuré
        $priceId = config("pause_souffle.stripe_prices.{$planKey}");
        if (!$priceId) {
            $envVar = 'PAUSE_SOUFFLE_PRICE_' . strtoupper(str_replace('-', '_', $planKey));
            Log::error('Stripe price ID non configuré', [
                'plan_key' => $planKey,
                'env_var' => $envVar,
                'config_path' => "pause_souffle.stripe_prices.{$planKey}"
            ]);
            throw new \Exception("Stripe price ID non configuré pour le plan: {$planKey}. Vérifiez {$envVar} dans .env");
        }

        // Vérifier que les routes success/cancel existent
        try {
            $successUrl = route('pause-souffle.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}';
            $cancelUrl = route('pause-souffle.stripe.cancel', ['intake_id' => $intakeId]);
        } catch (\Exception $e) {
            Log::error('Route Stripe non trouvée', [
                'error' => $e->getMessage(),
                'route_success' => 'pause-souffle.stripe.success',
                'route_cancel' => 'pause-souffle.stripe.cancel'
            ]);
            throw new \Exception("Routes Stripe non configurées. Vérifiez les routes dans routes/web.php");
        }

        // Déterminer le mode selon le plan
        $mode = ($planKey === 'trial') ? 'payment' : 'subscription';
        
        $planLabel = config("pause_souffle.plan_labels.{$planKey}", $planKey);

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $priceId,
                    'quantity' => 1,
                ]],
                'mode' => $mode,
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'metadata' => [
                    'intake_id' => $intakeId,
                    'plan_key' => $planKey,
                    'type' => 'pause_souffle',
                ],
                'customer_email' => $customerEmail,
            ]);

            Log::info('Session Stripe Checkout créée avec succès', [
                'session_id' => $session->id,
                'plan_key' => $planKey,
                'price_id' => $priceId,
                'mode' => $mode
            ]);

            return $session;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Log::error('Erreur Stripe API lors de la création de la session', [
                'stripe_error' => $e->getStripeCode(),
                'error' => $e->getMessage(),
                'plan_key' => $planKey,
                'price_id' => $priceId,
            ]);
            throw $e;
        }
    }

    /**
     * Créer une session Stripe Checkout pour la formation certifiante Praticien Pause Souffle
     * Montant fixe : 1 490 € (paiement unique)
     */
    public function createFormationCheckoutSession(int $userId, string $userEmail): Session
    {
        $stripeSecret = config('services.stripe.secret');
        if (!$stripeSecret) {
            throw new \Exception('Configuration Stripe invalide: clé API secrète manquante.');
        }

        Stripe::setApiKey($stripeSecret);

        $successUrl = route('presence.formation.success') . '?session_id={CHECKOUT_SESSION_ID}';
        $cancelUrl  = route('presence.formation.cancel');

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'eur',
                    'unit_amount'  => 149000,
                    'product_data' => [
                        'name'        => 'Formation certifiante Praticien Pause Souffle',
                        'description' => '6 modules en ligne + Week-end immersif 3 jours + Attestation Junspro',
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode'           => 'payment',
            'success_url'    => $successUrl,
            'cancel_url'     => $cancelUrl,
            'customer_email' => $userEmail,
            'metadata' => [
                'type'    => 'formation_praticien',
                'user_id' => $userId,
            ],
        ]);

        Log::info('[StripeService] Session checkout formation créée', [
            'session_id' => $session->id,
            'user_id'    => $userId,
        ]);

        return $session;
    }

    /**
     * Créer une session Stripe Checkout pour la formation en 3 mensualités de 510 €
     * Mode subscription : Stripe enverra invoice.payment_succeeded × 3, puis l'abonnement est annulé
     */
    public function createFormationInstallmentCheckoutSession(int $userId, string $userEmail): Session
    {
        $stripeSecret = config('services.stripe.secret');
        if (!$stripeSecret) {
            throw new \Exception('Configuration Stripe invalide: clé API secrète manquante.');
        }

        Stripe::setApiKey($stripeSecret);

        $successUrl = route('presence.formation.success') . '?session_id={CHECKOUT_SESSION_ID}';
        $cancelUrl  = route('presence.formation.cancel');

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'eur',
                    'unit_amount'  => 51000,
                    'recurring'    => ['interval' => 'month', 'interval_count' => 1],
                    'product_data' => [
                        'name'        => 'Formation Praticien Pause Souffle — 3× mensualités',
                        'description' => '3 mensualités de 510 € · Accès complet dès le 1er paiement',
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode'           => 'subscription',
            'success_url'    => $successUrl,
            'cancel_url'     => $cancelUrl,
            'customer_email' => $userEmail,
            'metadata' => [
                'type'             => 'formation_praticien_installment',
                'user_id'          => $userId,
                'max_installments' => 3,
            ],
            'subscription_data' => [
                'metadata' => [
                    'type'             => 'formation_praticien_installment',
                    'user_id'          => $userId,
                    'max_installments' => 3,
                ],
            ],
        ]);

        Log::info('[StripeService] Session checkout formation installment créée', [
            'session_id' => $session->id,
            'user_id'    => $userId,
        ]);

        return $session;
    }
}
