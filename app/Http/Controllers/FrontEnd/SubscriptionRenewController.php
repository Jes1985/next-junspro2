<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\PaymentGateway\OnlineGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class SubscriptionRenewController extends Controller
{
    /**
     * Récupérer le devis de renouvellement pour un abonnement
     */
    public function quote($id)
    {
        $user = Auth::guard('web')->user();
        if (!$user || !$user->clientProfile) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $subscription = Subscription::with(['freelancer.user', 'client'])
            ->where('id', $id)
            ->where('client_id', $user->clientProfile->id)
            ->firstOrFail();

        $freelancer = $subscription->freelancer;
        $freelancerUser = $freelancer->user ?? null;
        $freelancerName = $freelancerUser 
            ? ($freelancerUser->first_name . ' ' . $freelancerUser->last_name)
            : 'Freelance';

        // Avatar
        $avatarUrl = null;
        if ($freelancerUser && $freelancerUser->image) {
            $avatarUrl = asset('assets/img/users/' . $freelancerUser->image);
        }

        // Calculs de prix
        $hoursPerPeriod = $subscription->hours_per_week * 4; // 4 semaines
        $pricePerHour = $subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0;
        $subtotal = $subscription->price_base ?? ($hoursPerPeriod * $pricePerHour);
        
        // Taxes (simulation : 13% de TVA française)
        $taxRate = 0.13;
        $taxAmount = round($subtotal * $taxRate, 2);
        $total = round($subtotal + $taxAmount, 2);

        // Mode de paiement - Récupérer depuis Stripe
        $paymentMethod = null;
        if ($subscription->stripe_subscription_id) {
            try {
                // Récupérer la clé Stripe depuis la base de données
                $stripe = OnlineGateway::where('keyword', 'stripe')->first();
                if ($stripe) {
                    $stripeConf = is_array($stripe->information) 
                        ? $stripe->information 
                        : json_decode($stripe->information, true);
                    
                    if ($stripeConf && isset($stripeConf["secret"])) {
                        Config::set('services.stripe.secret', $stripeConf["secret"]);
                    }
                }
                
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
                
                // Récupérer l'abonnement Stripe
                $stripeSubscription = \Stripe\Subscription::retrieve($subscription->stripe_subscription_id);
                
                // Récupérer le customer
                $customerId = $stripeSubscription->customer;
                $customer = \Stripe\Customer::retrieve($customerId);
                
                // Récupérer le payment method par défaut
                if (isset($customer->invoice_settings->default_payment_method)) {
                    $defaultPaymentMethodId = $customer->invoice_settings->default_payment_method;
                    $paymentMethodObj = \Stripe\PaymentMethod::retrieve($defaultPaymentMethodId);
                    
                    if ($paymentMethodObj && $paymentMethodObj->card) {
                        $paymentMethod = [
                            'brand' => strtolower($paymentMethodObj->card->brand ?? 'card'),
                            'last4' => $paymentMethodObj->card->last4 ?? '',
                        ];
                    }
                } elseif (isset($stripeSubscription->default_payment_method)) {
                    // Fallback : récupérer depuis l'abonnement directement
                    $paymentMethodObj = \Stripe\PaymentMethod::retrieve($stripeSubscription->default_payment_method);
                    
                    if ($paymentMethodObj && $paymentMethodObj->card) {
                        $paymentMethod = [
                            'brand' => strtolower($paymentMethodObj->card->brand ?? 'card'),
                            'last4' => $paymentMethodObj->card->last4 ?? '',
                        ];
                    }
                }
            } catch (\Exception $e) {
                // En cas d'erreur, on continue sans mode de paiement
                \Log::warning('Failed to retrieve payment method from Stripe', [
                    'subscription_id' => $subscription->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return response()->json([
            'subscription_id' => $subscription->id,
            'freelance_name' => $freelancerName,
            'freelance_avatar_url' => $avatarUrl,
            'freelance_initial' => strtoupper(substr($freelancerName, 0, 1)),
            'hours_per_period' => $hoursPerPeriod,
            'period_label' => 'toutes les 4 semaines',
            'price_per_hour' => number_format($pricePerHour, 2, ',', ' '),
            'subtotal' => number_format($subtotal, 2, ',', ' '),
            'tax_label' => 'Taxes et frais',
            'tax_amount' => number_format($taxAmount, 2, ',', ' '),
            'total' => number_format($total, 2, ',', ' '),
            'renewal_text' => 'Renouvellement automatique toutes les 4 semaines. Nous prélèverons ' . number_format($total, 2, ',', ' ') . ' € sur votre mode de paiement enregistré pour ajouter ' . $hoursPerPeriod . ' heures toutes les 4 semaines, à moins que vous n\'annuliez votre abonnement.',
            'payment_method' => $paymentMethod,
        ]);
    }

    /**
     * Renouveler un abonnement
     */
    public function renew($id, Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user || !$user->clientProfile) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $subscription = Subscription::where('id', $id)
            ->where('client_id', $user->clientProfile->id)
            ->firstOrFail();

        // Vérifier que l'abonnement est actif
        if ($subscription->status !== 'active') {
            return response()->json([
                'error' => 'Cet abonnement ne peut pas être renouvelé dans son état actuel.'
            ], 400);
        }

        // TODO: Implémenter la logique de renouvellement réel avec Stripe
        // Pour l'instant, simulation sécurisée (no-op)
        
        // Simulation : mettre à jour la date de renouvellement
        $subscription->next_billing_at = now()->addWeeks(4);
        $subscription->save();

        return response()->json([
            'success' => true,
            'message' => 'Renouvellement simulé avec succès. Le renouvellement réel sera implémenté avec Stripe.',
            'redirect' => null, // Pas de redirection, le modal se fermera
        ]);
    }
}

