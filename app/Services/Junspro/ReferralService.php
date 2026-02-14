<?php

namespace App\Services\Junspro;

use App\Models\User;
use App\Models\Referral;
use App\Models\ClientProfile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Service de gestion du parrainage Junspro V2
 * 
 * Configuration V1 (paramétrable):
 * - min_eligible_amount = 100€
 * - reward_amount = 10€
 * - benefit_label = "10€ offerts sur les frais de site"
 * - cooldown_hours = 48h
 * - monthly_cap = 150€
 */
class ReferralService
{
    const MIN_ELIGIBLE_AMOUNT = 100;
    const REWARD_AMOUNT = 10;
    const BENEFIT_LABEL = "10€ offerts sur les frais de site";
    const COOLDOWN_HOURS = 48;
    const MONTHLY_CAP = 150;

    /**
     * Générer ou récupérer le code de parrainage d'un utilisateur
     */
    public function getOrCreateReferralCode(User $user): string
    {
        if (!Schema::hasColumn('users', 'referral_code')) {
            return strtoupper(Str::random(8));
        }

        if ($user->referral_code) {
            return $user->referral_code;
        }

        // Générer un code unique
        do {
            $code = strtoupper(Str::random(8));
        } while (User::where('referral_code', $code)->exists());

        $user->update(['referral_code' => $code]);

        return $code;
    }

    /**
     * Enregistrer un parrainage lors de l'inscription
     */
    public function registerReferral(string $referralCode, User $referredUser): ?Referral
    {
        if (!Schema::hasColumn('users', 'referral_code') || !Schema::hasTable('referrals')) {
            return null;
        }

        // Trouver le parrain
        $referrer = User::where('referral_code', $referralCode)->first();

        if (!$referrer) {
            return null;
        }

        // Vérifier l'auto-parrainage
        if ($referrer->id === $referredUser->id) {
            return null;
        }

        // Vérifier si l'utilisateur a déjà un parrain
        if (Schema::hasColumn('users', 'referred_by_user_id') && $referredUser->referred_by_user_id) {
            return null;
        }

        // Créer le parrainage
        $referral = Referral::create([
            'referrer_id' => $referrer->id,
            'referred_id' => $referredUser->id,
            'status' => 'pending',
            'reward_amount' => self::REWARD_AMOUNT,
        ]);

        // Lier le filleul au parrain
        if (Schema::hasColumn('users', 'referred_by_user_id')) {
            $referredUser->update(['referred_by_user_id' => $referrer->id]);
        }

        return $referral;
    }

    /**
     * Vérifier et appliquer l'avantage filleul lors du checkout
     */
    public function applyBenefitToBooking(ClientProfile $clientProfile, float $bookingAmount): ?float
    {
        if (!Schema::hasTable('referrals')) {
            return null;
        }

        // Vérifier si c'est la première réservation éligible
        $referral = Referral::where('referred_id', $clientProfile->user_id)
            ->where('status', 'pending')
            ->first();

        if (!$referral) {
            return null;
        }

        // Vérifier le montant minimum
        if ($bookingAmount < self::MIN_ELIGIBLE_AMOUNT) {
            return null;
        }

        // Vérifier si l'avantage a déjà été appliqué
        if ($referral->first_booking_at) {
            return null;
        }

        // Enregistrer la première réservation
        $referral->update([
            'first_booking_at' => now(),
            'benefit_amount' => self::REWARD_AMOUNT, // Même montant que la récompense
        ]);

        return self::REWARD_AMOUNT;
    }

    /**
     * Vérifier et créditer le parrain après confirmation d'une prestation
     */
    public function creditReferrerAfterServiceConfirmation(ClientProfile $clientProfile): ?Referral
    {
        if (!Schema::hasTable('referrals')) {
            return null;
        }

        $referral = Referral::where('referred_id', $clientProfile->user_id)
            ->where('status', 'pending')
            ->whereNotNull('first_booking_at')
            ->first();

        if (!$referral) {
            return null;
        }

        // Vérifier le cap mensuel
        $monthlyEarned = Referral::where('referrer_id', $referral->referrer_id)
            ->where('status', 'completed')
            ->whereMonth('reward_credited_at', now()->month)
            ->whereYear('reward_credited_at', now()->year)
            ->sum('reward_amount');

        if ($monthlyEarned >= self::MONTHLY_CAP) {
            return null; // Cap atteint
        }

        // Vérifier le cooldown
        if ($referral->first_booking_at && $referral->first_booking_at->diffInHours(now()) < self::COOLDOWN_HOURS) {
            return null; // Trop tôt
        }

        // Créditer le parrain (TODO: intégrer avec le système de wallet/credits)
        // Pour l'instant, on marque juste comme complété
        $referral->update([
            'status' => 'completed',
            'first_service_confirmed_at' => now(),
            'reward_credited_at' => now(),
            'client_profile_id' => $clientProfile->id,
        ]);

        // TODO: Ajouter le crédit au wallet du parrain
        // $referrer = $referral->referrer;
        // $referrer->wallet->addCredit(self::REWARD_AMOUNT);

        return $referral;
    }

    /**
     * Obtenir les statistiques de parrainage d'un utilisateur
     */
    public function getReferralStats(User $user): array
    {
        if (!Schema::hasTable('referrals')) {
            return [
                'pending_total' => 0,
                'earned_total' => 0,
                'total_referrals' => 0,
                'pending_count' => 0,
                'completed_count' => 0,
            ];
        }

        $referrals = Referral::where('referrer_id', $user->id)->get();

        $pending = $referrals->where('status', 'pending')->sum('reward_amount');
        $earned = $referrals->where('status', 'completed')->sum('reward_amount');

        return [
            'pending_total' => $pending,
            'earned_total' => $earned,
            'total_referrals' => $referrals->count(),
            'pending_count' => $referrals->where('status', 'pending')->count(),
            'completed_count' => $referrals->where('status', 'completed')->count(),
        ];
    }

    /**
     * Obtenir la liste des parrainages avec pagination
     */
    public function getReferralsList(User $user, string $status = 'all', int $perPage = 20)
    {
        if (!Schema::hasTable('referrals')) {
            return Referral::query()->whereRaw('1 = 0')->paginate($perPage);
        }

        $query = Referral::where('referrer_id', $user->id)
            ->with(['referred', 'clientProfile'])
            ->orderBy('created_at', 'desc');

        if ($status === 'pending') {
            $query->where('status', 'pending');
        } elseif ($status === 'completed') {
            $query->where('status', 'completed');
        }

        return $query->paginate($perPage);
    }
}

