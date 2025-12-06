<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use App\Services\Junspro\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerController extends Controller
{
    public function show($id)
    {
        $freelancer = FreelancerProfile::with('user')->findOrFail($id);

        return view('frontend.freelance.show', [
            'freelancer' => $freelancer,
            'user' => $freelancer->user,
        ]);
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

        return redirect()->back()->with('success', __('Votre séance d'essai a été créée. Nous vous recontactons pour le kick-off.'));
    }

    public function subscribe(Request $request, SubscriptionService $subscriptionService, $id)
    {
        $request->validate([
            'weekly_hours' => 'required|in:1,2,4,8,12,16',
            'express_24h' => 'nullable|boolean',
            'express_48h' => 'nullable|boolean',
            'express_72h' => 'nullable|boolean',
        ]);

        $freelancer = FreelancerProfile::with('user')->findOrFail($id);
        $clientUser = Auth::guard('web')->user();
        $clientProfile = $clientUser?->clientProfile;

        if (!$clientProfile) {
            return redirect()->route('user.login')->with('warning', __('Vous devez être connecté en tant que client.'));
        }

        // Déterminer le mode de livraison
        $deliveryMode = 'standard';
        if ($request->boolean('express_24h')) {
            $deliveryMode = 'express_24h';
        } elseif ($request->boolean('express_48h')) {
            $deliveryMode = 'express_48h';
        } elseif ($request->boolean('express_72h')) {
            $deliveryMode = 'express_72h';
        }

        // Créer l'abonnement
        $subscription = $subscriptionService->createSubscription(
            $clientProfile,
            $freelancer,
            $request->weekly_hours,
            $deliveryMode,
            null // Stripe subscription ID sera ajouté après paiement
        );

        return redirect()->route('client.subscriptions.show', $subscription->id)
            ->with('success', __('Votre abonnement a été créé. Un kick-off visio sera programmé avant les premières livraisons.'));
    }
}




