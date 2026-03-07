<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\NotificationLog;
use App\Models\PauseSouffleIntake;
use App\Models\Subscription;
use App\Models\Affiliate;
use App\Models\PaymentGateway\OnlineGateway;
use App\Services\Junspro\AffiliateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Webhook;

class JunsproStripeWebhookController extends Controller
{
    /**
     * Gérer les webhooks Stripe pour les abonnements Junspro
     */
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        
        // Récupérer le webhook secret depuis la base de données
        $stripe = OnlineGateway::where('keyword', 'stripe')->first();
        if (!$stripe) {
            Log::error('Stripe gateway not found in database');
            return response()->json(['error' => 'Stripe gateway not configured'], 500);
        }
        
        $stripeConf = is_array($stripe->information) 
            ? $stripe->information 
            : json_decode($stripe->information, true);
        
        if (!isset($stripeConf['webhook_secret'])) {
            Log::error('Stripe webhook_secret not found in gateway configuration');
            return response()->json(['error' => 'Webhook secret not configured'], 500);
        }
        
        $endpointSecret = $stripeConf['webhook_secret'];

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\Exception $e) {
            Log::error('Stripe webhook signature verification failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Traiter les événements
        switch ($event->type) {
            case 'checkout.session.completed':
                // Gérer les paiements one-time (essai Pause Souffle) et abonnements
                $this->handleCheckoutSessionCompleted($event->data->object);
                break;

            case 'invoice.payment_succeeded':
            case 'invoice.paid':
            case 'invoice_payment.paid':
                $this->handlePaymentSucceeded($event->data->object);
                break;

            case 'invoice.payment_failed':
            case 'invoice.payment_action_required':
                $this->handlePaymentFailed($event->data->object);
                break;

            case 'customer.subscription.deleted':
                $this->handleSubscriptionDeleted($event->data->object);
                break;

            case 'customer.subscription.created':
                // Pour Pause Souffle, créer la subscription si nécessaire
                $this->handleSubscriptionCreated($event->data->object);
                break;

            case 'charge.refunded':
                $this->handleChargeRefunded($event->data->object);
                break;

            default:
                Log::info('Unhandled Stripe webhook event', ['type' => $event->type]);
        }

        return response()->json(['received' => true]);
    }

    /**
     * Paiement réussi → abonnement actif, mise à jour next_billing_at
     */
    protected function handlePaymentSucceeded($invoice)
    {
        $stripeSubscriptionId = $invoice->subscription;

        if (!$stripeSubscriptionId) {
            return;
        }

        $subscription = Subscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();

        if (!$subscription) {
            Log::warning('Subscription not found for Stripe subscription', ['stripe_id' => $stripeSubscriptionId]);
            return;
        }

        // Mettre à jour l'abonnement
        $subscription->status = 'active';
        $subscription->next_billing_at = now()->addMonth();
        $subscription->save();

        // Notifier client et freelance
        $this->notifyUser($subscription->client->user_id, 'subscription_payment_succeeded', [
            'subscription_id' => $subscription->id,
            'amount' => $invoice->amount_paid / 100,
        ]);

        $this->notifyUser($subscription->freelancer->user_id, 'subscription_payment_received', [
            'subscription_id' => $subscription->id,
            'amount' => $invoice->amount_paid / 100,
        ]);

        // Audit log
        AuditLog::create([
            'user_id' => $subscription->client->user_id,
            'action_type' => 'subscription_payment_succeeded',
            'entity_type' => 'subscription',
            'entity_id' => $subscription->id,
            'metadata' => [
                'stripe_invoice_id' => $invoice->id,
                'amount' => $invoice->amount_paid / 100,
            ],
        ]);

        Log::info('Subscription payment succeeded', [
            'subscription_id' => $subscription->id,
            'invoice_id' => $invoice->id,
        ]);

        // ─── Attribution commission affilié ────────────────────────────────
        $this->recordAffiliateCommission(
            $subscription->client->user ?? null,
            $invoice->payment_intent ?? null,
            $invoice->amount_paid / 100,
            'subscription',
            $subscription->id
        );
    }

    /**
     * Paiement échoué → abonnement past_due
     */
    protected function handlePaymentFailed($invoice)
    {
        $stripeSubscriptionId = $invoice->subscription;

        if (!$stripeSubscriptionId) {
            return;
        }

        $subscription = Subscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();

        if (!$subscription) {
            return;
        }

        $subscription->status = 'past_due';
        $subscription->save();

        // Notifier le client
        $this->notifyUser($subscription->client->user_id, 'subscription_payment_failed', [
            'subscription_id' => $subscription->id,
            'invoice_id' => $invoice->id,
        ]);

        AuditLog::create([
            'user_id' => $subscription->client->user_id,
            'action_type' => 'subscription_payment_failed',
            'entity_type' => 'subscription',
            'entity_id' => $subscription->id,
            'metadata' => [
                'stripe_invoice_id' => $invoice->id,
            ],
        ]);
    }

    /**
     * Abonnement supprimé → annulation
     */
    protected function handleSubscriptionDeleted($stripeSubscription)
    {
        $subscription = Subscription::where('stripe_subscription_id', $stripeSubscription->id)->first();

        if (!$subscription) {
            return;
        }

        $subscription->status = 'cancelled';
        $subscription->ends_at = now();
        $subscription->save();

        $this->notifyUser($subscription->client->user_id, 'subscription_cancelled', [
            'subscription_id' => $subscription->id,
        ]);

        AuditLog::create([
            'user_id' => $subscription->client->user_id,
            'action_type' => 'subscription_cancelled_stripe',
            'entity_type' => 'subscription',
            'entity_id' => $subscription->id,
            'metadata' => [
                'stripe_subscription_id' => $stripeSubscription->id,
            ],
        ]);
    }

    /**
     * Gérer checkout.session.completed pour Pause Souffle
     */
    protected function handleCheckoutSessionCompleted($session)
    {
        $metadata = $session->metadata ?? [];
        $type = $metadata['type'] ?? null;
        
        // Gérer essai Pause Souffle
        if ($type === 'pause_souffle') {
            $intakeId = $metadata['intake_id'] ?? null;
            
            if (!$intakeId) {
                Log::warning('Pause Souffle checkout session completed but intake_id missing', [
                    'session_id' => $session->id,
                ]);
                return;
            }

            $intake = PauseSouffleIntake::find($intakeId);
            
            if (!$intake) {
                Log::warning('Pause Souffle intake not found', ['intake_id' => $intakeId]);
                return;
            }

            // Mettre à jour le statut de l'essai
            $intake->status = 'paid';
            $intake->stripe_payment_intent_id = $session->payment_intent ?? null;
            $intake->paid_at = now();
            $intake->save();

            Log::info('Pause Souffle intake paid', [
                'intake_id' => $intake->id,
                'session_id' => $session->id,
                'plan_key' => $intake->plan_key,
            ]);

            // ─── Attribution commission affilié ──────────────────────────
            $this->recordAffiliateCommission(
                $intake->user ?? null,
                $session->payment_intent ?? null,
                ($session->amount_total ?? 0) / 100,
                'other',
                null
            );
        }
        
        // Gérer abonnement Pause Souffle (subscription)
        if ($type === 'pause_souffle_subscription') {
            $this->handlePauseSouffleSubscription($session);
        }
    }

    /**
     * Gérer la création de subscription Pause Souffle après paiement
     */
    protected function handlePauseSouffleSubscription($session)
    {
        $metadata = $session->metadata ?? [];
        $intakeId = $metadata['intake_id'] ?? null;
        $pack = $metadata['pack'] ?? null;
        $addonQty = (int) ($metadata['addon_qty'] ?? 0);
        
        if (!$intakeId || !$pack) {
            Log::warning('Pause Souffle subscription session missing metadata', [
                'session_id' => $session->id,
                'metadata' => $metadata,
            ]);
            return;
        }

        $intake = PauseSouffleIntake::find($intakeId);
        if (!$intake) {
            Log::warning('Pause Souffle intake not found for subscription', ['intake_id' => $intakeId]);
            return;
        }

        // Récupérer le stripe_subscription_id depuis la session
        $stripeSubscriptionId = $session->subscription ?? null;
        if (!$stripeSubscriptionId) {
            Log::warning('Pause Souffle subscription session has no subscription ID', [
                'session_id' => $session->id,
            ]);
            return;
        }

        // Vérifier idempotence : si subscription existe déjà, ne pas en créer une deuxième
        if ($intake->subscription_id) {
            $existingSubscription = $intake->subscription;
            if ($existingSubscription && $existingSubscription->stripe_subscription_id === $stripeSubscriptionId) {
                Log::info('Pause Souffle subscription already exists', [
                    'intake_id' => $intakeId,
                    'subscription_id' => $existingSubscription->id,
                ]);
                return;
            }
        }

        // Vérifier aussi si une subscription avec ce stripe_subscription_id existe déjà
        $existingByStripeId = \App\Models\Subscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();
        if ($existingByStripeId) {
            // Lier à l'intake si pas déjà fait
            if (!$intake->subscription_id) {
                $intake->update(['subscription_id' => $existingByStripeId->id]);
            }
            Log::info('Pause Souffle subscription already exists by Stripe ID', [
                'intake_id' => $intakeId,
                'subscription_id' => $existingByStripeId->id,
            ]);
            return;
        }

        // Récupérer les données depuis la session Laravel ou recalculer
        $sessionData = session('pending_pause_souffle_subscription');
        if (!$sessionData || $sessionData['intake_id'] != $intakeId) {
            // Recalculer depuis metadata
            $ritualsPerCycle = config("pause_souffle.pack_to_rituals_per_cycle.{$pack}", 0);
            $totalRituals = $ritualsPerCycle + $addonQty;
            $hoursPerWeek = config("pause_souffle.pack_to_hours_per_week.{$pack}", 1);
            
            // Récupérer le prix depuis Stripe
            $priceId = config("pause_souffle.stripe_prices.{$pack}");
            $priceBase = 0;
            if ($priceId) {
                try {
                    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
                    $stripePrice = \Stripe\Price::retrieve($priceId);
                    $priceBase = $stripePrice->unit_amount / 100;
                } catch (\Exception $e) {
                    Log::error('Erreur récupération prix Stripe pour subscription', ['error' => $e->getMessage()]);
                }
            }
        } else {
            $ritualsPerCycle = $sessionData['rituals_per_cycle'] ?? 0;
            $totalRituals = $sessionData['total_rituals'] ?? 0;
            $hoursPerWeek = $sessionData['hours_per_week'] ?? 1;
            $priceBase = $sessionData['price_base'] ?? 0;
        }

        // Récupérer le client
        $user = $intake->user;
        if (!$user) {
            Log::warning('Pause Souffle intake has no user', ['intake_id' => $intakeId]);
            return;
        }

        $clientProfile = $user->clientProfile;
        if (!$clientProfile) {
            $clientProfile = \App\Models\ClientProfile::create([
                'user_id' => $user->id,
                'total_spent' => 0,
            ]);
        }

        try {
            // Créer la subscription via SubscriptionService
            $subscriptionService = app(\App\Services\Junspro\SubscriptionService::class);
            $subscription = $subscriptionService->createPauseSouffleSubscription(
                $clientProfile,
                $hoursPerWeek,
                $priceBase,
                $stripeSubscriptionId, // stripe_subscription_id
                [
                    'rituals_per_cycle' => $ritualsPerCycle,
                    'total_rituals' => $totalRituals,
                    'addon_qty' => $addonQty,
                    'pack' => $pack,
                ]
            );

            // Lier la subscription à l'intake
            $intake->update(['subscription_id' => $subscription->id]);

            // Créer les top-ups si add-on > 0
            if ($addonQty > 0) {
                $unitPrice = $priceBase / max(1, $totalRituals); // Prix unitaire approximatif
                \App\Models\SubscriptionTopup::create([
                    'subscription_id' => $subscription->id,
                    'user_id' => $user->id,
                    'qty' => $addonQty,
                    'unit_price' => $unitPrice,
                    'total_price' => $unitPrice * $addonQty,
                    'status' => 'paid', // Payé via l'abonnement Stripe
                    'paid_at' => now(),
                ]);

                // Mettre à jour hours_remaining pour inclure l'add-on
                $subscription->hours_remaining = $totalRituals;
                $subscription->save();
            }

            Log::info('Pause Souffle subscription created', [
                'intake_id' => $intakeId,
                'subscription_id' => $subscription->id,
                'pack' => $pack,
                'total_rituals' => $totalRituals,
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur création subscription Pause Souffle', [
                'intake_id' => $intakeId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Gérer payment_intent.succeeded pour Pause Souffle (backup)
     */
    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        $metadata = $paymentIntent->metadata ?? [];
        
        // Vérifier si c'est un paiement Pause Souffle
        if (($metadata['type'] ?? null) !== 'pause_souffle') {
            return;
        }

        $intakeId = $metadata['intake_id'] ?? null;
        
        if (!$intakeId) {
            return;
        }

        $intake = PauseSouffleIntake::find($intakeId);
        
        if (!$intake || $intake->status === 'paid') {
            return;
        }

        // Mettre à jour le statut si pas déjà fait
        $intake->status = 'paid';
        $intake->stripe_payment_intent_id = $paymentIntent->id;
        $intake->paid_at = now();
        $intake->save();

        Log::info('Pause Souffle intake paid via payment_intent', [
            'intake_id' => $intake->id,
            'payment_intent_id' => $paymentIntent->id,
        ]);
    }

    /**
     * Gérer customer.subscription.created pour Pause Souffle
     */
    protected function handleSubscriptionCreated($stripeSubscription)
    {
        // Récupérer la session checkout associée si disponible
        // Sinon, on attendra checkout.session.completed qui contient les metadata
        // Cette méthode est un backup si checkout.session.completed n'est pas déclenché
        Log::info('Stripe subscription created', [
            'subscription_id' => $stripeSubscription->id,
            'metadata' => $stripeSubscription->metadata ?? [],
        ]);
    }

    /**
     * Gérer charge.refunded → annuler la commission affilié associée
     */
    protected function handleChargeRefunded($charge)
    {
        $paymentIntent = $charge->payment_intent ?? null;
        if (!$paymentIntent) return;

        try {
            $affiliateService = app(AffiliateService::class);
            $affiliateService->cancelConversion($paymentIntent);
            Log::info('[Affiliate] Commission annulée suite remboursement', ['pi' => $paymentIntent]);
        } catch (\Exception $e) {
            Log::error('[Affiliate] Erreur annulation commission remboursement', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Attribution automatique de commission affilié si le user a été apporté par un affilié
     */
    protected function recordAffiliateCommission(
        ?\App\Models\User $user,
        ?string $stripePaymentIntent,
        float $amount,
        string $sourceType,
        ?int $sourceId = null
    ): void {
        if (!$user || !$stripePaymentIntent || $amount <= 0) return;

        $affiliateCode = $user->referred_by_affiliate_code;
        if (!$affiliateCode) return;

        try {
            $affiliate = Affiliate::where('status', 'active')
                ->where(function ($q) use ($affiliateCode) {
                    $q->where('affiliate_code', $affiliateCode)
                      ->orWhere('custom_slug', $affiliateCode);
                })
                ->first();

            if (!$affiliate) {
                Log::info('[Affiliate] Code affilié introuvable ou inactif', ['code' => $affiliateCode]);
                return;
            }

            // Ne pas auto-commissionner si l'affilié paie lui-même
            if ($affiliate->user_id === $user->id) return;

            $affiliateService = app(AffiliateService::class);
            $affiliateService->recordConversion(
                $affiliate,
                $user,
                $amount,              // transactionAmount
                $sourceType,          // sourceType
                $sourceId,            // sourceId
                $stripePaymentIntent  // stripePaymentIntent
            );

            Log::info('[Affiliate] Commission enregistrée', [
                'affiliate_id' => $affiliate->id,
                'user_id'      => $user->id,
                'amount'       => $amount,
                'source'       => $sourceType,
            ]);
        } catch (\Exception $e) {
            Log::error('[Affiliate] Erreur enregistrement commission', [
                'error'   => $e->getMessage(),
                'user_id' => $user->id ?? null,
            ]);
        }
    }

    /**
     * Créer une notification pour un utilisateur
     */
    protected function notifyUser($userId, $type, $data = [])
    {
        NotificationLog::create([
            'user_id' => $userId,
            'channel' => 'email',
            'type' => $type,
            'content' => json_encode($data),
            'sent_at' => now(),
        ]);

        // TODO: Envoyer l'email réel via Laravel Notifications
        // Notification::send($user, new SubscriptionNotification($type, $data));
    }
}



