<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\NotificationLog;
use App\Models\Subscription;
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
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\Exception $e) {
            Log::error('Stripe webhook signature verification failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Traiter les événements
        switch ($event->type) {
            case 'invoice.payment_succeeded':
                $this->handlePaymentSucceeded($event->data->object);
                break;

            case 'invoice.payment_failed':
                $this->handlePaymentFailed($event->data->object);
                break;

            case 'customer.subscription.deleted':
                $this->handleSubscriptionDeleted($event->data->object);
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


