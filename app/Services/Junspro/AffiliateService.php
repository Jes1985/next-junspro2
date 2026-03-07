<?php

namespace App\Services\Junspro;

use App\Models\Affiliate;
use App\Models\AffiliateConversion;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AffiliateService
{
    // ─── Délai de validation anti-fraude ──────────────────────
    const VALIDATION_DELAY_DAYS = 7;

    // ─── Taux par palier ──────────────────────────────────────
    const TIER_RATES = [
        'ambassador' => 5.00,
        'elite'      => 7.00,
        'club'       => 10.00,
    ];

    // ─── Seuils d'upgrade automatique ─────────────────────────
    const TIER_THRESHOLDS = [
        'elite' => 3,   // 3 conversions validées → Partenaire Élite
        'club'  => 10,  // 10 conversions validées → JunsPro Club
    ];

    // ─── Durée de commission par palier (mois) ────────────────
    const TIER_DURATION = [
        'ambassador' => 6,
        'elite'      => 12,
        'club'       => 24,
    ];

    // =========================================================
    // INSCRIPTION / CODE
    // =========================================================

    /**
     * Créer le profil apporteur d'un utilisateur (s'il n'existe pas)
     */
    public function getOrCreateAffiliate(User $user): Affiliate
    {
        $existing = Affiliate::where('user_id', $user->id)->first();
        if ($existing) return $existing;

        $code = $this->generateUniqueCode();

        return Affiliate::create([
            'user_id'         => $user->id,
            'affiliate_code'  => $code,
            'tier'            => 'ambassador',
            'commission_rate' => self::TIER_RATES['ambassador'],
            'status'          => 'pending', // actif après validation manuelle ou auto
        ]);
    }

    /**
     * Activer un profil apporteur
     */
    public function activate(Affiliate $affiliate): void
    {
        $affiliate->update([
            'status'       => 'active',
            'activated_at' => now(),
        ]);
    }

    /**
     * Résoudre un code de tracking (code ou slug custom) → Affiliate
     */
    public function resolveCode(string $code): ?Affiliate
    {
        return Affiliate::where('affiliate_code', $code)
            ->orWhere('custom_slug', $code)
            ->where('status', 'active')
            ->first();
    }

    // =========================================================
    // TRACKING / CONVERSIONS
    // =========================================================

    /**
     * Enregistrer une conversion (appelé depuis le webhook Stripe ou après paiement)
     */
    public function recordConversion(
        Affiliate $affiliate,
        User $referredUser,
        float $transactionAmount,
        string $sourceType = 'other',
        ?int $sourceId = null,
        ?string $stripePaymentIntent = null,
        int $commissionMonth = 1
    ): ?AffiliateConversion {

        // Anti-doublon : pas deux conversions pour le même paiement Stripe
        if ($stripePaymentIntent) {
            $exists = AffiliateConversion::where('stripe_payment_intent', $stripePaymentIntent)->first();
            if ($exists) return $exists;
        }

        // Vérifier que la durée de commission n'est pas dépassée pour ce filleul
        $maxMonths = self::TIER_DURATION[$affiliate->tier] ?? 6;
        if ($commissionMonth > $maxMonths) return null;

        $rate   = $affiliate->commission_rate;
        $amount = round($transactionAmount * $rate / 100, 2);

        $conversion = AffiliateConversion::create([
            'affiliate_id'           => $affiliate->id,
            'referred_user_id'       => $referredUser->id,
            'source_type'            => $sourceType,
            'source_id'              => $sourceId,
            'stripe_payment_intent'  => $stripePaymentIntent,
            'transaction_amount'     => $transactionAmount,
            'commission_rate'        => $rate,
            'commission_amount'      => $amount,
            'status'                 => 'pending',
            'commission_month'       => $commissionMonth,
        ]);

        // Ajout immédiat au pending_payout (sera retiré si annulé)
        $affiliate->increment('pending_payout', $amount);

        Log::info("[AffiliateService] Conversion enregistrée : affiliate#{$affiliate->id} filleul#{$referredUser->id} +{$amount}€");

        return $conversion;
    }

    /**
     * Valider les conversions pending après le délai anti-fraude (J+7)
     * À appeler via un job/cron quotidien
     */
    public function validatePendingConversions(): int
    {
        $cutoff = now()->subDays(self::VALIDATION_DELAY_DAYS);

        $conversions = AffiliateConversion::where('status', 'pending')
            ->where('created_at', '<=', $cutoff)
            ->get();

        $count = 0;
        foreach ($conversions as $conversion) {
            DB::transaction(function () use ($conversion, &$count) {
                $conversion->update([
                    'status'       => 'validated',
                    'validated_at' => now(),
                ]);

                $affiliate = $conversion->affiliate;
                $affiliate->increment('total_earned', $conversion->commission_amount);
                $affiliate->increment('active_conversions');

                // Upgrade automatique de palier
                $this->checkAndUpgradeTier($affiliate);

                $count++;
            });
        }

        return $count;
    }

    /**
     * Annuler une conversion (remboursement Stripe)
     */
    public function cancelConversion(string $stripePaymentIntent): void
    {
        $conversion = AffiliateConversion::where('stripe_payment_intent', $stripePaymentIntent)
            ->whereIn('status', ['pending', 'validated'])
            ->first();

        if (!$conversion) return;

        $affiliate = $conversion->affiliate;

        if ($conversion->status === 'pending') {
            $affiliate->decrement('pending_payout', $conversion->commission_amount);
        } elseif ($conversion->status === 'validated') {
            $affiliate->decrement('total_earned', $conversion->commission_amount);
            $affiliate->decrement('active_conversions');
        }

        $conversion->update(['status' => 'cancelled']);
    }

    // =========================================================
    // PALIERS
    // =========================================================

    /**
     * Vérifier et upgrader le palier si les seuils sont atteints
     */
    public function checkAndUpgradeTier(Affiliate $affiliate): void
    {
        $current = $affiliate->tier;

        if ($current === 'club') return; // déjà au max

        $conversions = $affiliate->active_conversions;

        if ($current === 'ambassador' && $conversions >= self::TIER_THRESHOLDS['elite']) {
            $this->upgradeTo($affiliate, 'elite');
        } elseif ($current === 'elite' && $conversions >= self::TIER_THRESHOLDS['club']) {
            $this->upgradeTo($affiliate, 'club');
        }
    }

    private function upgradeTo(Affiliate $affiliate, string $tier): void
    {
        $affiliate->update([
            'tier'            => $tier,
            'commission_rate' => self::TIER_RATES[$tier],
        ]);

        Log::info("[AffiliateService] Upgrade palier : affiliate#{$affiliate->id} → {$tier}");

        // TODO étape 6 : notifier l'utilisateur par email
    }

    // =========================================================
    // STATISTIQUES (pour le dashboard)
    // =========================================================

    public function getStats(Affiliate $affiliate): array
    {
        $conversions = $affiliate->conversions;

        $pendingCount    = $conversions->where('status', 'pending')->count();
        $validatedCount  = $conversions->where('status', 'validated')->count();
        $paidCount       = $conversions->where('status', 'paid')->count();

        $pendingAmount   = $conversions->where('status', 'pending')->sum('commission_amount');
        $validatedAmount = $conversions->where('status', 'validated')->sum('commission_amount');
        $paidAmount      = $conversions->where('status', 'paid')->sum('commission_amount');

        // Filleuls uniques ayant déclenché au moins une conversion
        $uniqueReferrals = $conversions->unique('referred_user_id')->count();

        // Gains du mois en cours
        $monthlyEarned = $conversions
            ->where('status', 'validated')
            ->filter(fn($c) => $c->created_at->isCurrentMonth())
            ->sum('commission_amount');

        // Progression vers le palier suivant
        $nextTier     = $affiliate->next_tier;
        $nextTierInfo = $nextTier ? Affiliate::TIERS[$nextTier] : null;
        $progress     = $affiliate->next_tier_progress;

        return [
            'tier'              => $affiliate->tier,
            'tier_label'        => $affiliate->tier_label,
            'commission_rate'   => $affiliate->commission_rate,
            'status'            => $affiliate->status,
            'total_earned'      => $affiliate->total_earned,
            'pending_payout'    => round($pendingAmount, 2),
            'validated_payout'  => round($validatedAmount, 2),
            'paid_out'          => round($paidAmount, 2),
            'monthly_earned'    => round($monthlyEarned, 2),
            'unique_referrals'  => $uniqueReferrals,
            'active_conversions'=> $affiliate->active_conversions,
            'pending_count'     => $pendingCount,
            'validated_count'   => $validatedCount,
            'paid_count'        => $paidCount,
            'next_tier'         => $nextTier,
            'next_tier_label'   => $nextTierInfo ? $nextTierInfo['label'] : null,
            'next_tier_min'     => $nextTierInfo ? $nextTierInfo['min_conversions'] : null,
            'next_tier_progress'=> $progress,
            'tracking_link'     => $affiliate->tracking_link,
        ];
    }

    /**
     * Historique paginé des conversions
     */
    public function getConversions(Affiliate $affiliate, string $status = 'all', int $perPage = 20)
    {
        $query = $affiliate->conversions()->with('referredUser')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        return $query->paginate($perPage);
    }

    // =========================================================
    // HELPERS PRIVÉS
    // =========================================================

    private function generateUniqueCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Affiliate::where('affiliate_code', $code)->exists());

        return $code;
    }
}
