<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MentorshipCheckin;
use App\Models\MentorshipMembership;
use App\Models\MentorshipMilestone;
use App\Models\MentorshipMission;
use App\Models\MentorshipPod;
use App\Models\MentorshipSubmission;
use App\Models\User;
use App\Services\MentorshipQualityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MentorshipController extends Controller
{
    public function __construct(private MentorshipQualityService $quality) {}

    public function pods(Request $request): JsonResponse
    {
        $pods = MentorshipPod::query()
            ->with('mentor:id,first_name,last_name,name')
            ->withCount([
                'memberships as active_memberships_count' => fn ($q) => $q->where('membership_status', 'active'),
                'memberships as pending_memberships_count' => fn ($q) => $q->where('membership_status', 'applied'),
                'missions',
            ])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')->toString()))
            ->orderByDesc('id')
            ->paginate(15);

        return response()->json($pods);
    }

    public function mentorDashboard(Request $request): JsonResponse
    {
        $user = $request->user();

        $pods = $user->mentorPods()->withCount([
            'memberships as active_memberships_count' => fn ($q) => $q->where('membership_status', 'active'),
            'memberships as pending_memberships_count' => fn ($q) => $q->where('membership_status', 'applied'),
            'missions',
        ])->get();

        $podIds = $pods->pluck('id');

        $highRiskCount = MentorshipCheckin::query()
            ->whereIn('pod_id', $podIds)
            ->where('risk_flag', 'high')
            ->whereDate('week_start', '>=', now()->subDays(14)->toDateString())
            ->count();

        return response()->json([
            'stats' => [
                'pods_total' => $pods->count(),
                'active_trainees' => (int) $pods->sum('active_memberships_count'),
                'pending_applications' => (int) $pods->sum('pending_memberships_count'),
                'missions_total' => (int) $pods->sum('missions_count'),
                'high_risk_recent' => (int) $highRiskCount,
            ],
            'pods' => $pods,
        ]);
    }

    public function traineeDashboard(Request $request): JsonResponse
    {
        $user = $request->user();

        $memberships = $user->mentorshipMemberships()
            ->with(['pod.mentor:id,first_name,last_name,name', 'pod.missions.milestones'])
            ->orderByDesc('id')
            ->get();

        $totalMilestones = 0;
        $validated = 0;

        foreach ($memberships as $membership) {
            foreach ($membership->pod->missions as $mission) {
                $totalMilestones += $mission->milestones->count();
                $validated += $mission->milestones->where('status', 'validated')->count();
            }
        }

        $progress = $totalMilestones > 0
            ? (int) round(($validated / $totalMilestones) * 100)
            : 0;

        return response()->json([
            'stats' => [
                'memberships_total' => $memberships->count(),
                'active_memberships' => $memberships->where('membership_status', 'active')->count(),
                'validated_milestones' => $validated,
                'total_milestones' => $totalMilestones,
                'global_progress' => $progress,
            ],
            'memberships' => $memberships,
        ]);
    }

    public function createPod(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'title' => 'required|string|max:190',
            'sector' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:5000',
            'max_trainees' => 'required|integer|min:1|max:5',
            'visibility' => 'nullable|in:public,private,school_only',
            'premium_label' => 'nullable|in:standard,curated,elite',
            'status' => 'nullable|in:draft,open,paused,closed',
        ]);

        $profile = $user->freelancerProfile;
        if (!$profile) {
            return response()->json(['message' => 'Profil freelance requis pour creer un pod mentorat.'], 422);
        }

        DB::transaction(function () use ($profile, $validated, $user, &$pod) {
            if (!$profile->is_mentor) {
                $profile->is_mentor = true;
            }

            if ($profile->mentor_status === 'inactive') {
                $profile->mentor_status = 'active';
            }

            if ((int) $profile->mentor_capacity < (int) $validated['max_trainees']) {
                $profile->mentor_capacity = (int) $validated['max_trainees'];
            }

            $profile->save();

            $pod = MentorshipPod::create([
                'mentor_user_id' => $user->id,
                'title' => $validated['title'],
                'sector' => $validated['sector'] ?? null,
                'description' => $validated['description'] ?? null,
                'max_trainees' => $validated['max_trainees'],
                'visibility' => $validated['visibility'] ?? 'public',
                'status' => $validated['status'] ?? 'open',
                'premium_label' => $validated['premium_label'] ?? 'standard',
            ]);
        });

        return response()->json([
            'message' => 'Pod cree avec succes.',
            'pod' => $pod,
        ], 201);
    }

    public function applyToPod(Request $request, MentorshipPod $pod): JsonResponse
    {
        $user = $request->user();
        if ((int) $pod->mentor_user_id === (int) $user->id) {
            return response()->json(['message' => 'Le mentor ne peut pas candidater a son propre pod.'], 422);
        }

        $validated = $request->validate([
            'trainee_type' => 'required|in:student,graduate',
        ]);

        $membership = MentorshipMembership::firstOrNew([
            'pod_id' => $pod->id,
            'trainee_user_id' => $user->id,
        ]);

        $membership->trainee_type = $validated['trainee_type'];
        $membership->membership_status = 'applied';
        $membership->start_date = null;
        $membership->end_date = null;
        $membership->completion_reason = null;
        $membership->save();

        return response()->json([
            'message' => 'Candidature enregistree.',
            'membership' => $membership,
        ]);
    }

    public function acceptMembership(Request $request, MentorshipPod $pod, User $trainee): JsonResponse
    {
        $user = $request->user();
        if ((int) $pod->mentor_user_id !== (int) $user->id) {
            return response()->json(['message' => 'Non autorise.'], 403);
        }

        $membership = MentorshipMembership::query()
            ->where('pod_id', $pod->id)
            ->where('trainee_user_id', $trainee->id)
            ->first();

        if (!$membership) {
            return response()->json(['message' => 'Candidature introuvable.'], 404);
        }

        $check = $this->quality->canMentorAccept($user, $pod);
        if (!$check['ok']) {
            return response()->json(['message' => $check['message'], 'details' => $check], 422);
        }

        $membership->membership_status = 'active';
        $membership->start_date = now()->toDateString();
        $membership->save();

        $this->quality->syncPodStatus($pod);

        return response()->json([
            'message' => 'Stagiaire accepte.',
            'membership' => $membership->refresh(),
            'pod' => $pod->refresh(),
        ]);
    }

    public function createMission(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'pod_id' => 'required|integer|exists:mentorship_pods,id',
            'title' => 'required|string|max:190',
            'brief' => 'nullable|string|max:5000',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'estimated_hours' => 'required|integer|min:0|max:500',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:draft,published,in_progress,completed,archived',
        ]);

        $pod = MentorshipPod::findOrFail($validated['pod_id']);
        if ((int) $pod->mentor_user_id !== (int) $user->id) {
            return response()->json(['message' => 'Non autorise pour ce pod.'], 403);
        }

        $mission = MentorshipMission::create([
            'pod_id' => $pod->id,
            'title' => $validated['title'],
            'brief' => $validated['brief'] ?? null,
            'difficulty' => $validated['difficulty'],
            'estimated_hours' => $validated['estimated_hours'],
            'due_date' => $validated['due_date'] ?? null,
            'status' => $validated['status'] ?? 'draft',
        ]);

        return response()->json([
            'message' => 'Mission creee.',
            'mission' => $mission,
        ], 201);
    }

    public function submitMilestone(Request $request, MentorshipMilestone $milestone): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'submission_url' => 'nullable|url|max:1900',
            'notes' => 'nullable|string|max:5000',
        ]);

        $isActiveMember = MentorshipMembership::query()
            ->where('pod_id', $milestone->mission->pod_id)
            ->where('trainee_user_id', $user->id)
            ->where('membership_status', 'active')
            ->exists();

        if (!$isActiveMember) {
            return response()->json(['message' => 'Vous devez etre stagiaire actif du pod.'], 403);
        }

        $submission = MentorshipSubmission::create([
            'milestone_id' => $milestone->id,
            'trainee_user_id' => $user->id,
            'submission_url' => $validated['submission_url'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'submitted_at' => now(),
            'review_status' => 'pending',
        ]);

        $milestone->status = 'submitted';
        $milestone->save();

        $mission = $milestone->mission;
        $this->quality->syncMissionStatus($mission);

        return response()->json([
            'message' => 'Soumission envoyee.',
            'submission' => $submission,
            'milestone' => $milestone->refresh(),
        ], 201);
    }

    public function reviewSubmission(Request $request, MentorshipSubmission $submission): JsonResponse
    {
        $user = $request->user();

        $pod = $submission->milestone->mission->pod;
        if ((int) $pod->mentor_user_id !== (int) $user->id) {
            return response()->json(['message' => 'Non autorise.'], 403);
        }

        $validated = $request->validate([
            'review_status' => 'required|in:approved,rejected,needs_changes',
            'score_technical' => 'nullable|integer|min:0|max:100',
            'score_communication' => 'nullable|integer|min:0|max:100',
            'score_autonomy' => 'nullable|integer|min:0|max:100',
            'notes' => 'nullable|string|max:5000',
        ]);

        $submission->review_status = $validated['review_status'];
        $submission->score_technical = $validated['score_technical'] ?? null;
        $submission->score_communication = $validated['score_communication'] ?? null;
        $submission->score_autonomy = $validated['score_autonomy'] ?? null;
        if (!empty($validated['notes'])) {
            $submission->notes = trim(($submission->notes ?? '') . "\n\n[Review mentor] " . $validated['notes']);
        }
        $submission->reviewed_by = $user->id;
        $submission->reviewed_at = now();
        $submission->save();

        $milestone = $this->quality->refreshMilestoneStatusFromSubmissions($submission->milestone);
        $mission = $this->quality->syncMissionStatus($milestone->mission);

        return response()->json([
            'message' => 'Review enregistree.',
            'submission' => $submission->refresh(),
            'milestone' => $milestone,
            'mission' => $mission,
        ]);
    }

    public function storeCheckin(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'pod_id' => 'required|integer|exists:mentorship_pods,id',
            'trainee_user_id' => 'required|integer|exists:users,id',
            'week_start' => 'required|date',
            'progress_percent' => 'required|integer|min:0|max:100',
            'blockers_text' => 'nullable|string|max:5000',
            'next_actions_text' => 'nullable|string|max:5000',
            'mentor_feedback_text' => 'nullable|string|max:5000',
            'confidence_level' => 'nullable|integer|min:1|max:5',
            'risk_flag' => 'nullable|in:low,medium,high',
        ]);

        $pod = MentorshipPod::findOrFail($validated['pod_id']);
        if ((int) $pod->mentor_user_id !== (int) $user->id) {
            return response()->json(['message' => 'Non autorise pour ce pod.'], 403);
        }

        $riskFlag = $validated['risk_flag']
            ?? $this->quality->deriveRiskFlag((int) $validated['progress_percent'], $validated['confidence_level'] ?? null);

        $checkin = MentorshipCheckin::updateOrCreate(
            [
                'pod_id' => $validated['pod_id'],
                'trainee_user_id' => $validated['trainee_user_id'],
                'week_start' => $validated['week_start'],
            ],
            [
                'progress_percent' => $validated['progress_percent'],
                'blockers_text' => $validated['blockers_text'] ?? null,
                'next_actions_text' => $validated['next_actions_text'] ?? null,
                'mentor_feedback_text' => $validated['mentor_feedback_text'] ?? null,
                'confidence_level' => $validated['confidence_level'] ?? null,
                'risk_flag' => $riskFlag,
            ]
        );

        return response()->json([
            'message' => 'Check-in enregistre.',
            'checkin' => $checkin,
        ]);
    }

    public function traineePassport(Request $request, User $trainee): JsonResponse
    {
        $user = $request->user();

        $isSelf = (int) $user->id === (int) $trainee->id;
        $isMentorOfTrainee = MentorshipMembership::query()
            ->where('trainee_user_id', $trainee->id)
            ->whereHas('pod', fn ($q) => $q->where('mentor_user_id', $user->id))
            ->exists();

        if (!$isSelf && !$isMentorOfTrainee) {
            return response()->json(['message' => 'Non autorise.'], 403);
        }

        $memberships = $trainee->mentorshipMemberships()
            ->with(['pod.mentor:id,first_name,last_name,name', 'pod.missions.milestones.submissions' => function ($q) use ($trainee) {
                $q->where('trainee_user_id', $trainee->id);
            }])
            ->orderByDesc('id')
            ->get();

        $evidences = [];
        $milestonesTotal = 0;
        $milestonesValidated = 0;

        foreach ($memberships as $membership) {
            foreach ($membership->pod->missions as $mission) {
                foreach ($mission->milestones as $milestone) {
                    $milestonesTotal++;

                    $approved = $milestone->submissions->where('review_status', 'approved')->first();
                    if ($approved) {
                        $milestonesValidated++;
                        $evidences[] = [
                            'pod' => $membership->pod->title,
                            'mission' => $mission->title,
                            'milestone' => $milestone->title,
                            'submission_url' => $approved->submission_url,
                            'scores' => [
                                'technical' => $approved->score_technical,
                                'communication' => $approved->score_communication,
                                'autonomy' => $approved->score_autonomy,
                            ],
                            'reviewed_at' => $approved->reviewed_at,
                        ];
                    }
                }
            }
        }

        $eligibility = $this->quality->evaluateCertificateEligibility($trainee);

        return response()->json([
            'trainee' => [
                'id' => $trainee->id,
                'name' => $trainee->first_name ?: ($trainee->name ?? 'Utilisateur'),
            ],
            'stats' => [
                'milestones_total' => $milestonesTotal,
                'milestones_validated' => $milestonesValidated,
                'validation_rate' => $milestonesTotal > 0 ? (int) round(($milestonesValidated / $milestonesTotal) * 100) : 0,
            ],
            'memberships' => $memberships,
            'evidences' => $evidences,
            'certificate' => $eligibility,
        ]);
    }
}
