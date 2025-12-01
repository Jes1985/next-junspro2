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
}


