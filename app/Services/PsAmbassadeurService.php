<?php

namespace App\Services;

use App\Models\PsAmbassadeur;
use App\Models\PsConversion;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

/**
 * PsAmbassadeurService — Système d'ambassadeurs Pause Souffle
 *
 * Entièrement indépendant du système d'affiliation JunsPro générique.
 * Tables : ps_ambassadeurs + ps_conversions
 * Cookie : ps_ambassador_code (90 jours)
 */
class PsAmbassadeurService
{
    // Délai de validation anti-fraude (30 jours pour produits premium)
    const VALIDATION_DELAY_DAYS = 30;

    // Seuils de progression par tier
    const TIER_THRESHOLDS = [
        'partenaire'  => 5,
        'ambassadeur' => 15,
    ];

    // =========================================================
    // INSCRIPTION / GESTION DU PROFIL
    // =========================================================

    /**
     * Créer le profil ambassadeur PS ou retourner l'existant
     */
    public function getOrCreate(User $user): PsAmbassadeur
    {
        $existing = PsAmbassadeur::where('user_id', $user->id)->first();
        if ($existing) return $existing;

        return PsAmbassadeur::create([
            'user_id'      => $user->id,
            'code'         => $this->generateUniqueCode(),
            'status'       => 'active',
            'tier'         => 'standard',
            'activated_at' => now(),
        ]);
    }

    /**
     * Résoudre un code ambassadeur → PsAmbassadeur actif
     */
    public function resolveCode(string $code): ?PsAmbassadeur
    {
        return PsAmbassadeur::where('code', $code)
            ->where('status', 'active')
            ->first();
    }

    /**
     * Enregistrer un clic sur le lien ambassadeur (RGPD : IP hashée SHA-256)
     */
    public function recordClick(PsAmbassadeur $ambassadeur, string $ip, ?string $referer = null): void
    {
        DB::table('ps_ambassador_clicks')->insert([
            'ambassadeur_id' => $ambassadeur->id,
            'ip_hash'        => hash('sha256', $ip . $ambassadeur->code),
            'referer'        => $referer ? substr($referer, 0, 500) : null,
            'created_at'     => now(),
        ]);
    }

    // =========================================================
    // CONVERSIONS
    // =========================================================

    /**
     * Enregistrer une conversion PS après paiement Stripe
     */
    public function recordConversion(
        PsAmbassadeur $ambassadeur,
        ?User $referredUser,
        float $saleAmount,
        string $productType,
        ?string $stripePaymentIntent = null
    ): ?PsConversion {
        // Anti-doublon sur le même paiement Stripe
        if ($stripePaymentIntent) {
            $exists = PsConversion::where('stripe_payment_intent', $stripePaymentIntent)->first();
            if ($exists) return $exists;
        }

        // Anti-auto-commission
        if ($referredUser && $ambassadeur->user_id === $referredUser->id) return null;

        $rate   = PsAmbassadeur::COMMISSION_RATES[$productType] ?? 20.00;
        $amount = round($saleAmount * $rate / 100, 2);

        $conversion = PsConversion::create([
            'ambassadeur_id'        => $ambassadeur->id,
            'referred_user_id'      => $referredUser?->id,
            'product_type'          => $productType,
            'stripe_payment_intent' => $stripePaymentIntent,
            'sale_amount'           => $saleAmount,
            'commission_rate'       => $rate,
            'commission_amount'     => $amount,
            'status'                => 'pending',
        ]);

        $ambassadeur->increment('pending_payout', $amount);

        // Notifier l'ambassadeur en temps réel
        try {
            $ambassadeur->loadMissing('user');
            if ($ambassadeur->user) {
                $ambassadeur->user->notify(
                    new \App\Notifications\PsNewConversionNotification($conversion, $ambassadeur)
                );
            }
        } catch (\Throwable $e) {
            Log::warning('[PsAmbassadeur] Notification nouvelle vente échouée: ' . $e->getMessage());
        }

        Log::info('[PsAmbassadeur] Conversion enregistrée', [
            'ambassadeur_id' => $ambassadeur->id,
            'product_type'   => $productType,
            'amount'         => $amount,
        ]);

        return $conversion;
    }

    /**
     * Annuler une conversion (remboursement)
     */
    public function cancelConversion(string $stripePaymentIntent): void
    {
        $conversion = PsConversion::where('stripe_payment_intent', $stripePaymentIntent)
            ->whereIn('status', ['pending', 'validated'])
            ->first();

        if (!$conversion) return;

        $ambassadeur = $conversion->ambassadeur;

        if ($conversion->status === 'pending') {
            $ambassadeur->decrement('pending_payout', $conversion->commission_amount);
        } else {
            $ambassadeur->decrement('total_earned', $conversion->commission_amount);
        }

        $conversion->update(['status' => 'cancelled']);
    }

