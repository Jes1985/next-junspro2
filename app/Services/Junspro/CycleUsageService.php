<?php

namespace App\Services\Junspro;

/**
 * Service central : Top-up par palier + Upgrade doux (cycles 4 semaines).
 * Unité signature : Rituel (1 Rituel = 50 min focus + 10 min restitution & rapport = 1h affichée).
 * Paliers stockés en heures par cycle 4 semaines ; affichage en Rituels (1h = 1 Rituel).
 */
class CycleUsageService
{
    /** Univers type A : Lessons, WellnessLive, Corporate. Paliers 4, 8, 16, 24, 32. */
    public const UNIVERSE_A = 'a';

    /** Univers type B : Projects, At-home. Paliers jusqu'à 88. */
    public const UNIVERSE_B = 'b';

    /** Paliers A (heures par cycle 4 semaines). */
    public const PALIERS_A = [4, 8, 16, 24, 32];

    /** Paliers B (heures par cycle 4 semaines). */
    public const PALIERS_B = [4, 8, 16, 24, 32, 48, 56, 64, 72, 80, 88];

    /** Slugs d'univers → type A ou B. A = Lessons, WellnessLive, Corporate ; B = Projects, At-home. */
    public const UNIVERSE_SLUG_TO_TYPE = [
        'lessons'      => self::UNIVERSE_A,
        'wellnesslive' => self::UNIVERSE_A,
        'corporate'    => self::UNIVERSE_A,
        'projects'     => self::UNIVERSE_B,
        'at-home'      => self::UNIVERSE_B,
    ];

    /** Micro-phrase signature Junspro (à afficher partout où un volume est visible). */
    public const RITUAL_SIGNATURE = '1 Rituel = 50 min focus + 10 min restitution & rapport.';

    /** Message premium si dépassement plafond cycle. */
    public const MESSAGE_CYCLE_LIMIT = 'Ce cycle atteint la limite de votre formule. Pour continuer, sélectionnez la formule supérieure.';

    /** Nudge 70%. */
    public const NUDGE_70 = 'Pour rester fluide jusqu\'à la fin du cycle, une formule supérieure peut mieux correspondre à votre rythme.';

    /** Nudge 85%. */
    public const NUDGE_85 = 'Vous approchez du plafond de votre cycle. Pour éviter toute limite, passez au palier supérieur.';

    /** Nudge après top-up. */
    public const NUDGE_AFTER_TOPUP = 'Vous avez activé une extension sur ce cycle. Si ce besoin se répète, une formule supérieure sera plus confortable.';

    /** Niveaux de nudge pour affichage. */
    public const NUDGE_LEVEL_NONE = 'none';
    public const NUDGE_LEVEL_SOFT70 = 'soft70';
    public const NUDGE_LEVEL_STRONG85 = 'strong85';
    public const NUDGE_LEVEL_AFTER_TOPUP = 'afterTopup';
    public const NUDGE_LEVEL_REPEAT = 'repeat';

    /**
     * Normalise le slug d'univers (lessons, wellnesslive, corporate, projects, at-home) en type A ou B.
     */
    public function universeType(string $universeSlug = null): string
    {
        if (empty($universeSlug)) {
            return self::UNIVERSE_A;
        }
        $slug = strtolower(trim($universeSlug));
        return self::UNIVERSE_SLUG_TO_TYPE[$slug] ?? self::UNIVERSE_A;
    }

    /**
     * Heures par cycle 4 semaines à partir de hours_per_week.
     */
    public function hoursPerCycleFromWeekly(int $hoursPerWeek): int
    {
        return $hoursPerWeek * 4;
    }

    /**
     * Snap les heures par cycle au palier autorisé le plus proche (inférieur ou égal).
     * Si au-dessus du max, retourne le max du palier.
     */
    public function snapToPalier(int $hoursPerCycle, string $universeType): int
    {
        $paliers = $universeType === self::UNIVERSE_B ? self::PALIERS_B : self::PALIERS_A;
        $snapped = 0;
        foreach ($paliers as $p) {
            if ($hoursPerCycle >= $p) {
                $snapped = $p;
            } else {
                break;
            }
        }
        return $snapped ?: $paliers[0];
    }

