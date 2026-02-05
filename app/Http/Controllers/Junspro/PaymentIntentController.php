<?php

namespace App\Http\Controllers\Junspro;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\ClientProfile;
use App\Models\FreelancerProfile;
use App\Services\Junspro\SubscriptionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PaymentIntentController extends Controller
{
    protected SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Créer un PaymentIntent Stripe Connect pour un abonnement
     * 
     * POST /api/junspro/v2/payment-intents
     * 
     * Body:
     * {
     *   "subscription_id": 123,
     *   "freelancer_stripe_account_id": "acct_xxx"
     * }
     */
    public function store(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'subscription_id' => 'required|integer|exists:subscriptions,id',
            'freelancer_stripe_account_id' => 'required|string|min:1',
        ], [
            'subscription_id.required' => 'L\'ID de l\'abonnement est obligatoire.',
            'subscription_id.exists' => 'L\'abonnement spécifié n\'existe pas.',
            'freelancer_stripe_account_id.required' => 'L\'ID du compte Stripe Connect du freelance est obligatoire.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Récupérer l'abonnement avec ses relations
            $subscription = Subscription::with(['client', 'freelancer'])
                ->findOrFail($request->subscription_id);

            // Vérifier que l'utilisateur authentifié est le client de cet abonnement
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Non authentifié.',
                ], 401);
            }

            $client = ClientProfile::where('user_id', $user->id)->first();
            
            if (!$client || $subscription->client_id !== $client->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous n\'êtes pas autorisé à créer un paiement pour cet abonnement.',
                ], 403);
            }

            // Vérifier que l'abonnement a les snapshots nécessaires
            if (!$subscription->base_hourly_rate_snapshot || !$subscription->hours_total_month) {
                return response()->json([
                    'success' => false,
                    'message' => 'L\'abonnement n\'a pas les informations de tarification nécessaires. Veuillez contacter le support.',
                ], 400);
            }

            // Créer le PaymentIntent via SubscriptionService
            $paymentIntent = $this->subscriptionService->createConnectPaymentIntent(
                $subscription->client,
                $subscription->freelancer,
                (float) $subscription->base_hourly_rate_snapshot,
                (float) $subscription->hours_total_month,
                'eur', // Devise
                $request->freelancer_stripe_account_id,
                [
                    'subscription_id' => $subscription->id,
                ]
            );

            Log::info('PaymentIntent créé avec succès', [
                'payment_intent_id' => $paymentIntent->id,
                'subscription_id' => $subscription->id,
                'client_id' => $subscription->client_id,
                'freelancer_id' => $subscription->freelancer_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'PaymentIntent créé avec succès',
                'data' => [
                    'client_secret' => $paymentIntent->client_secret,
                    'payment_intent_id' => $paymentIntent->id,
                    'amount' => $paymentIntent->amount / 100, // Convertir de centimes en euros
                    'currency' => $paymentIntent->currency,
                    'status' => $paymentIntent->status,
                ],
            ], 201);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error('Erreur Stripe lors de la création du PaymentIntent', [
                'error' => $e->getMessage(),
                'subscription_id' => $request->subscription_id,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du paiement: ' . $e->getMessage(),
            ], 500);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du PaymentIntent', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'subscription_id' => $request->subscription_id,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la création du paiement. Veuillez réessayer plus tard.',
            ], 500);
        }
    }

    /**
     * Récupérer les détails d'un PaymentIntent
     * 
     * GET /api/junspro/v2/payment-intents/{payment_intent_id}
     */
    public function show(string $paymentIntentId): JsonResponse
    {
        try {
            $stripeSecret = $this->subscriptionService->getStripeSecret();
            \Stripe\Stripe::setApiKey($stripeSecret);

            $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $paymentIntent->id,
                    'status' => $paymentIntent->status,
                    'amount' => $paymentIntent->amount / 100,
                    'currency' => $paymentIntent->currency,
                    'client_secret' => $paymentIntent->client_secret,
                ],
            ]);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération du PaymentIntent: ' . $e->getMessage(),
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue.',
            ], 500);
        }
    }
}

