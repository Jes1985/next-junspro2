<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Contrôleur pour les schedulers (Projects et HomeSwap)
 */
class SchedulerController extends Controller
{
    /**
     * GET /api/scheduler/projects/context
     * Retourne le contexte pour le ProjectScheduler
     */
    public function projectsContext(Request $request)
    {
        $freelancerId = $request->query('freelancer_id');
        
        // Pour l'instant, retourner des données mock
        // TODO: Remplacer par vraies données depuis la BDD
        
        $now = now();
        $tomorrow = $now->copy()->addDay()->setTime(10, 0);
        
        $kickoffSlots = [];
        for ($i = 0; $i < 6; $i++) {
            $slotDate = $tomorrow->copy()->addDays($i)->setTime(10 + ($i % 3) * 2, 0);
            $kickoffSlots[] = [
                'start' => $slotDate->toIso8601String(),
                'end' => $slotDate->copy()->addMinutes(50)->toIso8601String(),
                'label' => $slotDate->format('D j M à H:i')
            ];
        }
        
        return response()->json([
            'kickoffSlots' => $kickoffSlots,
            'defaultMilestones' => [
                ['id' => 1, 'name' => 'Validation brief', 'order' => 1],
                ['id' => 2, 'name' => '1ère proposition', 'order' => 2],
                ['id' => 3, 'name' => 'Révisions', 'order' => 3],
                ['id' => 4, 'name' => 'Livraison', 'order' => 4]
            ],
            'cadencePresets' => [
                ['id' => 'express', 'label' => 'Express (3–5 jours)', 'days' => 4],
                ['id' => 'standard', 'label' => 'Standard (1–2 semaines)', 'days' => 10],
                ['id' => 'confort', 'label' => 'Confort (2–4 semaines)', 'days' => 21]
            ]
        ]);
    }

    /**
     * POST /api/scheduler/projects/confirm
     * Confirme le lancement d'un projet
     */
    public function projectsConfirm(Request $request)
    {
        $request->validate([
            'freelancer_id' => 'required|integer|exists:freelancer_profiles,id',
            'kickoff_slot' => 'required|date',
            'cadence' => 'required|string|in:express,standard,confort',
            'milestones' => 'required|array'
        ]);

        $user = Auth::guard('web')->user();
        if (!$user) {
            return response()->json([
                'ok' => false,
                'message' => 'Vous devez être connecté.'
            ], 401);
        }

        // TODO: Créer le projet dans la BDD
        // Pour l'instant, retourner succès
        
        return response()->json([
            'ok' => true,
            'success' => true,
            'message' => 'Projet lancé avec succès !'
        ]);
    }

    /**
     * GET /api/scheduler/homeswap/context
     * Retourne le contexte pour le HomeSwapScheduler
     */
    public function homeswapContext(Request $request)
    {
        $freelancerId = $request->query('freelancer_id');
        
        // Pour l'instant, retourner des données mock
        // TODO: Remplacer par vraies données depuis la BDD
        
        return response()->json([
            'disabledDates' => [],
            'minNights' => 2,
            'maxNights' => 180
        ]);
    }

    /**
     * POST /api/scheduler/homeswap/request
     * Envoie une demande d'échange
     */
    public function homeswapRequest(Request $request)
    {
        $request->validate([
            'freelancer_id' => 'required|integer|exists:freelancer_profiles,id',
            'period1' => 'required|array',
            'period1.start' => 'required|date',
            'period1.end' => 'required|date|after:period1.start',
            'period2' => 'nullable|array',
            'period2.start' => 'nullable|date',
            'period2.end' => 'nullable|date|after:period2.start',
            'flexible' => 'boolean'
        ]);

        $user = Auth::guard('web')->user();
        if (!$user) {
            return response()->json([
                'ok' => false,
                'message' => 'Vous devez être connecté.'
            ], 401);
        }

        // Vérifier durée minimum
        $start1 = \Carbon\Carbon::parse($request->period1['start']);
        $end1 = \Carbon\Carbon::parse($request->period1['end']);
        $nights = $start1->diffInDays($end1);
        
        if ($nights < 2) {
            return response()->json([
                'ok' => false,
                'message' => 'La durée minimum est de 2 nuits.'
            ], 400);
        }

        // TODO: Créer la demande dans la BDD
        // Pour l'instant, retourner succès
        
        return response()->json([
            'ok' => true,
            'success' => true,
            'message' => 'Demande envoyée avec succès !'
        ]);
    }
}