    /**
     * Top-up max autorisé par cycle (en heures = Rituels).
     * A : topup_max = palier (100% du palier).
     * B : si palier <= 32 alors topup_max = palier ; si palier > 32 alors topup_max = 32.
     */
    public function topupCap(int $subscriptionHoursPerCycle, string $universeType): int
    {
        $palier = $this->snapToPalier($subscriptionHoursPerCycle, $universeType);
        if ($universeType === self::UNIVERSE_B && $palier > 32) {
            return 32;
        }
        return $palier;
    }

    /**
     * Max total du cycle (palier + topup_max) en heures = Rituels.
     */
    public function cycleMaxTotal(int $subscriptionHoursPerCycle, string $universeType): int
    {
        $palier = $this->snapToPalier($subscriptionHoursPerCycle, $universeType);
        $cap = $this->topupCap($subscriptionHoursPerCycle, $universeType);
        return $palier + $cap;
    }

    /**
     * Conversion affichage : 1h = 1 Rituel.
     */
    public function hoursToRituals(float $hours): float
    {
        return $hours;
    }

    /**
     * Texte exact de la micro-phrase signature.
     */
    public function ritualSignatureText(): string
    {
        return self::RITUAL_SIGNATURE;
    }

    /**
     * Détermine si un nudge upgrade doit être affiché et son niveau.
     *
     * @param float $usageRatio Ratio consommé sur le cycle (0 à 1+, ex: 0.7 = 70%)
     * @param bool $topupUsedThisCycle Top-up utilisé sur le cycle en cours
     * @param int $consecutiveCyclesWithTopup Nombre de cycles consécutifs avec top-up (0, 1, 2+)
     * @return array ['show' => bool, 'level' => 'none'|'soft70'|'strong85'|'afterTopup'|'repeat', 'message' => string]
     */
    public function shouldShowUpgradeNudge(float $usageRatio, bool $topupUsedThisCycle, int $consecutiveCyclesWithTopup = 0): array
    {
        if ($consecutiveCyclesWithTopup >= 2 || ($topupUsedThisCycle && $usageRatio >= 0.85)) {
            return [
                'show' => true,
                'level' => self::NUDGE_LEVEL_REPEAT,
                'message' => self::NUDGE_85,
            ];
        }
        if ($topupUsedThisCycle) {
            return [
                'show' => true,
                'level' => self::NUDGE_LEVEL_AFTER_TOPUP,
                'message' => self::NUDGE_AFTER_TOPUP,
            ];
        }
        if ($usageRatio >= 0.85) {
            return [
                'show' => true,
                'level' => self::NUDGE_LEVEL_STRONG85,
                'message' => self::NUDGE_85,
            ];
        }
        if ($usageRatio >= 0.70) {
            return [
                'show' => true,
                'level' => self::NUDGE_LEVEL_SOFT70,
                'message' => self::NUDGE_70,
            ];
        }
        return [
            'show' => false,
            'level' => self::NUDGE_LEVEL_NONE,
            'message' => '',
        ];
    }

    /**
     * Vérifie si une demande de top-up ferait dépasser le max total du cycle.
     *
     * @param int $subscriptionHoursPerCycle Heures de la formule (palier) par cycle
     * @param int $topupUsedThisCycle Heures déjà ajoutées en top-up sur le cycle
     * @param int $requestedQty Quantité demandée
     * @param string $universeType 'a' ou 'b'
     * @return bool true si dépassement
     */
    public function wouldExceedCycleMax(int $subscriptionHoursPerCycle, int $topupUsedThisCycle, int $requestedQty, string $universeType): bool
    {
        $maxTotal = $this->cycleMaxTotal($subscriptionHoursPerCycle, $universeType);
        $currentTotal = $subscriptionHoursPerCycle + $topupUsedThisCycle;
        return ($currentTotal + $requestedQty) > $maxTotal;
    }
}
