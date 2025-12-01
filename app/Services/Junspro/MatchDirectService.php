<?php

namespace App\Services\Junspro;

use App\Models\FreelancerProfile;
use App\Models\CalendarSlot;
use Illuminate\Support\Collection;

/**
 * Service de matching automatique (MatchDirect™)
 * 
 * Propose 3 freelances adaptés selon :
 * - Disponibilité (CalendarSlots)
 * - Tarif horaire compatible
 * - Compétences (skills)
 * - Langue
 * - Fuseau horaire
 * - Score de fiabilité
 */
class MatchDirectService
{
    /**
     * Trouver 3 freelances adaptés pour un client
     *
     * @param float|null $maxHourlyRate Budget maximum (optionnel)
     * @param array|null $requiredSkills Compétences requises (optionnel)
     * @param string|null $language Langue requise (optionnel)
     * @param string|null $timezone Fuseau horaire (optionnel)
     * @return Collection Collection de FreelancerProfile (max 3)
     */
    public function findMatchingFreelancers(
        ?float $maxHourlyRate = null,
        ?array $requiredSkills = null,
        ?string $language = null,
        ?string $timezone = null
    ): Collection {
        $query = FreelancerProfile::query()
            ->where('is_verified', true)
            ->where('reliability_score', '>=', 70); // Minimum de fiabilité

        // Filtrer par tarif horaire
        if ($maxHourlyRate !== null) {
            $query->where('hourly_rate', '<=', $maxHourlyRate);
        }

        // Filtrer par compétences
        if ($requiredSkills !== null && !empty($requiredSkills)) {
            $query->where(function ($q) use ($requiredSkills) {
                foreach ($requiredSkills as $skill) {
                    $q->orWhereJsonContains('skills', $skill);
                }
            });
        }

        // Filtrer par langue
        if ($language !== null) {
            $query->whereJsonContains('languages', $language);
        }

        // Filtrer par fuseau horaire
        if ($timezone !== null) {
            $query->where('timezone', $timezone);
        }

        // Trier par score de fiabilité décroissant, puis par tarif croissant
        $freelancers = $query->orderBy('reliability_score', 'desc')
            ->orderBy('hourly_rate', 'asc')
            ->get();

        // Filtrer par disponibilité (au moins un créneau disponible)
        $freelancers = $freelancers->filter(function ($freelancer) {
            return CalendarSlot::where('freelancer_id', $freelancer->id)
                ->where('is_available', true)
                ->exists();
        });

        // Retourner les 3 premiers
        return $freelancers->take(3);
    }

    /**
     * Trouver des freelances avec disponibilité dans une plage horaire
     *
     * @param int $weekday Jour de la semaine (0-6)
     * @param int $hour Heure (0-23)
     * @param float|null $maxHourlyRate
     * @return Collection
     */
    public function findAvailableFreelancers(
        int $weekday,
        int $hour,
        ?float $maxHourlyRate = null
    ): Collection {
        $query = FreelancerProfile::query()
            ->where('is_verified', true)
            ->whereHas('calendarSlots', function ($q) use ($weekday, $hour) {
                $q->where('weekday', $weekday)
                  ->where('hour', $hour)
                  ->where('is_available', true);
            });

        if ($maxHourlyRate !== null) {
            $query->where('hourly_rate', '<=', $maxHourlyRate);
        }

        return $query->orderBy('reliability_score', 'desc')
            ->orderBy('hourly_rate', 'asc')
            ->get();
    }
}