    /**
     * Valider les conversions pending après le délai anti-fraude
     * À appeler via un job/cron quotidien
     */
    public function validatePendingConversions(): int
    {
        $cutoff = now()->subDays(self::VALIDATION_DELAY_DAYS);

        $conversions = PsConversion::where('status', 'pending')
            ->where('created_at', '<=', $cutoff)
            ->get();

        $count = 0;
        foreach ($conversions as $conversion) {
            DB::transaction(function () use ($conversion, &$count) {
                $conversion->update([
                    'status'       => 'validated',
                    'validated_at' => now(),
                ]);

                $ambassadeur = $conversion->ambassadeur;
                $ambassadeur->decrement('pending_payout', $conversion->commission_amount);
                $ambassadeur->increment('total_earned', $conversion->commission_amount);

                $this->checkAndUpgradeTier($ambassadeur);
                $count++;
            });
        }

        return $count;
    }

    // =========================================================
    // STATISTIQUES
    // =========================================================

    public function getStats(PsAmbassadeur $ambassadeur): array
    {
        $all       = $ambassadeur->conversions;
        $pending   = $all->where('status', 'pending');
        $validated = $all->whereIn('status', ['validated', 'paid']);

        $salesCount = $validated->count();

        // Tier calculé dynamiquement (le champ `tier` du modèle est le tier enregistré)
        if ($salesCount >= self::TIER_THRESHOLDS['ambassadeur']) {
            $tier = 'ambassadeur';
        } elseif ($salesCount >= self::TIER_THRESHOLDS['partenaire']) {
            $tier = 'partenaire';
        } else {
            $tier = 'standard';
        }

        $tierInfo = PsAmbassadeur::TIERS[$tier];
        $tierKeys = array_keys(PsAmbassadeur::TIERS);
        $tierPos  = array_search($tier, $tierKeys);
        $nextTier = $tierKeys[$tierPos + 1] ?? null;
        $nextMin  = $nextTier ? PsAmbassadeur::TIERS[$nextTier]['min_sales'] : null;
        $prevMin  = $tier !== 'standard' ? PsAmbassadeur::TIERS[$tierKeys[$tierPos - 1]]['min_sales'] : 0;

        if ($nextMin) {
            $progress = min(100, (int)(($salesCount - $prevMin) / ($nextMin - $prevMin) * 100));
        } else {
            $progress = 100;
        }

        $clicksCount = DB::table('ps_ambassador_clicks')
            ->where('ambassadeur_id', $ambassadeur->id)
            ->count();

        $conversionRate = $clicksCount > 0
            ? round(($salesCount / $clicksCount) * 100, 1)
            : 0;

        return [
            'sales_count'     => $salesCount,
            'pending_count'   => $pending->count(),
            'pending_amt'     => round($pending->sum('commission_amount'), 2),
            'validated_amt'   => round($validated->sum('commission_amount'), 2),
            'referrals_count' => $all->unique('referred_user_id')->count(),
            'clicks_count'    => $clicksCount,
            'conversion_rate' => $conversionRate,
            'tier'            => $tier,
            'tier_label'      => $tierInfo['label'],
            'tier_icon'       => $tierInfo['icon'],
            'next_tier'       => $nextTier,
            'next_tier_label' => $nextTier ? PsAmbassadeur::TIERS[$nextTier]['label'] : null,
            'next_min'        => $nextMin,
            'progress'        => $progress,
            'tracking_link'   => $ambassadeur->tracking_link,
        ];
    }

    // =========================================================
    // PALIERS
    // =========================================================

    public function checkAndUpgradeTier(PsAmbassadeur $ambassadeur): void
    {
        $salesCount = $ambassadeur->conversions()
            ->whereIn('status', ['validated', 'paid'])
            ->count();

        if ($salesCount >= self::TIER_THRESHOLDS['ambassadeur']) {
            $newTier = 'ambassadeur';
        } elseif ($salesCount >= self::TIER_THRESHOLDS['partenaire']) {
            $newTier = 'partenaire';
        } else {
            $newTier = 'standard';
        }

        if ($newTier !== $ambassadeur->tier) {
            $ambassadeur->update(['tier' => $newTier]);
            Log::info('[PsAmbassadeur] Upgrade tier', [
                'ambassadeur_id' => $ambassadeur->id,
                'nouveau_tier'   => $newTier,
            ]);
        }
    }

    // =========================================================
    // HELPERS
    // =========================================================

    private function generateUniqueCode(): string
    {
        do {
            // Format AMB-XXXXX — lisible, copiable, professionnel
            $numeric = str_pad(random_int(10000, 99999), 5, '0', STR_PAD_LEFT);
            $code    = 'AMB-' . $numeric;
        } while (PsAmbassadeur::where('code', $code)->exists());

        return $code;
    }
}
