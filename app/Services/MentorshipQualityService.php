<?php

namespace App\Services;

use App\Models\MentorshipCheckin;
use App\Models\MentorshipMilestone;
use App\Models\MentorshipMission;
use App\Models\MentorshipPod;
use App\Models\User;

class MentorshipQualityService
{
    public function canMentorAccept(User $mentor, MentorshipPod $pod): array
    {
        $profile = $mentor->freelancerProfile;
        if (!$profile) {
            return ['ok' => false, 'message' => 'Profil freelance introuvable.'];
        }

        if (!$profile->is_mentor || $profile->mentor_status !== 'active') {
            return ['ok' => false, 'message' => 'Le mentor doit etre actif pour accepter un stagiaire.'];
        }

        $globalCapacity = max(1, (int) $profile->mentor_capacity);
        $podCapacity = max(1, (int) $pod->max_trainees);

        $globalActive = (int) $mentor->mentorPods()
            ->withCount(['memberships as active_memberships_count' => function ($q) {
                $q->where('membership_status', 'active');
            }])
            ->get()
            ->sum('active_memberships_count');

        $podActive = (int) $pod->memberships()
            ->where('membership_status', 'active')
            ->count();

        if ($globalActive >= $globalCapacity) {
            return [
                'ok' => false,
                'message' => 'Capacite mentor atteinte.',
                'global_active' => $globalActive,
                'global_capacity' => $globalCapacity,
            ];
        }

        if ($podActive >= $podCapacity) {
            return [
                'ok' => false,
                'message' => 'Ce pod est complet.',
                'pod_active' => $podActive,
                'pod_capacity' => $podCapacity,
            ];
        }

        return ['ok' => true];
    }

    public function syncPodStatus(MentorshipPod $pod): MentorshipPod
    {
        $activeCount = (int) $pod->memberships()
            ->where('membership_status', 'active')
            ->count();

        $pod->active_trainees_count = $activeCount;

        if ($pod->status !== 'paused' && $pod->status !== 'closed') {
            if ($activeCount <= 0) {
                $pod->status = 'open';
            } elseif ($activeCount >= (int) $pod->max_trainees) {
                $pod->status = 'full';
            } else {
                $pod->status = 'open';
            }
        }

        $pod->save();

        return $pod->refresh();
    }

    public function syncMissionStatus(MentorshipMission $mission): MentorshipMission
    {
        $total = (int) $mission->milestones()->count();
        $validated = (int) $mission->milestones()->where('status', 'validated')->count();
        $submitted = (int) $mission->milestones()->whereIn('status', ['submitted', 'revision_requested'])->count();

        if ($total > 0 && $validated >= $total) {
            $mission->status = 'completed';
        } elseif ($submitted > 0 || $validated > 0) {
            $mission->status = 'in_progress';
        } elseif ($mission->status === 'draft') {
            $mission->status = 'published';
        }

        $mission->save();

        return $mission->refresh();
    }

    public function refreshMilestoneStatusFromSubmissions(MentorshipMilestone $milestone): MentorshipMilestone
    {
        $approved = (int) $milestone->submissions()->where('review_status', 'approved')->count();
        $pending = (int) $milestone->submissions()->where('review_status', 'pending')->count();
        $revision = (int) $milestone->submissions()->whereIn('review_status', ['needs_changes', 'rejected'])->count();

        if ($approved > 0 && $pending === 0 && $revision === 0) {
            $milestone->status = 'validated';
        } elseif ($revision > 0) {
            $milestone->status = 'revision_requested';
        } elseif ($pending > 0) {
            $milestone->status = 'submitted';
        } else {
            $milestone->status = 'open';
        }

        $milestone->save();

        return $milestone->refresh();
    }

    public function deriveRiskFlag(int $progressPercent, ?int $confidenceLevel): string
    {
        if ($progressPercent < 25 || ($confidenceLevel !== null && $confidenceLevel <= 2)) {
            return 'high';
        }

        if ($progressPercent < 60 || ($confidenceLevel !== null && $confidenceLevel === 3)) {
            return 'medium';
        }

        return 'low';
    }

    public function evaluateCertificateEligibility(User $trainee, ?MentorshipPod $pod = null): array
    {
        $query = $trainee->mentorshipMemberships()->whereIn('membership_status', ['active', 'completed']);

        if ($pod) {
            $query->where('pod_id', $pod->id);
        }

        $memberships = $query->with(['pod.missions.milestones.submissions' => function ($q) use ($trainee) {
            $q->where('trainee_user_id', $trainee->id);
        }])->get();

        $totalMilestones = 0;
        $validatedMilestones = 0;
        $scores = [];

        foreach ($memberships as $membership) {
            foreach ($membership->pod->missions as $mission) {
                foreach ($mission->milestones as $milestone) {
                    $totalMilestones++;
                    $approvedSubmission = $milestone->submissions
                        ->where('review_status', 'approved')
                        ->sortByDesc('reviewed_at')
                        ->first();

                    if ($approvedSubmission) {
                        $validatedMilestones++;

                        $parts = array_filter([
                            $approvedSubmission->score_technical,
                            $approvedSubmission->score_communication,
                            $approvedSubmission->score_autonomy,
                        ], static fn ($v) => $v !== null);

                        if (!empty($parts)) {
                            $scores[] = array_sum($parts) / count($parts);
                        }
                    }
                }
            }
        }

        $validationRate = $totalMilestones > 0
            ? (int) round(($validatedMilestones / $totalMilestones) * 100)
            : 0;

        $avgScore = !empty($scores)
            ? (int) round(array_sum($scores) / count($scores))
            : 0;

        $highRiskOpen = MentorshipCheckin::query()
            ->where('trainee_user_id', $trainee->id)
            ->where('risk_flag', 'high')
            ->whereDate('week_start', '>=', now()->subDays(21)->toDateString())
            ->exists();

        $eligible = $validationRate >= 80 && $avgScore >= 60 && !$highRiskOpen;

        return [
            'eligible' => $eligible,
            'validation_rate' => $validationRate,
            'average_score' => $avgScore,
            'high_risk_open' => $highRiskOpen,
            'rules' => [
                'min_validation_rate' => 80,
                'min_average_score' => 60,
                'no_recent_high_risk' => true,
            ],
        ];
    }
}
