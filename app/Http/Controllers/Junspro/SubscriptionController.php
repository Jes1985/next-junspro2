<?php

namespace App\Http\Controllers\Junspro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Junspro\CreateSubscriptionRequest;
use App\Services\Junspro\SubscriptionService;
use App\Models\ClientProfile;
use App\Models\FreelancerProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Créer un nouvel abonnement
     */
    public function store(CreateSubscriptionRequest $request): JsonResponse
    {
        try {
            // Récupérer le client (à adapter selon votre logique d'auth)
            $client = ClientProfile::where('user_id', auth()->id())->firstOrFail();
            $freelancer = FreelancerProfile::findOrFail($request->freelancer_id);

            $subscription = $this->subscriptionService->createSubscription(
                $client,
                $freelancer,
                $request->hours_per_week,
                $request->delivery_mode
            );

            return response()->json([
                'success' => true,
                'message' => 'Abonnement créé avec succès',
                'data' => $subscription,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Liste des abonnements d'un client
     */
    public function index(Request $request): JsonResponse
    {
        $client = ClientProfile::where('user_id', auth()->id())->firstOrFail();
        
        $subscriptions = $client->subscriptions()
            ->with(['freelancer.user', 'workSessions'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $subscriptions,
        ]);
    }

    /**
     * Détails d'un abonnement
     */
    public function show(int $id): JsonResponse
    {
        $subscription = \App\Models\Subscription::with([
            'client.user',
            'freelancer.user',
            'workSessions'
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $subscription,
        ]);
    }

    /**
     * Mettre en pause un abonnement
     */
    public function pause(int $id): JsonResponse
    {
        $subscription = \App\Models\Subscription::findOrFail($id);
        $this->subscriptionService->pauseSubscription($subscription);

        return response()->json([
            'success' => true,
            'message' => 'Abonnement mis en pause',
        ]);
    }

    /**
     * Reprendre un abonnement
     */
    public function resume(int $id): JsonResponse
    {
        $subscription = \App\Models\Subscription::findOrFail($id);
        $this->subscriptionService->resumeSubscription($subscription);

        return response()->json([
            'success' => true,
            'message' => 'Abonnement repris',
        ]);
    }

    /**
     * Annuler un abonnement
     */
    public function cancel(int $id): JsonResponse
    {
        $subscription = \App\Models\Subscription::findOrFail($id);
        $this->subscriptionService->cancelSubscription($subscription);

        return response()->json([
            'success' => true,
            'message' => 'Abonnement annulé',
        ]);
    }
}

