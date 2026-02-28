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
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Gérer les pièces jointes
        $reportFiles = [];
        if ($request->hasFile('attachments')) {
            $uploadPath = public_path('assets/uploads/work-sessions');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move($uploadPath, $filename);
                $reportFiles[] = $filename;
            }
        }

        // Calculer la durée en minutes (1h = 60 min)
        $hoursSpent = (float)$request->input('hours_spent');
        $durationMinutes = (int)($hoursSpent * 60);

        // Construire les dates start_at et end_at
        $workDate = $request->input('work_date');
        $startTime = $request->input('start_time') ?: '00:00';
        $endTime = $request->input('end_time') ?: date('H:i', strtotime("+{$hoursSpent} hours", strtotime($startTime)));

        // Créer la session de travail
        $workSession = WorkSession::create([
            'subscription_id' => $subscription->id,
            'start_at' => $workDate . ' ' . $startTime . ':00',
            'end_at' => $workDate . ' ' . $endTime . ':00',
            'duration_minutes' => $durationMinutes,
            'report_text' => $request->input('work_summary'),
            'report_files' => $reportFiles,
            'status' => 'delivered',
            'rectification_count' => 0,
        ]);

        // Consommer les heures de l'abonnement
        $subscriptionService = app(\App\Services\Junspro\SubscriptionService::class);
        $subscriptionService->consumeHours($subscription, $request->input('hours_spent'));

        // Notifier le client
        $clientUser = $subscription->client->user ?? null;
        if ($clientUser) {
            \App\Models\NotificationLog::create([
                'user_id' => $clientUser->id,
                'channel' => 'email',
                'type' => 'work_session_delivered',
                'content' => json_encode([
                    'work_session_id' => $workSession->id,
                    'subscription_id' => $subscription->id,
                    'freelancer_name' => $freelancerProfile->user->name ?? 'N/A',
                    'hours_spent' => $request->input('hours_spent'),
                ]),
                'sent_at' => now(),
            ]);
        }

        // Log dans audit_logs
        \App\Models\AuditLog::create([
            'user_id' => $user->id,
            'action_type' => 'work_session_created',
            'entity_type' => 'work_session',
            'entity_id' => $workSession->id,
            'metadata' => [
                'subscription_id' => $subscription->id,
                'hours_spent' => $request->input('hours_spent'),
            ],
        ]);

        return back()->with('success', 'Rituel enregistré avec succès. Le client sera notifié.');
    }
}



