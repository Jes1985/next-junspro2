<?php

namespace App\Jobs;

use App\Models\FreelancerProfile;
use App\Models\Subscription;
use App\Models\WorkSession;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CalculateFreelancerScore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('[CRON] Début du calcul des scores freelances');

        $freelancers = FreelancerProfile::with('user')->get();

        foreach ($freelancers as $freelancer) {
            $this->calculateScore($freelancer);
        }

        Log::info('[CRON] Fin du calcul des scores freelances');
    }

    /**
     * Calculer le score d'un freelance
     */
    protected function calculateScore(FreelancerProfile $freelancer): void
    {
        $user = $freelancer->user;
        if (!$user) {
            return;
        }

        // 1. Taux de livraisons hebdo respectées (40%)
        $deliveryRate = $this->calculateDeliveryRate($freelancer);

        // 2. Taux de rectifications (30%)
        $rectificationRate = $this->calculateRectificationRate($freelancer);

        // 3. Notes clients (20%)
        $clientRating = $this->calculateClientRating($freelancer);

        // 4. Temps de réponse (10%)
        $responseTime = $this->calculateResponseTime($freelancer);

        // Calcul du score final (0-100)
        $score = (
            ($deliveryRate * 0.40) +
            ((1 - $rectificationRate) * 100 * 0.30) + // Moins de rectifications = meilleur score
            ($clientRating * 0.20) +
            ($responseTime * 0.10)
        );

        $score = max(0, min(100, round($score)));

        // Mettre à jour le score
        $user->update(['freelancer_score' => $score]);

        // Si score > 90 → Super Freelance
        if ($score >= 90 && !$user->is_super_freelancer) {
            $user->update(['is_super_freelancer' => true]);
            Log::info('Freelancer promoted to Super Freelance', [
                'user_id' => $user->id,
                'score' => $score,
            ]);
        }

        // Si score faible → réduire visibilité
        if ($score < 50) {
            $freelancer->update(['reliability_score' => $score]);
        }

        Log::info('Freelancer score calculated', [
            'freelancer_id' => $freelancer->id,
            'score' => $score,
            'delivery_rate' => $deliveryRate,
            'rectification_rate' => $rectificationRate,
            'client_rating' => $clientRating,
            'response_time' => $responseTime,
        ]);
    }

    /**
     * Calculer le taux de livraisons respectées
     */
    protected function calculateDeliveryRate(FreelancerProfile $freelancer): float
    {
        $subscriptions = Subscription::where('freelancer_id', $freelancer->id)
            ->where('status', 'active')
            ->get();

        if ($subscriptions->isEmpty()) {
            return 100; // Pas d'abonnements = score parfait
        }

        $totalExpected = 0;
        $totalDelivered = 0;

        foreach ($subscriptions as $subscription) {
            $hoursPerWeek = $subscription->hours_per_week;
            $weeks = 4; // Dernières 4 semaines
            $expected = $hoursPerWeek * $weeks;

            $delivered = WorkSession::where('subscription_id', $subscription->id)
                ->where('status', 'delivered')
                ->where('start_at', '>=', Carbon::now()->subWeeks(4))
                ->count();

            $totalExpected += $expected;
            $totalDelivered += $delivered;
        }

        if ($totalExpected === 0) {
            return 100;
        }

        return min(100, ($totalDelivered / $totalExpected) * 100);
    }

    /**
     * Calculer le taux de rectifications
     */
    protected function calculateRectificationRate(FreelancerProfile $freelancer): float
    {
        $subscriptions = Subscription::where('freelancer_id', $freelancer->id)->pluck('id');

        $totalSessions = WorkSession::whereIn('subscription_id', $subscriptions)
            ->where('start_at', '>=', Carbon::now()->subWeeks(4))
            ->count();

        if ($totalSessions === 0) {
            return 0;
        }

        $rectifiedSessions = WorkSession::whereIn('subscription_id', $subscriptions)
            ->where('start_at', '>=', Carbon::now()->subWeeks(4))
            ->where('rectification_count', '>', 0)
            ->count();

        return $rectifiedSessions / $totalSessions;
    }

    /**
     * Calculer la note moyenne des clients
     */
    protected function calculateClientRating(FreelancerProfile $freelancer): float
    {
        // TODO: Implémenter le calcul basé sur les reviews réelles
        // Pour l'instant, utiliser reliability_score converti en note 0-5
        return ($freelancer->reliability_score / 100) * 5;
    }

    /**
     * Calculer le temps de réponse moyen
     */
    protected function calculateResponseTime(FreelancerProfile $freelancer): float
    {
        // TODO: Implémenter le calcul basé sur les temps de réponse réels
        // Pour l'instant, retourner un score par défaut
        return 100; // Score parfait par défaut
    }
}
