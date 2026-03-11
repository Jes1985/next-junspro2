<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service ElevenLabs TTS — modèle eleven_multilingual_v2
 *
 * Voix par défaut : Natasha - Gentle Meditation — douce, apaisante, conçue pour la méditation
 * Voice ID        : Atp5cNFg1Wj5gyKD7HWV
 *
 * Paramètres méditation :
 *   stability       = 0.88  → voix stable, zéro variation parasite
 *   similarity_boost= 0.75  → timbre naturel, non traité
 *   style           = 0.00  → zéro expressivité / dramatisme = calme pur
 *   use_speaker_boost= false → son plus naturel, moins traité
 *   language_code   = "fr"/"en" → langue verrouillée, zéro mélange
 *
 * Limite par appel : 4 800 chars → chunking automatique intégré
 */
class ElevenLabsService
{
    private string $apiKey;
    private string $baseUrl = 'https://api.elevenlabs.io/v1';

    // Natasha - Gentle Meditation : voix douce et apaisante — conçue pour la méditation guidée
    public const DEFAULT_VOICE_ID = 'Atp5cNFg1Wj5gyKD7HWV';
    public const MODEL             = 'eleven_multilingual_v2';

    public function __construct()
    {
        $this->apiKey = config('services.elevenlabs.api_key', '');
    }

    public function textToSpeech(
        string  $text,
        string  $voiceId      = self::DEFAULT_VOICE_ID,
        float   $stability    = 0.88,
        float   $similarity   = 0.75,
        float   $style        = 0.00,
        ?string $languageCode = null
    ): string {
        $maxLength = 4800;

        if (mb_strlen($text) <= $maxLength) {
            return $this->ttsApiCall($text, $voiceId, $stability, $similarity, $style, $languageCode);
        }

        // Découpage sur fins de phrase / paragraphes
        $chunks = [];
        while (mb_strlen($text) > 0) {
            if (mb_strlen($text) <= $maxLength) {
                $chunks[] = $text;
                break;
            }
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
            sleep(1);
        }

        $binary = '';
        foreach ($chunks as $chunk) {
            if (trim($chunk) === '') continue;
            $binary .= $this->ttsApiCall($chunk, $voiceId, $stability, $similarity, $style, $languageCode);
            sleep(1);
        }

        return $binary;
    }

    private function ttsApiCall(
        string  $text,
        string  $voiceId,
        float   $stability,
        float   $similarity,
        float   $style,
        ?string $languageCode = null
    ): string {
        $payload = [
            'text'       => $text,
            'model_id'   => self::MODEL,
            'voice_settings' => [
                'stability'        => $stability,
                'similarity_boost' => $similarity,
                'style'            => $style,
                'use_speaker_boost'=> false,
            ],
        ];
        // Verrouille la langue pour éviter le mélange FR/EN automatique
        if ($languageCode !== null) {
            $payload['language_code'] = $languageCode;
        }

        $response = Http::withHeaders([
                'xi-api-key'   => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'audio/mpeg',
            ])
            ->withOptions(['verify' => app()->isProduction()])
            ->timeout(120)
            ->post("{$this->baseUrl}/text-to-speech/{$voiceId}", $payload);

        if (!$response->successful()) {
            $status = $response->status();
            $body   = $response->body();
            Log::error("ElevenLabs TTS error {$status}: {$body}");
            throw new \Exception("ElevenLabs TTS error {$status}: {$body}");
        }

        return $response->body();
    }
}
