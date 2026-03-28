<?php

namespace App\Jobs;

use App\Services\PsAmbassadeurService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * Job quotidien — Validation des commissions Pause Souffle (J+30)
 *
 * Planifié via Kernel.php : tous les jours à 03:30
 * Système indépendant de ValidateAffiliateConversions (JunsPro générique)
 */
class PsValidateConversions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 3;
    public int $backoff = 60;

    /**
     * Execute the job.
     */
    public function handle(PsAmbassadeurService $psService): void
    {
        Log::info('[PsValidateConversions] Démarrage validation commissions Pause Souffle (délai J+30)...');

        $validated = $psService->validatePendingConversions();

        Log::info("[PsValidateConversions] {$validated} commission(s) PS validée(s).");
    }

    /**
     * Gestion des échecs.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('[PsValidateConversions] Job échoué', [
            'error' => $exception->getMessage(),
            'trace' => substr($exception->getTraceAsString(), 0, 1000),
        ]);
    }
}
