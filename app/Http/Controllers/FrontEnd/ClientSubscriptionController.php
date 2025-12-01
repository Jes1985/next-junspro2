<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Models\ClientProfile;
use App\Models\Subscription;
use App\Models\WorkSession;
use App\Services\Junspro\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientSubscriptionController extends Controller
{
    protected SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Dashboard client : liste des abonnements
     */
    public function index()
    {
        $misc = new MiscellaneousController();
        $user = Auth::guard('web')->user();
        
        $clientProfile = $user->clientProfile;
        if (!$clientProfile) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Vous devez avoir un profil client pour accéder à cette page.');
        }

        $subscriptions = Subscription::where('client_id', $clientProfile->id)
            ->with(['freelancer.user', 'workSessions'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('frontend.client.subscriptions.index', [
            'breadcrumb' => $misc->getBreadcrumb(),
            'subscriptions' => $subscriptions,
        ]);
    }

    /**
     * Détails d'un abonnement + liste des livraisons
     */
    public function show($id)
    {
        $misc = new MiscellaneousController();
        $user = Auth::guard('web')->user();
        $clientProfile = $user->clientProfile;

        $subscription = Subscription::where('client_id', $clientProfile->id)
            ->with(['freelancer.user', 'workSessions'])
            ->findOrFail($id);

        $workSessions = WorkSession::where('subscription_id', $subscription->id)
            ->orderByDesc('start_at')
            ->paginate(10);

        return view('frontend.client.subscriptions.show', [
            'breadcrumb' => $misc->getBreadcrumb(),
            'subscription' => $subscription,
            'workSessions' => $workSessions,
        ]);
    }

    /**
     * Mettre en pause un abonnement
     */
    public function pause($id)
    {
        $user = Auth::guard('web')->user();
        $clientProfile = $user->clientProfile;

        $subscription = Subscription::where('client_id', $clientProfile->id)
            ->findOrFail($id);

        if ($subscription->status !== 'active') {
            return back()->with('error', 'Seuls les abonnements actifs peuvent être mis en pause.');
        }

        $this->subscriptionService->pauseSubscription($subscription);

        return back()->with('success', 'Votre abonnement a été mis en pause.');
    }

    /**
     * Reprendre un abonnement
     */
    public function resume($id)
    {
        $user = Auth::guard('web')->user();
        $clientProfile = $user->clientProfile;

        $subscription = Subscription::where('client_id', $clientProfile->id)
            ->findOrFail($id);

        try {
            $this->subscriptionService->resumeSubscription($subscription);
            return back()->with('success', 'Votre abonnement a été repris.');
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Afficher le formulaire d'annulation (anti-churn 4 étapes)
     */
    public function showCancelForm($id)
    {
        $misc = new MiscellaneousController();
        $user = Auth::guard('web')->user();
        $clientProfile = $user->clientProfile;

        $subscription = Subscription::where('client_id', $clientProfile->id)
            ->with(['freelancer.user'])
            ->findOrFail($id);

        return view('frontend.client.subscriptions.cancel', [
            'breadcrumb' => $misc->getBreadcrumb(),
            'subscription' => $subscription,
        ]);
    }

    /**
     * Traiter l'annulation (avec anti-churn)
     */
    public function cancel(Request $request, $id)
    {
        $user = Auth::guard('web')->user();
        $clientProfile = $user->clientProfile;

        $subscription = Subscription::where('client_id', $clientProfile->id)
            ->findOrFail($id);

        $action = $request->input('action');

        // Étape 1 : Alternatives proposées
        if ($action === 'pause') {
            $this->subscriptionService->pauseSubscription($subscription);
            return back()->with('success', 'Votre abonnement a été mis en pause. Vous pouvez le reprendre à tout moment.');
        }

        if ($action === 'change_freelancer') {
            // Rediriger vers la page de transfert
            return redirect()->route('client.subscriptions.transfer', $id)
                ->with('info', 'Vous pouvez transférer votre abonnement vers un autre freelance.');
        }

        if ($action === 'modify_formula') {
            // Rediriger vers la page de modification de formule
            return redirect()->route('client.subscriptions.edit', $id)
                ->with('info', 'Vous pouvez modifier votre formule d\'abonnement.');
        }

        // Étape 2 : Confirmation avec raison
        if ($action === 'confirm_cancel') {
            $reason = $request->input('reason', 'Non spécifié');
            
            // Étape 3 : Dernière offre
            $misc = new MiscellaneousController();
            return view('frontend.client.subscriptions.cancel-confirm', [
                'breadcrumb' => $misc->getBreadcrumb(),
                'subscription' => $subscription,
                'reason' => $reason,
            ]);
        }

        // Étape 4 : Annulation définitive
        if ($action === 'final_cancel') {
            $this->subscriptionService->cancelSubscription($subscription);
            
            // TODO: Arrêter le renouvellement Stripe
            // TODO: Log dans audit_logs
            
            return redirect()->route('client.subscriptions.index')
                ->with('success', 'Votre abonnement a été annulé. Aucun nouveau débit ne sera effectué.');
        }

        return back()->with('error', 'Action non reconnue.');
    }
}

