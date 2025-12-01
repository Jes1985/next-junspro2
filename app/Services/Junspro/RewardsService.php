<?php

namespace App\Services\Junspro;

use App\Models\ClientProfile;
use App\Models\Reward;
use Illuminate\Support\Facades\DB;

/**
 * Service de gestion des récompenses clients
 * 
 * Seuils :
 * - 501€ : 1 séance Pilates
 * - 1001€ : 2 séances Pilates
 * - 5001€ : 4 séances Pilates
 */
class RewardsService
{
    /**
     * Vérifier et attribuer des récompenses selon le total dépensé
     *
     * @param ClientProfile $client
     * @return array Récompenses attribuées
     */
    public function checkAndAwardRewards(ClientProfile $client): array
    {
        $totalSpent = $client->total_spent;
        $awardedRewards = [];

        // Seuil 501€
        if ($totalSpent >= 501 && !$this->hasReward($client, '501')) {
            $awardedRewards[] = $this->createReward($client, '501', 1);
        }

        // Seuil 1001€
        if ($totalSpent >= 1001 && !$this->hasReward($client, '1001')) {
            $awardedRewards[] = $this->createReward($client, '1001', 2);
        }

        // Seuil 5001€
        if ($totalSpent >= 5001 && !$this->hasReward($client, '5001')) {
            $awardedRewards[] = $this->createReward($client, '5001', 4);
        }

        return $awardedRewards;
    }

    /**
     * Vérifier si le client a déjà reçu une récompense pour un seuil
     *
     * @param ClientProfile $client
     * @param string $threshold
     * @return bool
     */
    protected function hasReward(ClientProfile $client, string $threshold): bool
    {
        return Reward::where('client_id', $client->id)
            ->where('threshold_reached', $threshold)
            ->exists();
    }

    /**
     * Créer une récompense
     *
     * @param ClientProfile $client
     * @param string $threshold
     * @param int $sessionsCount
     * @return Reward
     */
    protected function createReward(
        ClientProfile $client,
        string $threshold,
        int $sessionsCount
    ): Reward {
        return Reward::create([
            'client_id' => $client->id,
            'threshold_reached' => $threshold,
            'sessions_count' => $sessionsCount,
            'status' => 'pending',
        ]);
    }

    /**
     * Marquer une récompense comme réclamée
     *
     * @param Reward $reward
     * @param string $calendlyLink
     * @return Reward
     */
    public function claimReward(Reward $reward, string $calendlyLink): Reward
    {
        $reward->status = 'claimed';
        $reward->calendly_link = $calendlyLink;
        $reward->save();

        return $reward;
    }

    /**
     * Marquer une récompense comme complétée
     *
     * @param Reward $reward
     * @return Reward
     */
    public function completeReward(Reward $reward): Reward
    {
        $reward->status = 'completed';
        $reward->save();

        return $reward;
    }
}

