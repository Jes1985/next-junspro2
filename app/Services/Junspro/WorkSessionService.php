<?php

namespace App\Services\Junspro;

use App\Models\WorkSession;
use App\Models\Subscription;
use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Service de gestion des sessions de travail (50/10)
 */
class WorkSessionService
{
    protected SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Créer une session de travail
     *
     * @param Subscription $subscription
     * @param Carbon $startAt
     * @param string $deliverySpeed
     * @param bool $isMeeting
     * @return WorkSession
     */
    public function createSession(
        Subscription $subscription,
        Carbon $startAt,
        string $deliverySpeed = 'standard',
        bool $isMeeting = false
    ): WorkSession {
        $endAt = $startAt->copy()->addMinutes(60); // 50min travail + 10min rapport

        $deadlineAt = null;
        if ($deliverySpeed !== 'standard') {
            $expressService = new ExpressService();
            $deadlineAt = $expressService->calculateDeadline($deliverySpeed);
        }

        return WorkSession::create([
            'subscription_id' => $subscription->id,
            'start_at' => $startAt,
            'end_at' => $endAt,
            'duration_minutes' => 60,
            'is_meeting' => $isMeeting,
            'delivery_speed' => $deliverySpeed,
            'deadline_at' => $deadlineAt,
            'status' => 'scheduled',
        ]);
    }

    /**
     * Compléter une session (50min travail + rapport)
     *
     * @param WorkSession $workSession
     * @param string $reportText
     * @param array|null $reportFiles
     * @return WorkSession
     * @throws \Exception
     */
    public function completeSession(
        WorkSession $workSession,
        string $reportText,
        ?array $reportFiles = null
    ): WorkSession {
        if (empty($reportText)) {
            throw new \Exception("Le rapport est obligatoire pour compléter une session");
        }

        return DB::transaction(function () use ($workSession, $reportText, $reportFiles) {
            $workSession->report_text = $reportText;
            $workSession->report_files = $reportFiles;
            $workSession->status = 'completed';
            $workSession->save();

            // Consommer 1 heure de l'abonnement
            $this->subscriptionService->consumeHours($workSession->subscription, 1.0);

            return $workSession;
        });
    }

    /**
     * Compléter une visio et déduire les heures
     *
     * @param WorkSession $workSession
     * @param Meeting $meeting
     * @return WorkSession
     */
    public function completeMeeting(WorkSession $workSession, Meeting $meeting): WorkSession
    {
        $hoursDeducted = $meeting->duration_minutes / 60;

        return DB::transaction(function () use ($workSession, $meeting, $hoursDeducted) {
            // Consommer les heures de la visio
            $this->subscriptionService->consumeHours($workSession->subscription, $hoursDeducted);

            $workSession->status = 'completed';
            $workSession->save();

            return $workSession;
        });
    }

    /**
     * Vérifier la livraison hebdomadaire
     *
     * @param Subscription $subscription
     * @param Carbon $weekStart
     * @return array ['delivered' => float, 'required' => int, 'on_track' => bool]
     */
    public function checkWeeklyDelivery(Subscription $subscription, Carbon $weekStart): array
    {
        $weekEnd = $weekStart->copy()->endOfWeek();

        $delivered = WorkSession::where('subscription_id', $subscription->id)
            ->where('status', 'completed')
            ->whereBetween('start_at', [$weekStart, $weekEnd])
            ->sum('duration_minutes') / 60; // Convertir en heures

        $required = $subscription->hours_per_week;
        $onTrack = $delivered >= $required;

        return [
            'delivered' => $delivered,
            'required' => $required,
            'on_track' => $onTrack,
        ];
    }
}

