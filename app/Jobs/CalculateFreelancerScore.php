<?php

namespace App\Jobs;

use App\Models\FreelancerProfile;
use App\Models\Subscription;
use App\Models\WorkSession;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CalculateFreelancerScore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $freelancers = FreelancerProfile::with(['user', 'subscriptions.workSessions'])->get();

        foreach ($freelancers as $freelancer) {
            $score = $this->calculateScore($freelancer);
            
            $freelancer->reliability_score = $score;
            $freelancer->save();

            // Mettre à jour is_super_freelancer si score > 90
            if ($score >= 90 && !$freelancer->user->is_super_freelancer) {
                $freelancer->user->is_super_freelancer = true;
                $freelancer->user->save();
            } elseif ($score < 90 && $freelancer->user->is_super_freelancer) {
                $freelancer->user->is_super_freelancer = false;
                $freelancer->user->save();
            }

            Log::info('Freelancer score calculated', [
                'freelancer_id' => $freelancer->id,
                'score' => $score,
            ]);
        }
    }

    /**
     * Calculer le score de fiabilité d'un freelance
     */
    protected function calculateScore(FreelancerProfile $freelancer): int
    {
        $score = 100; // Score de base

        $activeSubscriptions = Subscription::where('freelancer_id', $freelancer->id)
            ->where('status', 'active')
            ->get();

        if ($activeSubscriptions->isEmpty()) {
            return $score;
        }

        $totalExpectedSessions = 0;
        $totalDeliveredSessions = 0;
        $totalRectifications = 0;
        $totalLateSessions = 0;

        foreach ($activeSubscriptions as $subscription) {
            $expectedSessions = $subscription->hours_per_week * 4; // Sur 4 semaines
            $totalExpectedSessions += $expectedSessions;

            $sessions = WorkSession::where('subscription_id', $subscription->id)
                ->where('created_at', '>=', now()->subDays(30))
                ->get();

            foreach ($sessions as $session) {
                if ($session->status === 'delivered' || $session->status === 'validated') {
                    $totalDeliveredSessions++;
                }

                if ($session->status === 'late') {
                    $totalLateSessions++;
                }

                $totalRectifications += $session->rectification_count ?? 0;
            }
        }

        // Pénalités
        if ($totalExpectedSessions > 0) {
            $deliveryRate = ($totalDeliveredSessions / $totalExpectedSessions) * 100;
            if ($deliveryRate < 80) {
                $score -= (80 - $deliveryRate) * 0.5; // Pénalité pour faible taux de livraison
            }
        }

        // Pénalité pour retards
        if ($totalLateSessions > 0) {
            $score -= $totalLateSessions * 5; // -5 points par retard
        }

        // Pénalité pour rectifications
        if ($totalRectifications > 0) {
            $score -= $totalRectifications * 2; // -2 points par rectification
        }

        // Score final entre 0 et 100
        return max(0, min(100, (int) $score));
    }
}


