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

        return redirect()->back()->with('success', __('Votre séance d’essai a été créée. Nous vous recontactons pour le kick-off.'));
    }
}



