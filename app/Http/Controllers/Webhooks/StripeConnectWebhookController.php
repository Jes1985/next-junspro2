<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\ClientProfile;
use App\Models\FreelancerProfile;
use App\Models\Subscription;
use App\Services\PricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeConnectWebhookController extends Controller
{
    public function __invoke(Request $request, PricingService $pricingService)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\Throwable $e) {
            Log::error('Stripe webhook signature failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'invalid signature'], 400);
        }

        if ($event->type !== 'payment_intent.succeeded') {
            return response()->json(['status' => 'ignored']);
        }

        $pi = $event->data->object;
        $metadata = $pi->metadata ?? [];

        $clientId      = $metadata['client_id'] ?? null;
        $freelancerId  = $metadata['freelancer_id'] ?? null;
        $subscriptionId= $metadata['subscription_id'] ?? null;
        $baseRate      = isset($metadata['base_rate']) ? (float)$metadata['base_rate'] : null;
        $hours         = isset($metadata['hours']) ? (float)$metadata['hours'] : 1.0;

        if (!$clientId || !$freelancerId || !$baseRate) {
            Log::warning('Stripe webhook missing metadata', ['metadata' => $metadata]);
            return response()->json(['status' => 'missing metadata'], 200);
        }

        $client     = ClientProfile::find($clientId);
        $freelancer = FreelancerProfile::find($freelancerId);

        if (!$client || !$freelancer) {
            Log::warning('Stripe webhook client/freelancer not found', compact('clientId', 'freelancerId'));
            return response()->json(['status' => 'not found'], 200);
        }

        $commissionRate = $pricingService->getCommissionRateForPair($clientId, $freelancerId);
        $distribution   = $pricingService->computeDistributionForHours($baseRate, $commissionRate, $hours);

        // Mettre à jour les cumuls (base + client)
        $pricingService->incrementStats(
            $clientId,
            $freelancerId,
            $distribution['base_total'],
            $distribution['client_total']
        );

        // Créer une facture interne
        $invoice = \App\Models\Invoice::create([
            'client_id' => $clientId,
            'freelancer_id' => $freelancerId,
            'subscription_id' => $subscriptionId ?: null,
            'payment_intent_id' => $pi->id,
            'currency' => strtolower($pi->currency ?? 'eur'),
            'amount_base_total' => $distribution['base_total'],
            'amount_client_total' => $distribution['client_total'],
            'platform_commission_total' => $distribution['commission_total'],
            'platform_client_fee_total' => $distribution['client_fee_total'],
            'freelancer_net_total' => $distribution['freelancer_net_total'],
            'commission_rate_used' => $commissionRate,
            'meta' => [
                'hours' => $hours,
                'base_rate' => $baseRate,
                'client_rate' => $distribution['client_hourly'],
                'freelancer_net_hourly' => $distribution['freelancer_net_hourly'],
            ],
        ]);

        \App\Models\InvoiceLine::create([
            'invoice_id' => $invoice->id,
            'description' => 'Abonnement Junspro - ' . ($subscriptionId ?? 'hors abonnement'),
            'hours' => $hours,
            'base_amount' => $distribution['base_total'],
            'client_amount' => $distribution['client_total'],
            'commission_amount' => $distribution['commission_total'],
            'client_fee_amount' => $distribution['client_fee_total'],
            'freelancer_net_amount' => $distribution['freelancer_net_total'],
            'platform_total_amount' => $distribution['platform_total'],
        ]);

        // Marquer l'abonnement actif si présent
        if ($subscriptionId && ($subscription = Subscription::find($subscriptionId))) {
            $subscription->status = 'active';
            $subscription->commission_rate_snapshot = $commissionRate;
            $subscription->save();
        }

        Log::info('Stripe payment_intent.succeeded traité', [
            'client_id' => $clientId,
            'freelancer_id' => $freelancerId,
            'subscription_id' => $subscriptionId,
            'breakdown' => $distribution,
            'payment_intent' => $pi->id,
        ]);

        return response()->json(['status' => 'ok']);
    }
}

