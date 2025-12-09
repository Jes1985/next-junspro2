<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use App\Services\Junspro\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class FreelancerController extends Controller
{
    public function show($id)
    {
        try {
            $freelancer = FreelancerProfile::with(['user', 'subscriptions'])->findOrFail($id);
            
            if (!$freelancer->user) {
                Log::warning("FreelancerProfile #{$id} n'a pas de user associé");
                abort(404, __('Freelance non trouvé'));
            }

            $user = $freelancer->user;

            // Récupérer les services du freelance (via Seller si existe)
            $services = collect();
            if ($user->seller) {
                $services = \App\Models\ClientService\Service::where('seller_id', $user->seller->id)
                    ->where('service_status', 1)
                    ->with(['content', 'review'])
                    ->limit(6)
                    ->get();
            }

            // Récupérer les avis (reviews) des services du freelance
            $reviews = collect();
            if ($services->isNotEmpty()) {
                $serviceIds = $services->pluck('id');
                $reviews = \App\Models\ClientService\ServiceReview::whereIn('service_id', $serviceIds)
                    ->with(['user', 'service'])
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
                    ->get();
            }

            // Calculer la note moyenne
            $averageRating = $reviews->isNotEmpty() 
                ? $reviews->avg('rating') 
                : ($freelancer->reliability_score / 20); // Convertir reliability_score (0-100) en note (0-5)

            // Disponibilités depuis users.availability
            $availability = $user->availability ?? [];

            return view('frontend.freelance.show', [
                'freelancer' => $freelancer,
                'user' => $user,
                'services' => $services,
                'reviews' => $reviews,
                'averageRating' => round($averageRating, 1),
                'availability' => $availability,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning("FreelancerProfile #{$id} introuvable");
            abort(404, __('Freelance non trouvé'));
        } catch (\Exception $e) {
            Log::error("Erreur dans FreelancerController@show pour ID {$id}: " . $e->getMessage());
            abort(404, __('Erreur lors du chargement du profil freelance'));
        }
    }

    public function startTrial(Request $request, SubscriptionService $subscriptionService, $id)
    {
        $freelancer = FreelancerProfile::with('user')->findOrFail($id);

        $clientUser = Auth::guard('web')->user();
        $clientProfile = $clientUser?->clientProfile;

        if (!$clientProfile) {
            return redirect()->route('user.login')->with('warning', __('Vous devez être connecté en tant que client.'));
        }

        // 1h d’essai, mode standard, sans Stripe pour l’instant (mock)
        $subscriptionService->createSubscription(
            $clientProfile,
            $freelancer,
            1,
            'standard',
            null
        );

        return redirect()->back()->with('success', __('Votre séance d\'essai a été créée. Nous vous recontactons pour le kick-off.'));
    }

    public function subscribe(Request $request, SubscriptionService $subscriptionService, $id)
    {
        $request->validate([
            'weekly_hours' => 'required|in:1,2,4,8,12,16,20,24',
            'delivery_mode' => 'required|in:standard,express_24h,express_48h,express_72h',
        ]);

        $freelancer = FreelancerProfile::with('user')->findOrFail($id);
        $clientUser = Auth::guard('web')->user();
        $clientProfile = $clientUser?->clientProfile;

        if (!$clientProfile) {
            return redirect()->route('user.login')->with('warning', __('Vous devez être connecté en tant que client.'));
        }

        // Calculer le prix
        $hoursTotalMonth = $request->weekly_hours * 4;
        $priceBase = $freelancer->hourly_rate * $request->weekly_hours * 4;
        $finalPrice = $subscriptionService->calculateFinalPrice($priceBase, $request->delivery_mode);

        // Créer une session Stripe Checkout
        try {
            $checkoutSession = $subscriptionService->createStripeCheckoutSession(
                $clientProfile,
                $freelancer,
                $request->weekly_hours,
                $request->delivery_mode,
                $finalPrice
            );

            // Rediriger vers Stripe Checkout
            return redirect($checkoutSession->url);
        } catch (\Exception $e) {
            Log::error('Erreur création session Stripe: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', __('Erreur lors de la création de la session de paiement. Veuillez réessayer.'));
        }
    }

    public function stripeSuccess(Request $request, SubscriptionService $subscriptionService)
    {
        $sessionId = $request->query('session_id');
        
        if (!$sessionId) {
            return redirect()->route('user.dashboard')
                ->with('error', __('Session de paiement invalide.'));
        }

        try {
            // Récupérer les données de l'abonnement depuis la session
            $pendingSubscription = session('pending_subscription');
            
            if (!$pendingSubscription) {
                return redirect()->route('user.dashboard')
                    ->with('error', __('Données d\'abonnement introuvables.'));
            }

            // Récupérer la session Stripe pour obtenir le subscription_id
            $stripeSecret = $this->getStripeSecret();
            \Stripe\Stripe::setApiKey($stripeSecret);
            $stripeSession = \Stripe\Checkout\Session::retrieve($sessionId);
            
            $stripeSubscriptionId = $stripeSession->subscription;

            // Récupérer les profils
            $clientProfile = \App\Models\ClientProfile::findOrFail($pendingSubscription['client_id']);
            $freelancer = FreelancerProfile::findOrFail($pendingSubscription['freelancer_id']);

            // Créer l'abonnement avec le stripe_subscription_id
            $subscription = $subscriptionService->createSubscription(
                $clientProfile,
                $freelancer,
                $pendingSubscription['hours_per_week'],
                $pendingSubscription['delivery_mode'],
                $stripeSubscriptionId
            );

            // Nettoyer la session
            session()->forget(['pending_subscription', 'stripe_checkout_session_id']);

            return redirect()->route('client.subscriptions.show', $subscription->id)
                ->with('success', __('Votre abonnement a été créé avec succès. Un kick-off visio sera programmé avant les premières livraisons.'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'abonnement après paiement Stripe: ' . $e->getMessage());
            return redirect()->route('user.dashboard')
                ->with('error', __('Erreur lors de la création de l\'abonnement. Veuillez contacter le support.'));
        }
    }

    public function stripeCancel()
    {
        // Nettoyer la session
        session()->forget(['pending_subscription', 'stripe_checkout_session_id']);

        return redirect()->route('user.dashboard')
            ->with('info', __('Le paiement a été annulé. Vous pouvez réessayer à tout moment.'));
    }

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
}




