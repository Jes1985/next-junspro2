<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorOnboardingController extends Controller
{
    /**
     * Domaines de mentorat disponibles sur Junspro.
     */
    private const MENTOR_DOMAINS = [
        'web_dev'         => 'Développement web',
        'mobile_dev'      => 'Développement mobile',
        'design_ux'       => 'Design & UX/UI',
        'data_science'    => 'Data Science & IA',
        'devops'          => 'DevOps & Cloud',
        'marketing'       => 'Marketing digital',
        'copywriting'     => 'Copywriting & SEO',
        'video_prod'      => 'Production vidéo',
        'project_mgmt'    => 'Gestion de projet',
        'entrepreneurship'=> 'Entrepreneuriat',
        'finance'         => 'Finance & Comptabilité',
        'legal'           => 'Juridique & Protection IP',
    ];

    /**
     * Icônes emoji par domaine (utilisées dans le formulaire).
     */
    private const DOMAIN_ICONS = [
        'web_dev'         => '🌐',
        'mobile_dev'      => '📱',
        'design_ux'       => '🎨',
        'data_science'    => '🤖',
        'devops'          => '☁️',
        'marketing'       => '📣',
        'copywriting'     => '✍️',
        'video_prod'      => '🎬',
        'project_mgmt'    => '📋',
        'entrepreneurship'=> '🚀',
        'finance'         => '💰',
        'legal'           => '⚖️',
    ];

    /**
     * Affiche la page "Devenir mentor".
     */
    public function show(Request $request)
    {
        $user    = Auth::user();
        $profile = null;
        $eligibility = $this->checkEligibility($user);

        if ($user) {
            $profile = $user->freelancerProfile;
        }

        return view('frontend.mentorship.become-mentor', [
            'user'        => $user,
            'profile'     => $profile,
            'eligibility' => $eligibility,
            'domains'     => self::MENTOR_DOMAINS,
            'domainIcons' => self::DOMAIN_ICONS,
        ]);
    }

    /**
     * Traite la candidature mentor.
     */
    public function submit(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour candidater.');
        }

        $eligibility = $this->checkEligibility($user);

        if (!$eligibility['can_apply']) {
            return back()->with('error', 'Vous ne remplissez pas encore toutes les conditions requises.');
        }

        $validated = $request->validate([
            'mentor_bio'             => 'required|string|min:80|max:1000',
            'mentor_motivation'      => 'required|string|min:60|max:800',
            'mentor_years_experience'=> 'required|integer|min:1|max:40',
            'mentor_domains'         => 'required|array|min:1|max:5',
            'mentor_domains.*'       => 'string|in:' . implode(',', array_keys(self::MENTOR_DOMAINS)),
            'mentor_capacity'        => 'required|integer|min:1|max:8',
            'mentor_linkedin_url'    => 'nullable|url|max:500',
        ]);

        /** @var FreelancerProfile $profile */
        $profile = $user->freelancerProfile;

        if (!$profile) {
            return back()->with('error', 'Profil freelance introuvable. Veuillez compléter votre profil avant de candidater.');
        }

        // Si déjà actif, ne pas retraiter
        if ($profile->mentor_status === 'active') {
            return back()->with('info', 'Vous êtes déjà mentor actif sur Junspro.');
        }

        $profile->update([
            'mentor_bio'              => $validated['mentor_bio'],
            'mentor_motivation'       => $validated['mentor_motivation'],
            'mentor_years_experience' => $validated['mentor_years_experience'],
            'mentor_domains'          => $validated['mentor_domains'],
            'mentor_capacity'         => $validated['mentor_capacity'],
            'mentor_linkedin_url'     => $validated['mentor_linkedin_url'] ?? null,
            'mentor_status'           => 'pending',
        ]);

        return redirect()->route('mentor.onboarding.confirmation')
            ->with('success', 'Votre candidature a bien été reçue ! Elle sera examinée par notre équipe sous 48h.');
    }

    /**
     * Page de confirmation post-soumission.
     */
    public function confirmation()
    {
        return view('frontend.mentorship.become-mentor-confirmation');
    }

    /**
     * Vérifie les conditions d'éligibilité pour devenir mentor.
     */
    private function checkEligibility(?object $user): array
    {
        if (!$user) {
            return [
                'can_apply' => false,
                'is_logged_in' => false,
                'checks' => [],
            ];
        }

        $profile = $user->freelancerProfile;
        $isFreelancer = $profile !== null;

        $checks = [
            'is_freelancer' => [
                'label'  => 'Être inscrit en tant que freelance',
                'passed' => $isFreelancer,
                'tip'    => 'Créez votre profil freelance depuis votre espace personnel.',
            ],
            'is_verified' => [
                'label'  => 'Profil vérifié par Junspro',
                'passed' => $isFreelancer && (bool) $profile->is_verified,
                'tip'    => 'Soumettez votre document d\'identité pour obtenir la vérification.',
            ],
            'has_rate' => [
                'label'  => 'Taux horaire défini',
                'passed' => $isFreelancer && !empty($profile->hourly_rate) && $profile->hourly_rate > 0,
                'tip'    => 'Indiquez votre taux horaire dans votre profil.',
            ],
            'not_already_mentor' => [
                'label'  => 'Non encore mentor actif',
                'passed' => !($isFreelancer && $profile->mentor_status === 'active'),
                'tip'    => 'Vous êtes déjà mentor actif.',
            ],
            'not_pending' => [
                'label'  => 'Pas de candidature en cours d\'examen',
                'passed' => !($isFreelancer && $profile->mentor_status === 'pending'),
                'tip'    => 'Votre candidature est actuellement en cours d\'examen.',
            ],
        ];

        $canApply = collect($checks)->every(fn($c) => $c['passed']);

        return [
            'can_apply'    => $canApply,
            'is_logged_in' => true,
            'checks'       => $checks,
        ];
    }
}
