<?php

namespace App\Services\Junspro;

/**
 * Service de calcul des commissions plateforme
 * 
 * Barème :
 * - 0 → 500 €     : 20 %
 * - 501 → 1 000 € : 12 %
 * - 1 001 → 5 000 € : 8 %
 * - 5 001 € et + : 6 %
 */
class PlatformFeeService
{
    /**
     * Obtenir le taux de commission selon le montant total
     *
     * @param float $totalAmount
     * @return float Taux entre 0 et 1 (ex: 0.20 pour 20%)
     */
    public function getRate(float $totalAmount): float
    {
        if ($totalAmount <= 500) {
            return 0.20;
        } elseif ($totalAmount <= 1000) {
            return 0.12;
        } elseif ($totalAmount <= 5000) {
            return 0.08;
        } else {
            return 0.06;
        }
    }

    /**
     * Calculer le montant de la commission
     *
     * @param float $totalAmount
     * @return float Montant de la commission
     */
    public function calculateFee(float $totalAmount): float
    {
        return $totalAmount * $this->getRate($totalAmount);
    }

    /**
     * Obtenir le montant net après commission
     *
     * @param float $totalAmount
     * @return float Montant net
     */
    public function getNetAmount(float $totalAmount): float
    {
        return $totalAmount - $this->calculateFee($totalAmount);
    }
}

