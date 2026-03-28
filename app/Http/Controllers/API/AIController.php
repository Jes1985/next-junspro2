<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\OpenAIService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AIController extends Controller
{
    public function __construct(private OpenAIService $ai) {}

    // ──────────────────────────────────────────────
    // Chatbot site-wide
    // ──────────────────────────────────────────────

    public function chat(Request $request): JsonResponse
    {
        $request->validate([
            'messages' => 'required|array|max:20',
            'messages.*.role'    => 'required|in:user,assistant',
            'messages.*.content' => 'required|string|max:1000',
        ]);

        $systemPrompt = <<<PROMPT
Tu es l'assistant virtuel de Junspro, une plateforme de Rituels professionnels en France.
Tu t'appelles "Juns" et tu réponds toujours en français, avec bienveillance et clarté.
Tu peux aider sur :
- Les services Junspro (Rituels, Pause Souffle, freelances, NEXUS, formation)
- La formation Praticien Pause Souffle (6 modules, 3490€ ou 3×1164€, attestation)
- Le programme Apporteurs d'Affaires (jusqu'à 10% de commission)
- Les abonnements et réservations
Tu ne donnes pas de conseils médicaux ou juridiques. Si on te demande quelque chose hors de ton périmètre, oriente poliment vers la bonne ressource.
Réponds en 2-4 phrases maximum, sauf si on te demande plus de détails.
PROMPT;

        $messages = array_merge(
            [['role' => 'system', 'content' => $systemPrompt]],
            $request->input('messages')
        );

        try {
            $reply = $this->ai->chatMultiTurn($messages);
            return response()->json(['reply' => $reply]);
        } catch (\Exception $e) {
            Log::error('[AIController::chat] ' . $e->getMessage());
            return response()->json(['reply' => "Désolé, je ne suis pas disponible en ce moment. Réessaie dans quelques instants."], 200);
        }
    }

    // ──────────────────────────────────────────────
    // Résumé IA dashboard client
    // ──────────────────────────────────────────────

    public function clientSummary(Request $request): JsonResponse
    {
        $user = Auth::guard('web')->user();
        if (!$user) return response()->json(['error' => 'Non autorisé'], 401);

        $request->validate([
            'sessions_count'  => 'nullable|integer',
            'next_session'    => 'nullable|string|max:200',
            'subscriptions'   => 'nullable|array',
        ]);

        $systemPrompt = "Tu es un assistant bienveillant pour Junspro. Tu génères des résumés courts, motivants et personnalisés pour les clients. Réponds en 3-4 phrases maximum, en français, au ton chaleureux et professionnel.";

        $sessionsCount   = $request->input('sessions_count', 0);
        $nextSession     = $request->input('next_session', '');
        $subscriptions   = $request->input('subscriptions', []);
        $subCount        = count($subscriptions);

        $userMessage = "Génère un résumé motivant pour {$user->first_name}. "
            . "Ils ont {$sessionsCount} session(s) planifiée(s), "
            . ($nextSession ? "leur prochaine session est le {$nextSession}, " : "")
            . "et {$subCount} abonnement(s) actif(s). "
            . "Encourage-les à continuer leur progression avec Junspro.";

        try {
            $summary = $this->ai->chat($systemPrompt, $userMessage);
            return response()->json(['summary' => $summary]);
        } catch (\Exception $e) {
            Log::error('[AIController::clientSummary] ' . $e->getMessage());
            return response()->json(['summary' => null], 200);
        }
    }

    // ──────────────────────────────────────────────
    // Résumé IA dashboard freelance
    // ──────────────────────────────────────────────

    public function freelanceSummary(Request $request): JsonResponse
    {
        $user = Auth::guard('web')->user();
        if (!$user) return response()->json(['error' => 'Non autorisé'], 401);

        $request->validate([
            'active_clients'  => 'nullable|integer',
            'sessions_done'   => 'nullable|integer',
            'revenue_month'   => 'nullable|numeric',
            'rating'          => 'nullable|numeric',
        ]);

        $systemPrompt = "Tu es un coach professionnel bienveillant pour les freelances de Junspro. Tu génères des conseils courts, motivants et actionnables. Réponds en 3-4 phrases, en français, ton énergique et constructif.";

        $activeClients = $request->input('active_clients', 0);
        $sessionsDone  = $request->input('sessions_done', 0);
        $revenueMonth  = $request->input('revenue_month', 0);
        $rating        = $request->input('rating', null);

        $userMessage = "Génère un message de motivation et de conseil pour {$user->first_name}, freelance Junspro. "
            . "Ce mois : {$activeClients} client(s) actif(s), {$sessionsDone} session(s) réalisée(s), "
            . "{$revenueMonth}€ de revenus"
            . ($rating ? ", note moyenne {$rating}/5" : "") . ". "
            . "Donne un conseil actionnable pour améliorer son activité.";

        try {
            $summary = $this->ai->chat($systemPrompt, $userMessage);
            return response()->json(['summary' => $summary]);
        } catch (\Exception $e) {
            Log::error('[AIController::freelanceSummary] ' . $e->getMessage());
            return response()->json(['summary' => null], 200);
        }
    }
}
