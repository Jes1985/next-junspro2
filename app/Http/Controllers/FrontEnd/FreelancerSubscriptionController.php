<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Models\FreelancerProfile;
use App\Models\Subscription;
use App\Models\WorkSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FreelancerSubscriptionController extends Controller
{
    /**
     * Dashboard freelance : liste des abonnements
     */
    public function index()
    {
        $misc = new MiscellaneousController();
        $user = Auth::guard('web')->user();
        
        $freelancerProfile = $user->freelancerProfile;
        if (!$freelancerProfile) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Vous devez avoir un profil freelance pour accéder à cette page.');
        }

        $subscriptions = Subscription::where('freelancer_id', $freelancerProfile->id)
            ->with(['client.user', 'workSessions'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('frontend.freelancer.subscriptions.index', [
            'breadcrumb' => $misc->getBreadcrumb(),
            'subscriptions' => $subscriptions,
        ]);
    }

    /**
     * Détails d'un abonnement + formulaire d'enregistrement de session
     */
    public function show($id)
    {
        $misc = new MiscellaneousController();
        $user = Auth::guard('web')->user();
        $freelancerProfile = $user->freelancerProfile;

        $subscription = Subscription::where('freelancer_id', $freelancerProfile->id)
            ->with(['client.user', 'workSessions'])
            ->findOrFail($id);

        $workSessions = WorkSession::where('subscription_id', $subscription->id)
            ->orderByDesc('start_at')
            ->paginate(10);

        return view('frontend.freelancer.subscriptions.show', [
            'breadcrumb' => $misc->getBreadcrumb(),
            'subscription' => $subscription,
            'workSessions' => $workSessions,
        ]);
    }

    /**
     * Enregistrer une session de travail (50/10)
     */
    public function storeWorkSession(Request $request, $id)
    {
        $user = Auth::guard('web')->user();
        $freelancerProfile = $user->freelancerProfile;

        $subscription = Subscription::where('freelancer_id', $freelancerProfile->id)
            ->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'work_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'hours_spent' => 'required|numeric|min:0.5|max:8',
            'work_summary' => 'required|string|min:20',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Créer la session de travail
        $workSession = WorkSession::create([
            'subscription_id' => $subscription->id,
            'freelancer_id' => $freelancerProfile->id,
            'client_id' => $subscription->client_id,
            'work_date' => $request->input('work_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'hours_spent' => $request->input('hours_spent'),
            'work_summary' => $request->input('work_summary'),
            'status' => 'delivered',
            'rectification_count' => 0,
        ]);

        // TODO: Consommer les heures de l'abonnement
        // TODO: Notifier le client
        // TODO: Log dans audit_logs

        return back()->with('success', 'Session de travail enregistrée avec succès. Le client sera notifié.');
    }
}


