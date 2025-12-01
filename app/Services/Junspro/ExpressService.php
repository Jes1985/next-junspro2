<?php

namespace App\Services\Junspro;

use App\Models\WorkSession;
use App\Models\FreelancerProfile;
use Carbon\Carbon;

/**
 * Service de gestion de la livraison Express
 */
class ExpressService
{
    /**
     * Calculer le prix Express pour une session
     *
     * @param float $basePrice Prix de base
     * @param string $deliverySpeed 'express_24h', 'express_48h', 'express_72h'
     * @return float Prix avec surcharge
     */
    public function calculateExpressPrice(float $basePrice, string $deliverySpeed): float
    {
        return match($deliverySpeed) {
            'express_24h' => $basePrice * 1.30,
            'express_48h' => $basePrice * 1.20,
            'express_72h' => $basePrice * 1.10,
            default => $basePrice,
        };
    }

    /**
     * Calculer la deadline selon le mode Express
     *
     * @param string $deliverySpeed
     * @return Carbon
     */
    public function calculateDeadline(string $deliverySpeed): Carbon
    {
        return match($deliverySpeed) {
            'express_24h' => now()->addHours(24),
            'express_48h' => now()->addHours(48),
            'express_72h' => now()->addHours(72),
            default => now()->addDays(7), // Standard: 7 jours par défaut
        };
    }

    /**
     * Vérifier si une session Express est en retard
     *
     * @param WorkSession $workSession
     * @return bool
     */
    public function isLate(WorkSession $workSession): bool
    {
        if ($workSession->delivery_speed === 'standard') {
            return false;
        }

        if (!$workSession->deadline_at) {
            return false;
        }

        return $workSession->deadline_at->isPast() && $workSession->status !== 'completed';
    }

    /**
     * Marquer une session comme en retard et pénaliser le freelance
     *
     * @param WorkSession $workSession
     * @return void
     */
    public function markAsLate(WorkSession $workSession): void
    {
        $workSession->status = 'late';
        $workSession->save();

        // Pénaliser le score de fiabilité
        $freelancer = $workSession->subscription->freelancer;
        $this->penalizeReliabilityScore($freelancer);
    }

    /**
     * Pénaliser le score de fiabilité d'un freelance
     *
     * @param FreelancerProfile $freelancer
     * @param int $penalty Points à retirer (défaut: 5)
     * @return void
     */
    protected function penalizeReliabilityScore(FreelancerProfile $freelancer, int $penalty = 5): void
    {
        $newScore = max(0, $freelancer->reliability_score - $penalty);
        $freelancer->reliability_score = $newScore;
        $freelancer->save();
    }
}

