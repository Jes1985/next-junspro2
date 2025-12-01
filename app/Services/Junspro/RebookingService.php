<?php

namespace App\Services\Junspro;

use App\Models\WorkSession;
use App\Models\Rebooking;
use App\Models\FreelancerProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Service de gestion des reprogrammations
 * 
 * Règles strictes :
 * - rebook_count < 1 (une seule reprogrammation possible)
 * - délai avant start_at >= 24 heures
 * - nouvelle date dans la MÊME SEMAINE calendaire
 * - new_start_at <= start_at + 72 heures
 */
class RebookingService
{
    /**
     * Vérifier si une reprogrammation est autorisée
     *
     * @param WorkSession $workSession
     * @param Carbon $newStartAt
     * @return array ['allowed' => bool, 'reason' => string|null]
     */
    public function canRebook(WorkSession $workSession, Carbon $newStartAt): array
    {
        // Vérifier si déjà reprogrammée
        if ($workSession->rebook_count >= 1) {
            return [
                'allowed' => false,
                'reason' => 'Cette session a déjà été reprogrammée une fois. Une seule reprogrammation est autorisée par session.',
            ];
        }

        $oldStartAt = Carbon::parse($workSession->start_at);
        $now = now();

        // Vérifier le délai de 24h avant l'horaire initial
        $hoursUntilSession = $now->diffInHours($oldStartAt, false);
        if ($hoursUntilSession < 24) {
            return [
                'allowed' => false,
                'reason' => 'La reprogrammation doit être demandée au moins 24 heures avant l\'horaire initial.',
            ];
        }

        // Vérifier que la nouvelle date est dans la même semaine calendaire
        if (!$this->isSameWeek($oldStartAt, $newStartAt)) {
            return [
                'allowed' => false,
                'reason' => 'La nouvelle date doit être dans la même semaine calendaire que la date initiale.',
            ];
        }

        // Vérifier que le décalage ne dépasse pas 72 heures
        $hoursDifference = $oldStartAt->diffInHours($newStartAt, false);
        if (abs($hoursDifference) > 72) {
            return [
                'allowed' => false,
                'reason' => 'Le décalage ne peut pas dépasser 72 heures (3 jours).',
            ];
        }

        return ['allowed' => true, 'reason' => null];
    }

    /**
     * Vérifier si deux dates sont dans la même semaine calendaire
     *
     * @param Carbon $date1
     * @param Carbon $date2
     * @return bool
     */
    protected function isSameWeek(Carbon $date1, Carbon $date2): bool
    {
        return $date1->format('Y-W') === $date2->format('Y-W');
    }

    /**
     * Effectuer une reprogrammation
     *
     * @param WorkSession $workSession
     * @param FreelancerProfile $freelancer
     * @param Carbon $newStartAt
     * @param string|null $reason
     * @return Rebooking
     * @throws \Exception
     */
    public function rebook(
        WorkSession $workSession,
        FreelancerProfile $freelancer,
        Carbon $newStartAt,
        ?string $reason = null
    ): Rebooking {
        $canRebook = $this->canRebook($workSession, $newStartAt);

        if (!$canRebook['allowed']) {
            throw new \Exception($canRebook['reason']);
        }

        return DB::transaction(function () use ($workSession, $freelancer, $newStartAt, $reason) {
            $oldStartAt = Carbon::parse($workSession->start_at);
            $duration = $workSession->duration_minutes;
            $newEndAt = $newStartAt->copy()->addMinutes($duration);

            // Mettre à jour la session
            $workSession->start_at = $newStartAt;
            $workSession->end_at = $newEndAt;
            $workSession->rebook_count += 1;
            $workSession->save();

            // Créer l'enregistrement de reprogrammation
            $rebooking = Rebooking::create([
                'work_session_id' => $workSession->id,
                'old_start_at' => $oldStartAt,
                'new_start_at' => $newStartAt,
                'requested_by' => $freelancer->id,
                'reason' => $reason,
                'approved' => true, // Auto-approuvée si les règles sont respectées
            ]);

            Log::info("Session reprogrammée", [
                'work_session_id' => $workSession->id,
                'freelancer_id' => $freelancer->id,
                'old_start_at' => $oldStartAt,
                'new_start_at' => $newStartAt,
            ]);

            return $rebooking;
        });
    }

    /**
     * Approuver une reprogrammation exceptionnelle (par admin)
     *
     * @param Rebooking $rebooking
     * @return Rebooking
     */
    public function approveException(Rebooking $rebooking): Rebooking
    {
        $rebooking->approved = true;
        $rebooking->save();

        // Mettre à jour la session
        $workSession = $rebooking->workSession;
        $workSession->start_at = $rebooking->new_start_at;
        $workSession->end_at = $rebooking->new_start_at->copy()->addMinutes($workSession->duration_minutes);
        $workSession->rebook_count += 1;
        $workSession->save();

        return $rebooking;
    }
}

