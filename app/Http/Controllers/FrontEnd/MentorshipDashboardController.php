<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\MentorshipCheckin;
use App\Models\MentorshipMembership;
use App\Models\MentorshipMilestone;
use App\Models\MentorshipMission;
use App\Models\MentorshipPod;
use App\Models\MentorshipSubmission;
use App\Models\MentorshipSubscription;
use App\Models\User;
use App\Services\MentorshipQualityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MentorshipDashboardController extends Controller
{
    public function __construct(private MentorshipQualityService $quality) {}

    /** Vérifie que l'utilisateur a un abonnement mentorat actif. */
    private function requireSubscription(): ?RedirectResponse
    {
        $user = Auth::guard('web')->user();
        $creatorId = (int) config('app.creator_user_id', env('CREATOR_USER_ID', 0));

        // Le créateur de la plateforme a toujours accès
        if ($creatorId && $user->id === $creatorId) {
            return null;
        }

        $hasSub = MentorshipSubscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->exists();

        if (! $hasSub) {
            return redirect()->route('mentorship.subscription.index')
                ->with('info', 'Un abonnement mentorat actif est requis pour accéder à cet espace.');
        }

        return null;
    }

    public function mentor(Request $request)
    {
        if ($redirect = $this->requireSubscription()) {
            return $redirect;
        }

        $user = Auth::guard('web')->user();

        $pods = $user->mentorPods()
            ->with(['memberships.trainee:id,first_name,last_name,name'])
            ->withCount([
                'memberships as active_memberships_count' => fn ($q) => $q->where('membership_status', 'active'),
                'memberships as pending_memberships_count' => fn ($q) => $q->where('membership_status', 'applied'),
                'missions',
            ])
            ->latest('id')
            ->get();

        $podIds = $pods->pluck('id');

        $highRiskCheckins = MentorshipCheckin::query()
            ->whereIn('pod_id', $podIds)
            ->where('risk_flag', 'high')
            ->whereDate('week_start', '>=', now()->subDays(14)->toDateString())
            ->count();

        $stats = [
            'pods_total' => $pods->count(),
            'active_trainees' => (int) $pods->sum('active_memberships_count'),
            'pending_applications' => (int) $pods->sum('pending_memberships_count'),
            'missions_total' => (int) $pods->sum('missions_count'),
            'high_risk_recent' => (int) $highRiskCheckins,
        ];

        $pendingMemberships = MentorshipMembership::query()
            ->whereIn('pod_id', $podIds)
            ->where('membership_status', 'applied')
            ->with(['trainee:id,first_name,last_name,name', 'pod:id,title'])
            ->latest('id')
            ->get();

        $recentSubmissions = MentorshipSubmission::query()
            ->whereHas('milestone.mission.pod', fn ($q) => $q->where('mentor_user_id', $user->id))
            ->where('review_status', 'pending')
            ->with([
                'trainee:id,first_name,last_name,name',
                'milestone:id,mission_id,title',
                'milestone.mission:id,pod_id,title',
            ])
            ->latest('id')
            ->limit(20)
            ->get();

        $activeMemberships = MentorshipMembership::query()
            ->whereIn('pod_id', $podIds)
            ->where('membership_status', 'active')
            ->with(['trainee:id,first_name,last_name,name', 'pod:id,title'])
            ->get();

        return view('frontend.mentorship.mentor-dashboard', [
            'user' => $user,
            'pods' => $pods,
            'stats' => $stats,
            'pendingMemberships' => $pendingMemberships,
            'recentSubmissions' => $recentSubmissions,
            'activeMemberships' => $activeMemberships,
        ]);
    }

    public function storePod(Request $request): RedirectResponse
    {
        $user = Auth::guard('web')->user();

        $validated = $request->validate([
            'title' => 'required|string|max:190',
            'sector' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:5000',
            'max_trainees' => 'required|integer|min:1|max:5',
            'visibility' => 'nullable|in:public,private,school_only',
            'premium_label' => 'nullable|in:standard,curated,elite',
        ]);

        $profile = $user->freelancerProfile;
        if (!$profile) {
            return back()->with('error', 'Profil freelance requis pour creer un pod.');
        }

        DB::transaction(function () use ($profile, $validated, $user): void {
            $profile->is_mentor = true;
            if ($profile->mentor_status === 'inactive') {
                $profile->mentor_status = 'active';
            }
            if ((int) $profile->mentor_capacity < (int) $validated['max_trainees']) {
                $profile->mentor_capacity = (int) $validated['max_trainees'];
            }
            $profile->save();

            MentorshipPod::create([
                'mentor_user_id' => $user->id,
                'title' => $validated['title'],
                'sector' => $validated['sector'] ?? null,
                'description' => $validated['description'] ?? null,
                'max_trainees' => (int) $validated['max_trainees'],
                'visibility' => $validated['visibility'] ?? 'public',
                'premium_label' => $validated['premium_label'] ?? 'standard',
                'status' => 'open',
            ]);
        });

        return back()->with('success', 'Pod cree avec succes.');
    }

    public function storeMission(Request $request): RedirectResponse
    {
        $user = Auth::guard('web')->user();

        $validated = $request->validate([
            'pod_id' => 'required|integer|exists:mentorship_pods,id',
            'title' => 'required|string|max:190',
            'brief' => 'nullable|string|max:5000',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'estimated_hours' => 'required|integer|min:0|max:500',
            'due_date' => 'nullable|date',
        ]);

        $pod = MentorshipPod::findOrFail($validated['pod_id']);
        if ((int) $pod->mentor_user_id !== (int) $user->id) {
            return back()->with('error', 'Non autorise pour ce pod.');
        }

        MentorshipMission::create([
            'pod_id' => $pod->id,
            'title' => $validated['title'],
            'brief' => $validated['brief'] ?? null,
            'difficulty' => $validated['difficulty'],
            'estimated_hours' => (int) $validated['estimated_hours'],
            'due_date' => $validated['due_date'] ?? null,
            'status' => 'published',
        ]);

        return back()->with('success', 'Mission ajoutee.');
    }

    public function acceptMembership(Request $request, MentorshipPod $pod, User $trainee): RedirectResponse
    {
        $user = Auth::guard('web')->user();
        if ((int) $pod->mentor_user_id !== (int) $user->id) {
            return back()->with('error', 'Non autorise.');
        }

        $membership = MentorshipMembership::query()
            ->where('pod_id', $pod->id)
            ->where('trainee_user_id', $trainee->id)
            ->first();

        if (!$membership) {
            return back()->with('error', 'Candidature introuvable.');
        }

        $check = $this->quality->canMentorAccept($user, $pod);
        if (!$check['ok']) {
            return back()->with('error', $check['message']);
        }

        $membership->membership_status = 'active';
        $membership->start_date = now()->toDateString();
        $membership->save();

        $this->quality->syncPodStatus($pod);

        return back()->with('success', 'Stagiaire accepte dans le pod.');
    }

    public function reviewSubmission(Request $request, MentorshipSubmission $submission): RedirectResponse
    {
        $user = Auth::guard('web')->user();
        $pod = $submission->milestone->mission->pod;

        if ((int) $pod->mentor_user_id !== (int) $user->id) {
            return back()->with('error', 'Non autorise.');
        }

        $validated = $request->validate([
            'review_status' => 'required|in:approved,rejected,needs_changes',
            'score_technical' => 'nullable|integer|min:0|max:100',
            'score_communication' => 'nullable|integer|min:0|max:100',
            'score_autonomy' => 'nullable|integer|min:0|max:100',
        ]);

        $submission->review_status = $validated['review_status'];
        $submission->score_technical = $validated['score_technical'] ?? null;
        $submission->score_communication = $validated['score_communication'] ?? null;
        $submission->score_autonomy = $validated['score_autonomy'] ?? null;
        $submission->reviewed_by = $user->id;
        $submission->reviewed_at = now();
        $submission->save();

        $milestone = $this->quality->refreshMilestoneStatusFromSubmissions($submission->milestone);
        $this->quality->syncMissionStatus($milestone->mission);

        return back()->with('success', 'Review enregistree.');
    }

    public function storeCheckin(Request $request): RedirectResponse
    {
        $user = Auth::guard('web')->user();

        $validated = $request->validate([
            'pod_id' => 'required|integer|exists:mentorship_pods,id',
            'trainee_user_id' => 'required|integer|exists:users,id',
            'week_start' => 'required|date',
            'progress_percent' => 'required|integer|min:0|max:100',
            'confidence_level' => 'nullable|integer|min:1|max:5',
            'blockers_text' => 'nullable|string|max:5000',
            'next_actions_text' => 'nullable|string|max:5000',
            'mentor_feedback_text' => 'nullable|string|max:5000',
        ]);

        $pod = MentorshipPod::findOrFail($validated['pod_id']);
        if ((int) $pod->mentor_user_id !== (int) $user->id) {
            return back()->with('error', 'Non autorise pour ce pod.');
        }

        MentorshipCheckin::updateOrCreate(
            [
                'pod_id' => $pod->id,
                'trainee_user_id' => (int) $validated['trainee_user_id'],
                'week_start' => $validated['week_start'],
            ],
            [
                'progress_percent' => (int) $validated['progress_percent'],
                'confidence_level' => $validated['confidence_level'] ?? null,
                'blockers_text' => $validated['blockers_text'] ?? null,
                'next_actions_text' => $validated['next_actions_text'] ?? null,
                'mentor_feedback_text' => $validated['mentor_feedback_text'] ?? null,
                'risk_flag' => $this->quality->deriveRiskFlag(
                    (int) $validated['progress_percent'],
                    $validated['confidence_level'] ?? null
                ),
            ]
        );

        return back()->with('success', 'Check-in hebdomadaire enregistre.');
    }

    public function trainee(Request $request)
    {
        if ($redirect = $this->requireSubscription()) {
            return $redirect;
        }

        $user = Auth::guard('web')->user();

        $memberships = $user->mentorshipMemberships()
            ->with([
                'pod.mentor:id,first_name,last_name,name',
                'pod.missions.milestones.submissions' => fn ($q) => $q->where('trainee_user_id', $user->id),
            ])
            ->latest('id')
            ->get();

        $totalMilestones = 0;
        $validatedMilestones = 0;

        foreach ($memberships as $membership) {
            foreach ($membership->pod->missions as $mission) {
                foreach ($mission->milestones as $milestone) {
                    $totalMilestones++;
                    $approved = $milestone->submissions->where('review_status', 'approved')->first();
                    if ($approved) {
                        $validatedMilestones++;
                    }
                }
            }
        }

        $stats = [
            'memberships_total' => $memberships->count(),
            'active_memberships' => $memberships->where('membership_status', 'active')->count(),
            'validated_milestones' => $validatedMilestones,
            'total_milestones' => $totalMilestones,
            'progress' => $totalMilestones > 0 ? (int) round(($validatedMilestones / $totalMilestones) * 100) : 0,
        ];

        $certificate = $this->quality->evaluateCertificateEligibility($user);

        $activePodIds = $memberships->pluck('pod_id')->all();
        $openPods = MentorshipPod::query()
            ->where('status', 'open')
            ->whereNotIn('id', $activePodIds)
            ->with('mentor:id,first_name,last_name,name')
            ->orderByDesc('id')
            ->limit(12)
            ->get();

        $activeMilestones = MentorshipMilestone::query()
            ->whereHas('mission.pod.memberships', function ($q) use ($user): void {
                $q->where('trainee_user_id', $user->id)
                    ->where('membership_status', 'active');
            })
            ->whereIn('status', ['open', 'revision_requested'])
            ->with(['mission:id,pod_id,title', 'mission.pod:id,title'])
            ->orderBy('due_date')
            ->limit(20)
            ->get();

        return view('frontend.mentorship.trainee-dashboard', [
            'user' => $user,
            'memberships' => $memberships,
            'stats' => $stats,
            'certificate' => $certificate,
            'openPods' => $openPods,
            'activeMilestones' => $activeMilestones,
        ]);
    }

    public function applyToPod(Request $request, MentorshipPod $pod): RedirectResponse
    {
        $user = Auth::guard('web')->user();

        if ((int) $pod->mentor_user_id === (int) $user->id) {
            return back()->with('error', 'Impossible de candidater a son propre pod.');
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
        $membership->save();

        return back()->with('success', 'Candidature envoyee au mentor.');
    }

    public function submitMilestone(Request $request, MentorshipMilestone $milestone): RedirectResponse
    {
        $user = Auth::guard('web')->user();

        $isActiveMember = MentorshipMembership::query()
            ->where('pod_id', $milestone->mission->pod_id)
            ->where('trainee_user_id', $user->id)
            ->where('membership_status', 'active')
            ->exists();

        if (!$isActiveMember) {
            return back()->with('error', 'Vous devez etre stagiaire actif pour soumettre ce jalon.');
        }

        $validated = $request->validate([
            'submission_url' => 'nullable|url|max:1900',
            'notes' => 'nullable|string|max:5000',
        ]);

        MentorshipSubmission::create([
            'milestone_id' => $milestone->id,
            'trainee_user_id' => $user->id,
            'submission_url' => $validated['submission_url'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'submitted_at' => now(),
            'review_status' => 'pending',
        ]);

        $milestone->status = 'submitted';
        $milestone->save();

        $this->quality->syncMissionStatus($milestone->mission);

        return back()->with('success', 'Soumission envoyee au mentor.');
    }
}
