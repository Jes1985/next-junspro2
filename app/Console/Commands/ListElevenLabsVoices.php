<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ListElevenLabsVoices extends Command
{
    protected $signature   = 'formation:list-voices';
    protected $description = 'Liste toutes les voix ElevenLabs disponibles avec leur ID';

    public function handle(): int
    {
        $apiKey = config('services.elevenlabs.api_key', '');

        if (empty($apiKey)) {
            $this->error('ELEVENLABS_API_KEY manquante dans .env');
            return self::FAILURE;
        }

        $response = Http::withHeaders(['xi-api-key' => $apiKey])
            ->withOptions(['verify' => app()->isProduction()])
            ->get('https://api.elevenlabs.io/v1/voices');

        if (!$response->successful()) {
            $this->error('Erreur API ElevenLabs : ' . $response->status() . ' — ' . $response->body());
            return self::FAILURE;
        }

        $voices = collect($response->json('voices', []))
            ->sortBy('name');

        $this->newLine();
        $this->info('🎙  Voix ElevenLabs disponibles  (' . $voices->count() . ' voix)');
        $this->newLine();

        $rows = $voices->map(fn($v) => [
            $v['voice_id'],
            $v['name'],
            $v['labels']['gender']      ?? '—',
            $v['labels']['accent']      ?? '—',
            $v['labels']['description'] ?? '—',
            $v['labels']['use case']    ?? '—',
        ])->values()->toArray();

        $this->table(
            ['Voice ID', 'Nom', 'Genre', 'Accent', 'Description', 'Use case'],
            $rows
        );

        $this->newLine();
        $this->line('→ Teste les voix sur <href=https://elevenlabs.io/app>elevenlabs.io/app</> → Speech → Text to Speech');
        $this->line('→ Puis : php artisan formation:set-voice {voice_id}');
        $this->newLine();

        return self::SUCCESS;
    }
}
