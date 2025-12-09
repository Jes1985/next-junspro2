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
     * Traiter l'annulation (avec anti-churn 4 étapes)
     */
    public function cancel(Request $request, $id)
    {
        $user = Auth::guard('web')->user();
        $clientProfile = $user->clientProfile;

        $subscription = Subscription::where('client_id', $clientProfile->id)
            ->findOrFail($id);

        $action = $request->input('action');

        // Étape 1 : Alternatives proposées
        if ($action === 'alternative') {
            $alternative = $request->input('alternative');
            
            if ($alternative === 'pause') {
                $this->subscriptionService->pauseSubscription($subscription);
                return redirect()->route('client.subscriptions.index')
                    ->with('success', __('Votre abonnement a été mis en pause. Vous pouvez le reprendre à tout moment.'));
            }

            if ($alternative === 'change_freelancer') {
                // Activer le transfert
                $subscription->update(['can_transfer' => true]);
                return redirect()->route('client.subscriptions.transfer', $id)
                    ->with('info', __('Vous pouvez transférer votre abonnement vers un autre freelance.'));
            }

            if ($alternative === 'modify_formula') {
                return redirect()->route('client.subscriptions.edit', $id)
                    ->with('info', __('Vous pouvez modifier votre formule d\'abonnement.'));
            }
        }

        // Étape 2 : Confirmation avec raison (gérée par le formulaire JavaScript)
        if ($action === 'confirm_cancel') {
            // Cette étape est gérée côté client, on passe à l'étape 4
            $reason = $request->input('reason', 'Non spécifié');
            $reasonDetails = $request->input('reason_details');
            
            // On affiche l'étape 4 (dernière offre) via JavaScript
            return back()->withInput();
        }

        // Étape 4 : Dernière offre
        if ($action === 'final_offer') {
            $finalAction = $request->input('final_action');
            $reason = $request->input('reason', 'Non spécifié');
            
            if ($finalAction === 'find_freelancer') {
                $subscription->update(['can_transfer' => true]);
                return redirect()->route('explore')
                    ->with('info', __('Recherchez un nouveau freelance pour votre projet.'));
            }

            if ($finalAction === 'keep') {
                return redirect()->route('client.subscriptions.index')
                    ->with('success', __('Votre abonnement reste actif. Merci de votre confiance !'));
            }

            // Si "Pas maintenant", on continue avec l'annulation
            if ($finalAction === 'cancel') {
                // Annulation définitive
                $this->subscriptionService->cancelSubscription($subscription);
                
                // Arrêter le renouvellement Stripe si existe
                if ($subscription->stripe_subscription_id) {
                    try {
                        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
                        $stripeSubscription = \Stripe\Subscription::retrieve($subscription->stripe_subscription_id);
                        $stripeSubscription->cancel();
                    } catch (\Exception $e) {
                        \Log::warning('Failed to cancel Stripe subscription', [
                            'subscription_id' => $subscription->id,
                            'stripe_id' => $subscription->stripe_subscription_id,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
                
                // Log dans audit_logs
                \App\Models\AuditLog::create([
                    'user_id' => $user->id,
                    'action_type' => 'subscription_cancelled',
                    'entity_type' => 'subscription',
                    'entity_id' => $subscription->id,
                    'metadata' => [
                        'reason' => $reason,
                        'reason_details' => $request->input('reason_details'),
                        'stripe_subscription_id' => $subscription->stripe_subscription_id,
                    ],
                ]);
                
                return redirect()->route('client.subscriptions.index')
                    ->with('success', __('Votre abonnement a été annulé. Aucun nouveau débit ne sera effectué.'));
            }
        }

        return back()->with('error', __('Action non reconnue.'));
    }
}

