<?php

namespace App\Http\Controllers\Junspro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Junspro\CompleteSessionRequest;
use App\Http\Requests\Junspro\RebookSessionRequest;
use App\Services\Junspro\WorkSessionService;
use App\Services\Junspro\RebookingService;
use App\Models\WorkSession;
use App\Models\FreelancerProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WorkSessionController extends Controller
{
    protected WorkSessionService $workSessionService;
    protected RebookingService $rebookingService;

    public function __construct(
        WorkSessionService $workSessionService,
        RebookingService $rebookingService
    ) {
        $this->workSessionService = $workSessionService;
        $this->rebookingService = $rebookingService;
    }

    /**
     * Créer une session de travail
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'start_at' => 'required|date|after:now',
            'delivery_speed' => 'required|in:standard,express_24h,express_48h,express_72h',
            'is_meeting' => 'boolean',
        ]);

        try {
            $subscription = \App\Models\Subscription::findOrFail($request->subscription_id);
            $startAt = Carbon::parse($request->start_at);

            $workSession = $this->workSessionService->createSession(
                $subscription,
                $startAt,
                $request->delivery_speed,
                $request->is_meeting ?? false
            );

            return response()->json([
                'success' => true,
                'message' => 'Session créée avec succès',
                'data' => $workSession,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Compléter une session
     */
    public function complete(CompleteSessionRequest $request): JsonResponse
    {
        try {
            $workSession = WorkSession::findOrFail($request->work_session_id);
            
            $reportFiles = null;
            if ($request->hasFile('report_files')) {
                $reportFiles = [];
                foreach ($request->file('report_files') as $file) {
                    $path = $file->store('reports');
                    $reportFiles[] = $path;
                }
            }

            $workSession = $this->workSessionService->completeSession(
                $workSession,
                $request->report_text,
                $reportFiles
            );

            return response()->json([
                'success' => true,
                'message' => 'Session complétée avec succès',
                'data' => $workSession,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Reprogrammer une session
     */
    public function rebook(RebookSessionRequest $request): JsonResponse
    {
        try {
            $workSession = WorkSession::findOrFail($request->work_session_id);
            $freelancer = FreelancerProfile::where('user_id', auth()->id())->firstOrFail();
            
            $newStartAt = Carbon::parse($request->new_start_at);

            $rebooking = $this->rebookingService->rebook(
                $workSession,
                $freelancer,
                $newStartAt,
                $request->reason
            );

            return response()->json([
                'success' => true,
                'message' => 'Session reprogrammée avec succès',
                'data' => $rebooking,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Liste des sessions
     */
    public function index(Request $request): JsonResponse
    {
        $query = WorkSession::with(['subscription.client.user', 'subscription.freelancer.user']);

        if ($request->has('subscription_id')) {
            $query->where('subscription_id', $request->subscription_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $sessions = $query->orderBy('start_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $sessions,
        ]);
    }
}

