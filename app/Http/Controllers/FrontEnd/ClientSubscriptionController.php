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
     * Dashboard client : Page "Projets & heures"
     */
    public function index()
    {
        $user = Auth::guard('web')->user();
        
        $clientProfile = $user->clientProfile;
        if (!$clientProfile) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Vous devez avoir un profil client pour accéder à cette page.');
        }

        // Projets actifs (abonnements active ou paused)
        $activeSubscriptions = Subscription::where('client_id', $clientProfile->id)
            ->whereIn('status', ['active', 'paused'])
            ->with(['freelancer.user'])
            ->orderByDesc('created_at')
            ->get();

        // Calculer les statistiques pour chaque abonnement actif
        $activeSubscriptions->each(function($subscription) {
            $completedSessions = $subscription->workSessions->where('status', 'completed');
            
            // Heures consommées
            $usedHours = $completedSessions->sum(function($session) {
                return ($session->duration_minutes ?? 60) / 60;
            });
            
            // Total heures (incluant les heures de base du mois)
            $totalHours = $subscription->hours_total_month ?? 0;
            
            // Heures restantes
            if ($subscription->hours_remaining !== null) {
                $calculatedRemaining = max(0, $subscription->hours_remaining);
            } else {
                $calculatedRemaining = max(0, $totalHours - $usedHours);
            }
            
            $subscription->calculated_used_hours = $usedHours;
            $subscription->calculated_total_hours = $totalHours;
            $subscription->calculated_hours_remaining = $calculatedRemaining;
            
            // Pourcentage de progression
            $subscription->calculated_progress_percent = $totalHours > 0 
                ? min(100, ($usedHours / $totalHours) * 100)
                : 0;
            
            // Prochaine session (à venir, non annulée)
            $subscription->next_session = WorkSession::where('subscription_id', $subscription->id)
                ->where('start_at', '>', now())
                ->where('status', '!=', 'cancelled')
                ->orderBy('start_at', 'asc')
                ->first();
            
            // Dernier rapport (dernière session complétée avec rapport)
            $subscription->last_report = WorkSession::where('subscription_id', $subscription->id)
                ->where('status', 'completed')
                ->whereNotNull('report_text')
                ->orderBy('end_at', 'desc')
                ->first();
        });

        // Projets terminés (abonnements cancelled ou ended)
        $archivedSubscriptions = Subscription::where('client_id', $clientProfile->id)
            ->whereIn('status', ['cancelled', 'completed', 'ended'])
            ->with(['freelancer.user', 'workSessions' => function($query) {
                $query->where('status', 'completed');
            }])
            ->orderByDesc('updated_at')
            ->limit(20)
            ->get();

        // Calculer les heures totales pour les projets terminés
        $archivedSubscriptions->each(function($subscription) {
            $totalHours = $subscription->workSessions->sum(function($session) {
                return ($session->duration_minutes ?? 60) / 60;
            });
            $subscription->total_hours_worked = $totalHours;
        });

        // Statistiques globales (bandeau synthèse)
        // Calculer la prochaine session globale (la plus proche)
        $allNextSessions = [];
        foreach ($activeSubscriptions as $sub) {
            $nextSession = WorkSession::where('subscription_id', $sub->id)
                ->where('start_at', '>', now())
                ->where('status', '!=', 'cancelled')
                ->orderBy('start_at', 'asc')
                ->first();
            
            if ($nextSession) {
                $allNextSessions[] = [
                    'session' => $nextSession,
                    'subscription' => $sub,
                    'freelancer' => $sub->freelancer->user ?? null,
                ];
            }
        }
        
        // Trier par date et prendre la plus proche
        usort($allNextSessions, function($a, $b) {
            return $a['session']->start_at <=> $b['session']->start_at;
        });
        
        $stats = [
            'active_projects_count' => $activeSubscriptions->count(),
            'total_hours_remaining_this_week' => $activeSubscriptions->sum('calculated_hours_remaining'),
            'next_session' => !empty($allNextSessions) ? $allNextSessions[0] : null,
        ];

        // Heures consommées ce mois-ci (toutes subscriptions confondues)
        $currentMonthStart = now()->startOfMonth();
        $currentMonthSessions = WorkSession::whereHas('subscription', function($query) use ($clientProfile) {
                $query->where('client_id', $clientProfile->id);
            })
            ->where('status', 'completed')
            ->where('end_at', '>=', $currentMonthStart)
            ->get();
        
        $stats['hours_consumed_this_month'] = $currentMonthSessions->sum(function($session) {
            return ($session->duration_minutes ?? 60) / 60;
        });

        // Heures prévues sur les 7 prochains jours
        $nextWeekEnd = now()->addDays(7);
        $nextWeekSessions = WorkSession::whereHas('subscription', function($query) use ($clientProfile) {
                $query->where('client_id', $clientProfile->id);
            })
            ->where('start_at', '>', now())
            ->where('start_at', '<=', $nextWeekEnd)
            ->where('status', '!=', 'cancelled')
            ->get();
        
        $stats['hours_planned_next_7_days'] = $nextWeekSessions->count(); // Nombre de sessions prévues

        return view('frontend.client.subscriptions.index', [
            'activeSubscriptions' => $activeSubscriptions,
            'archivedSubscriptions' => $archivedSubscriptions,
            'stats' => $stats,
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

