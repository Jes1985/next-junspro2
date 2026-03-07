<?php

namespace App\Jobs;

use App\Services\Junspro\AffiliateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ValidateAffiliateConversions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Nombre maximum de tentatives en cas d'échec.
     */
    public int $tries = 3;

    /**
     * Délai entre les tentatives (secondes).
     */
    public int $backoff = 60;

    /**
     * Execute the job.
     */
    public function handle(AffiliateService $affiliateService): void
    {
        Log::info('[ValidateAffiliateConversions] Démarrage validation des commissions J+7...');

        $validated = $affiliateService->validatePendingConversions();

        Log::info("[ValidateAffiliateConversions] {$validated} commission(s) validée(s).");
    }

    /**
     * Gestion des échecs.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('[ValidateAffiliateConversions] Job échoué', [
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);
    }
}
