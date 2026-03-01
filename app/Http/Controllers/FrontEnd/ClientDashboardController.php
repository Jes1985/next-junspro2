<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\WorkSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

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
                $clientProfile = \App\Models\ClientProfile::firstOrCreate(['user_id' => $user->id]);
            }

            // Evite les crashes si certaines tables V2 ne sont pas encore migrées.
            if (!Schema::hasTable('work_sessions') || !Schema::hasTable('subscriptions')) {
                return view('frontend.client.dashboard.index', [
                    'nextSession' => null,
                    'upcomingSessions' => collect(),
                    'lastReports' => collect(),
                    'subscriptions' => collect(),
                ]);
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
            Log::error('Erreur dans ClientDashboardController@index: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Pas de redirection vers user.dashboard pour éviter les boucles.
            return view('frontend.client.dashboard.index', [
                'nextSession' => null,
                'upcomingSessions' => collect(),
                'lastReports' => collect(),
                'subscriptions' => collect(),
            ])->with('error', __('Certaines données du dashboard sont indisponibles pour le moment.'));
        }
    }

    /**
     * Page Agenda client — calendrier des sessions bookées semaine par semaine
     */
    public function agenda(Request $request)
    {
        try {
            $user = Auth::guard('web')->user();

            if (!$user) {
                return redirect()->route('user.login');
            }

            $clientProfile = $user->clientProfile;
            if (!$clientProfile) {
                $clientProfile = \App\Models\ClientProfile::firstOrCreate(['user_id' => $user->id]);
            }

            // Semaine courante (navigation via ?week=+1 / ?week=-1)
            $weekOffset = (int) $request->get('week', 0);
            $weekStart  = Carbon::now()->startOfWeek(Carbon::MONDAY)->addWeeks($weekOffset);
            $weekEnd    = $weekStart->copy()->endOfWeek(Carbon::SUNDAY);

            // Sessions de la semaine (bookées + à venir + en cours)
            $sessions = collect();
            if (Schema::hasTable('work_sessions') && Schema::hasTable('subscriptions')) {
                $sessions = WorkSession::whereHas('subscription', function ($q) use ($clientProfile) {
                        $q->where('client_id', $clientProfile->id);
                    })
                    ->whereBetween('start_at', [$weekStart, $weekEnd])
                    ->where('status', '!=', 'cancelled')
                    ->with(['subscription.freelancer.user'])
                    ->orderBy('start_at', 'asc')
                    ->get();
            }

            // Abonnements actifs (pour CTA "Programmer")
            $subscriptions = collect();
            if (Schema::hasTable('subscriptions')) {
                $subscriptions = Subscription::where('client_id', $clientProfile->id)
                    ->whereIn('status', ['active', 'paused'])
                    ->with(['freelancer.user'])
                    ->orderByDesc('created_at')
                    ->get();
            }

            // Prochaine session toutes semaines confondues
            $nextSession = null;
            if (Schema::hasTable('work_sessions')) {
                $nextSession = WorkSession::whereHas('subscription', function ($q) use ($clientProfile) {
                        $q->where('client_id', $clientProfile->id);
                    })
                    ->where('start_at', '>', now())
                    ->where('status', '!=', 'cancelled')
                    ->with(['subscription.freelancer.user'])
                    ->orderBy('start_at', 'asc')
                    ->first();
            }

            return view('frontend.client.agenda.index', [
                'weekStart'     => $weekStart,
                'weekEnd'       => $weekEnd,
                'weekOffset'    => $weekOffset,
                'sessions'      => $sessions,
                'subscriptions' => $subscriptions,
                'nextSession'   => $nextSession,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur ClientDashboardController@agenda: ' . $e->getMessage());

            return view('frontend.client.agenda.index', [
                'weekStart'     => Carbon::now()->startOfWeek(Carbon::MONDAY),
                'weekEnd'       => Carbon::now()->endOfWeek(Carbon::SUNDAY),
                'weekOffset'    => 0,
                'sessions'      => collect(),
                'subscriptions' => collect(),
                'nextSession'   => null,
            ])->with('error', __('Certaines données sont temporairement indisponibles.'));
        }
    }
}
