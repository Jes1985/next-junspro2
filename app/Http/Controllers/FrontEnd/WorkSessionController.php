<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\WorkSession;
use App\Models\Subscription;
use App\Services\Junspro\RectificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkSessionController extends Controller
{
    protected RectificationService $rectificationService;

    public function __construct(RectificationService $rectificationService)
    {
        $this->rectificationService = $rectificationService;
    }

    /**
     * Demander une rectification pour une session de travail
     */
    public function requestRectification(Request $request, $id)
    {
        $user = Auth::guard('web')->user();
        $clientProfile = $user->clientProfile;

        if (!$clientProfile) {
            return back()->with('error', __('Vous devez être connecté en tant que client.'));
        }

        $workSession = WorkSession::with('subscription')
            ->whereHas('subscription', function($query) use ($clientProfile) {
                $query->where('client_id', $clientProfile->id);
            })
            ->findOrFail($id);

        $request->validate([
            'reason' => 'required|string|min:10',
        ]);

        $result = $this->rectificationService->processRectificationRequest(
            $workSession,
            $request->input('reason')
        );

        if ($result['accepted']) {
            return back()->with('success', $result['message']);
        } else {
            return back()->with('error', $result['message']);
        }
    }
}

