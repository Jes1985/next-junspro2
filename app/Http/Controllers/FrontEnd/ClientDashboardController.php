<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\WorkSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClientDashboardController extends Controller
{
    /**
     * Page d'accueil du dashboard client
     */
    public function index()
    {
        try {
            $user = Auth::guard('web')->user();
            
            if (!$user) {
                return redirect()->route('user.login')
                    ->with('error', __('Vous devez être connecté pour accéder à cette page.'));
            }
            
            $clientProfile = $user->clientProfile;
            if (!$clientProfile) {
                return redirect()->route('user.dashboard')
                    ->with('error', __('Vous devez avoir un profil client pour accéder à cette page.'));
            }

            // Récupérer la prochaine session (workSession à venir)
            $nextSession = WorkSession::whereHas('subscription', function($query) use ($clientProfile) {
                    $query->where('client_id', $clientProfile->id);
                })
                ->where('start_at', '>', now())
                ->where('status', '!=', 'cancelled')
                ->with(['subscription.freelancer.user'])
                ->orderBy('start_at', 'asc')
                ->first();

        // Récupérer les prochaines sessions (3-5 suivantes, excluant la prochaine)
        $upcomingSessionsQuery = WorkSession::whereHas('subscription', function($query) use ($clientProfile) {
                $query->where('client_id', $clientProfile->id);
            })
            ->where('start_at', '>', now())
            ->where('status', '!=', 'cancelled')
            ->with(['subscription.freelancer.user'])
            ->orderBy('start_at', 'asc');
        
        // Exclure la prochaine session si elle existe
        if ($nextSession) {
            $upcomingSessionsQuery->where('id', '!=', $nextSession->id);
        }
        
        $upcomingSessions = $upcomingSessionsQuery->limit(5)->get();

        // Récupérer les 3 derniers rapports (sessions complétées avec rapport)
        $lastReports = WorkSession::whereHas('subscription', function($query) use ($clientProfile) {
                $query->where('client_id', $clientProfile->id);
            })
            ->where('status', 'completed')
            ->whereNotNull('report_text')
            ->with(['subscription.freelancer.user'])
            ->orderBy('end_at', 'desc')
            ->limit(3)
            ->get();

        // Récupérer les abonnements actifs
        $subscriptions = Subscription::where('client_id', $clientProfile->id)
            ->whereIn('status', ['active', 'paused'])
            ->with(['freelancer.user', 'workSessions' => function($query) {
                $query->where('status', 'completed')->orderBy('end_at', 'desc');
            }])
            ->orderByDesc('created_at')
            ->get();

        // Calculer les heures restantes pour chaque abonnement
        $subscriptions->each(function($subscription) {
            // Récupérer toutes les sessions complétées pour cet abonnement
            $completedSessions = WorkSession::where('subscription_id', $subscription->id)
                ->where('status', 'completed')
                ->get();
            
            $usedHours = $completedSessions->sum(function($session) {
                return ($session->duration_minutes ?? 60) / 60;
            });
            
            // Utiliser hours_remaining si disponible, sinon calculer depuis hours_total_month
            if ($subscription->hours_remaining !== null) {
                $subscription->calculated_hours_remaining = max(0, $subscription->hours_remaining);
            } else {
                $subscription->calculated_hours_remaining = max(0, ($subscription->hours_total_month ?? 0) - $usedHours);
            }
        });

            return view('frontend.client.dashboard.index', [
                'nextSession' => $nextSession,
                'upcomingSessions' => $upcomingSessions,
                'lastReports' => $lastReports,
                'subscriptions' => $subscriptions,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur dans ClientDashboardController@index: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('user.dashboard')
                ->with('error', __('Une erreur est survenue lors du chargement du dashboard. Veuillez réessayer.'));
        }
    }
}
