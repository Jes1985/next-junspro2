<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    private string $apiKey;
    private string $baseUrl = 'https://api.openai.com/v1';

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key', '');
    }

    // ──────────────────────────────────────────────
    // TTS — Génération audio (voix Nova, fr)
    // ──────────────────────────────────────────────

    /**
     * Génère un fichier MP3 à partir d'un texte via OpenAI TTS.
     * Découpe automatiquement les textes > 4000 caractères et concatène les binaires MP3.
     * Retourne le contenu binaire du fichier audio.
     */
    public function textToSpeech(string $text, string $voice = 'nova', string $model = 'tts-1-hd', float $speed = 0.9): string
    {
        $maxLength = 4000;

        if (mb_strlen($text) <= $maxLength) {
            return $this->ttsApiCall($text, $voice, $model, $speed);
        }

        // Découper en morceaux sur les fins de phrase ou paragraphes
        $chunks = [];
        while (mb_strlen($text) > 0) {
            if (mb_strlen($text) <= $maxLength) {
                $chunks[] = $text;
                break;
            }
            // Chercher le dernier \n\n ou \n avant la limite
            $slice = mb_substr($text, 0, $maxLength);
            $cutAt = mb_strrpos($slice, "\n\n");
            if ($cutAt === false || $cutAt < $maxLength * 0.5) {
                $cutAt = mb_strrpos($slice, "\n");
            }
            if ($cutAt === false || $cutAt < $maxLength * 0.3) {
                $cutAt = mb_strrpos($slice, '.');
            }
            if ($cutAt === false) {
                $cutAt = $maxLength;
            }
            $chunks[] = trim(mb_substr($text, 0, $cutAt + 1));
            $text     = trim(mb_substr($text, $cutAt + 1));
            sleep(1); // éviter rate limit entre chunks
        }

        $binary = '';
        foreach ($chunks as $chunk) {
            if (trim($chunk) === '') continue;
            $binary .= $this->ttsApiCall($chunk, $voice, $model, $speed);
        }

        return $binary;
    }

    private function ttsApiCall(string $text, string $voice, string $model, float $speed): string
    {
        $response = Http::withToken($this->apiKey)
            ->withOptions(['verify' => app()->isProduction()])
            ->timeout(120)
            ->post("{$this->baseUrl}/audio/speech", [
                'model'           => $model,
                'input'           => $text,
                'voice'           => $voice,
                'response_format' => 'mp3',
                'speed'           => $speed,
            ]);

        if ($response->failed()) {
            Log::error('[OpenAIService] TTS failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            throw new \Exception('OpenAI TTS error: ' . $response->status());
        }

        return $response->body();
    }

    // ──────────────────────────────────────────────
    // Chat — Résumé / Analyse IA
    // ──────────────────────────────────────────────

    /**
     * Envoie un prompt au modèle GPT-4o et retourne la réponse.
     */
    public function chat(string $systemPrompt, string $userMessage, string $model = 'gpt-4o'): string
    {
        $response = Http::withToken($this->apiKey)
            ->withOptions(['verify' => app()->isProduction()])
            ->timeout(60)
            ->post("{$this->baseUrl}/chat/completions", [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user',   'content' => $userMessage],
                ],
                'max_tokens' => 600,
                'temperature' => 0.7,
            ]);

        if ($response->failed()) {
            Log::error('[OpenAIService] Chat failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            throw new \Exception('OpenAI Chat error: ' . $response->status());
        }

        return $response->json('choices.0.message.content', '');
    }

    /**
     * Conversation multi-tours pour le chatbot
     */
    public function chatMultiTurn(array $messages, string $model = 'gpt-4o'): string
    {
        $response = Http::withToken($this->apiKey)
            ->withOptions(['verify' => app()->isProduction()])
            ->timeout(60)
            ->post("{$this->baseUrl}/chat/completions", [
                'model' => $model,
                'messages' => $messages,
                'max_tokens' => 800,
                'temperature' => 0.75,
            ]);

        if ($response->failed()) {
            Log::error('[OpenAIService] ChatMultiTurn failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            throw new \Exception('OpenAI Chat error: ' . $response->status());
        }

        return $response->json('choices.0.message.content', '');
    }
}
