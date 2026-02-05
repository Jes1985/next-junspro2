<?php

namespace App\Services;

use App\Models\ClientFreelancerStat;

class PricingService
{
    /**
     * Prix payé par le client (base + 10 % intégrés)
     */
    public function getClientHourlyRate(float $baseRate): float
    {
        return round($baseRate * 1.10, 2);
    }

    /**
     * Renvoie le taux de commission applicable pour la paire client/freelance.
     * 0–1000 => 20%, 1001–5000 => 16%, 5001+ => 12%
     */
    public function getCommissionRateForPair(int $clientId, int $freelancerId): float
    {
        $stat = ClientFreelancerStat::firstOrCreate(
            ['client_id' => $clientId, 'freelancer_id' => $freelancerId],
            ['total_base_amount' => 0, 'total_client_amount' => 0, 'current_commission_rate' => 0.20]
        );

        $total = (float) $stat->total_base_amount;

        if ($total >= 5000) {
            $rate = 0.12;
        } elseif ($total >= 1000) {
            $rate = 0.16;
        } else {
            $rate = 0.20;
        }

        // stocker le taux courant pour info
        if ((float) $stat->current_commission_rate !== $rate) {
            $stat->current_commission_rate = $rate;
            $stat->save();
        }

        return $rate;
    }

    /**
     * Ventile une heure de travail.
     */
    public function computeDistribution(float $baseRate, float $commissionRate): array
    {
        $clientRate      = $this->getClientHourlyRate($baseRate);
        $commission      = round($baseRate * $commissionRate, 2);
        $clientFee       = round($baseRate * 0.10, 2);
        $freelancerNet   = round($baseRate - $commission, 2);
        $platformTotal   = round($commission + $clientFee, 2);

        return [
            'base_rate'          => round($baseRate, 2),
            'client_rate'        => $clientRate,
            'commission_rate'    => $commissionRate,
            'commission_amount'  => $commission,
            'client_fee'         => $clientFee,
            'freelancer_net'     => $freelancerNet,
            'platform_total'     => $platformTotal,
        ];
    }

    /**
     * Ventile un volume d'heures (ex : abonnement 4 semaines).
     */
    public function computeDistributionForHours(float $baseRate, float $commissionRate, float $hours): array
    {
        $unit = $this->computeDistribution($baseRate, $commissionRate);

        return [
            'hours'                 => $hours,
            'base_total'            => round($unit['base_rate'] * $hours, 2),
            'client_total'          => round($unit['client_rate'] * $hours, 2),
            'commission_total'      => round($unit['commission_amount'] * $hours, 2),
            'client_fee_total'      => round($unit['client_fee'] * $hours, 2),
            'freelancer_net_total'  => round($unit['freelancer_net'] * $hours, 2),
            'platform_total'        => round($unit['platform_total'] * $hours, 2),
            'commission_rate'       => $commissionRate,
            'client_hourly'         => $unit['client_rate'],
            'freelancer_net_hourly' => $unit['freelancer_net'],
        ];
    }

    /**
     * Met à jour les cumuls pour une paire client/freelance.
     */
    public function incrementStats(int $clientId, int $freelancerId, float $baseAmount, float $clientAmount): ClientFreelancerStat
    {
        $stat = ClientFreelancerStat::firstOrCreate(
            ['client_id' => $clientId, 'freelancer_id' => $freelancerId],
            ['total_base_amount' => 0, 'total_client_amount' => 0, 'current_commission_rate' => 0.20]
        );

        $stat->increment('total_base_amount', $baseAmount);
        $stat->increment('total_client_amount', $clientAmount);

        // recalcul du taux après incrément
        $this->getCommissionRateForPair($clientId, $freelancerId);

        return $stat->fresh();
    }
}


