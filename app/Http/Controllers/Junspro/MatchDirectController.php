<?php

namespace App\Http\Controllers\Junspro;

use App\Http\Controllers\Controller;
use App\Services\Junspro\MatchDirectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MatchDirectController extends Controller
{
    protected MatchDirectService $matchDirectService;

    public function __construct(MatchDirectService $matchDirectService)
    {
        $this->matchDirectService = $matchDirectService;
    }

    /**
     * Trouver des freelances adaptés (MatchDirect™)
     */
    public function find(Request $request): JsonResponse
    {
        $request->validate([
            'max_hourly_rate' => 'nullable|numeric|min:3|max:200',
            'required_skills' => 'nullable|array',
            'language' => 'nullable|string',
            'timezone' => 'nullable|string',
        ]);

        $freelancers = $this->matchDirectService->findMatchingFreelancers(
            $request->max_hourly_rate,
            $request->required_skills,
            $request->language,
            $request->timezone
        );

        return response()->json([
            'success' => true,
            'data' => $freelancers->load('user'),
        ]);
    }
}

