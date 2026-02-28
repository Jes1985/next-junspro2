<?php

namespace App\Http\Controllers\FrontEnd\Freelance;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OnboardingController extends Controller
{
    /**
     * Afficher la page "Devenir freelance" (landing page premium)
     */
    public function start()
    {
        return view('frontend.freelance.become');
    }

    /**
     * Étape 1 : À propos - Informations de base
     */
    public function step1(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        // Vérifier que l'utilisateur a un profil freelance, sinon le créer
        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            // Créer le profil freelance s'il n'existe pas
            $freelancerProfile = FreelancerProfile::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'hourly_rate' => 0,
                    'reliability_score' => 100,
                    'wellness_plan' => 'none',
                    'is_verified' => false,
                ]
            );
        }

        // Récupérer les données existantes
        $services = $freelancerProfile->skills ?? [];
        $serviceScope = $this->extractServiceScope($freelancerProfile);
        $languages = $freelancerProfile->languages ?? [];
        
        // Si pas de langues, initialiser avec une langue vide
        if (empty($languages) || !is_array($languages)) {
            $languages = [['language' => '', 'level' => 'native']];
        }

        // Structure des catégories et sous-catégories de services
        $serviceCategories = $this->getServiceCategories();
        
        // Extraire le code pays et le numéro du téléphone si existant
        $phoneCountryCode = '+33';
        $phoneNumber = '';
        if (!empty($user->phone_number)) {
            // Si le téléphone contient un code pays (format: +33 6 12 34 56 78)
            if (preg_match('/^(\+\d{1,4})\s*(.+)$/', $user->phone_number, $matches)) {
                $phoneCountryCode = $matches[1];
                $phoneNumber = $matches[2];
            } else {
                $phoneNumber = $user->phone_number;
            }
        }
        
        $data = [
            'first_name' => $user->first_name ?? old('first_name', ''),
            'last_name' => $user->last_name ?? old('last_name', ''),
            'birth_country' => $user->country_code ?? old('birth_country', ''),
            'address' => $user->address ?? old('address', ''),
            'postal_code' => $user->postal_code ?? old('postal_code', '10001'),
            'phone' => old('phone', $phoneNumber),
            'phone_country_code' => old('phone_country_code', $phoneCountryCode),
            'age_confirmation' => old('age_confirmation', false),
            'services' => old('services', $services),
            'languages' => old('languages', $languages),
            'service_scope' => $serviceScope,
            'matching_filters' => old('matching_filters', $this->extractMatchingFilters($freelancerProfile)),
            'specialization_main' => old('specialization_main', (string)($freelancerProfile->specialization ?? '')),
            'specialization_additional' => old('specialization_additional', $this->extractAdditionalSpecializations($freelancerProfile)),
        ];
        $onboardingUniverseFilters = $this->buildOnboardingUniverseFilters();
        $specializationsByDomain = $this->buildSpecializationsByDomain();

        $identityDocuments = $this->extractIdentityDocuments($freelancerProfile->identity_document);
        $data['identity_document_front'] = $identityDocuments['front'];
        $data['identity_document_back'] = $identityDocuments['back'];
        $data['identity_document_front_name'] = $identityDocuments['front'] ? basename($identityDocuments['front']) : null;
        $data['identity_document_back_name'] = $identityDocuments['back'] ? basename($identityDocuments['back']) : null;

        return view('frontend.freelance.onboarding.step1', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
            'serviceCategories' => $serviceCategories,
            'onboardingUniverseFilters' => $onboardingUniverseFilters,
            'specializationsByDomain' => $specializationsByDomain,
        ]);
    }

    /**
     * Sauvegarder l'étape 1
     */
    public function step1Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'hourly_rate' => 0,
                'reliability_score' => 100,
                'wellness_plan' => 'none',
                'is_verified' => false,
            ]
        );

        $servicesConfig = config('services_universes', []);
        $allowedUniverses = array_keys((array)($servicesConfig['universes'] ?? []));
        $domainsByUniverse = (array)($servicesConfig['domains_by_universe'] ?? []);
        $allowedDomainsByUniverse = [];
        foreach ($domainsByUniverse as $universeSlug => $domainRows) {
            $allowedDomainsByUniverse[$universeSlug] = [];
            foreach ((array)$domainRows as $row) {
                if (is_array($row) && isset($row[0])) {
                    $allowedDomainsByUniverse[$universeSlug][] = (string)$row[0];
                }
            }
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'universes' => 'required|array|min:1',
            'universes.*' => 'required|string|max:64',
            'domains' => 'required|array|min:1',
            'domains.*' => 'required|string|max:128',
            'intervention_mode' => 'required|string|in:online,onsite,hybrid',
            'onsite_country' => 'required_if:intervention_mode,onsite,hybrid|nullable|string|max:8',
            'onsite_city' => 'required_if:intervention_mode,onsite,hybrid|nullable|string|max:255',
            'languages' => 'required|array|min:1',
            'languages.*.language' => 'required|string|max:255',
            'languages.*.level' => 'required|string|in:A1,A2,B1,B2,C1,C2,native,fluent,intermediate,beginner',
            'phone' => 'nullable|string|max:20',
            'phone_country_code' => 'nullable|string|max:10',
            'matching_filters' => 'nullable|array',
            'specialization_main' => 'nullable|string|max:128',
            'specialization_additional' => 'nullable|array',
            'specialization_additional.*' => 'nullable|string|max:128',
        ], [
            'first_name.required' => __('Le prénom est obligatoire.'),
            'last_name.required' => __('Le nom est obligatoire.'),
            'universes.required' => __('Vous devez sélectionner au moins un univers.'),
            'domains.required' => __('Vous devez sélectionner au moins un domaine.'),
            'intervention_mode.required' => __('Le mode d\'intervention est obligatoire.'),
            'onsite_country.required_if' => __('Le pays est obligatoire pour une intervention en présentiel/hybride.'),
            'onsite_city.required_if' => __('La ville est obligatoire pour une intervention en présentiel/hybride.'),
            'languages.required' => __('Vous devez ajouter au moins une langue.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $selectedUniverses = array_values(array_unique(array_filter((array)$request->input('universes', []), function ($u) use ($allowedUniverses) {
            return is_string($u) && in_array($u, $allowedUniverses, true);
        })));
        if (count($selectedUniverses) === 0) {
            return redirect()->back()
                ->withErrors(['universes' => __('Vous devez sélectionner au moins un univers valide.')])
                ->withInput();
        }

        $allowedDomains = [];
        foreach ($selectedUniverses as $u) {
            $allowedDomains = array_merge($allowedDomains, $allowedDomainsByUniverse[$u] ?? []);
        }
        $allowedDomains = array_values(array_unique($allowedDomains));

        $selectedDomains = array_values(array_unique(array_filter((array)$request->input('domains', []), function ($d) use ($allowedDomains) {
            return is_string($d) && in_array($d, $allowedDomains, true);
        })));
        if (count($selectedDomains) === 0) {
            return redirect()->back()
                ->withErrors(['domains' => __('Vous devez sélectionner au moins un domaine valide.')])
                ->withInput();
        }

        $mode = (string)$request->input('intervention_mode', 'online');
        $canOnline = in_array($mode, ['online', 'hybrid'], true);
        $canOnsite = in_array($mode, ['onsite', 'hybrid'], true);
        $onsiteCountry = $canOnsite ? (string)$request->input('onsite_country', '') : null;
        $onsiteCity = $canOnsite ? (string)$request->input('onsite_city', '') : null;
        $specializationsByDomain = $this->buildSpecializationsByDomain();
        $allowedSpecializationSlugs = [];
        foreach ($selectedDomains as $domainSlug) {
            $rows = (array)($specializationsByDomain[$domainSlug]['options'] ?? []);
            foreach ($rows as $row) {
                if (is_array($row) && isset($row[0])) {
                    $allowedSpecializationSlugs[] = (string)$row[0];
                }
            }
        }
        $allowedSpecializationSlugs = array_values(array_unique($allowedSpecializationSlugs));
        $specializationMain = (string)$request->input('specialization_main', '');
        if ($specializationMain === '' || !in_array($specializationMain, $allowedSpecializationSlugs, true)) {
            $specializationMain = '';
        }
        $additionalSpecializations = array_values(array_unique(array_filter((array)$request->input('specialization_additional', []), function ($slug) use ($allowedSpecializationSlugs, $specializationMain) {
            return is_string($slug) && $slug !== '' && $slug !== $specializationMain && in_array($slug, $allowedSpecializationSlugs, true);
        })));
        $incomingMatchingFilters = (array)$request->input('matching_filters', []);
        $matchingFilters = [];
        foreach ($selectedUniverses as $universeSlug) {
            $payload = $incomingMatchingFilters[$universeSlug] ?? null;
            if (!is_array($payload)) {
                continue;
            }
            $matchingFilters[$universeSlug] = array_filter($payload, function ($v) {
                return is_string($v) || is_numeric($v) || is_array($v);
            });
        }

        // Mettre à jour l'utilisateur
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        
        // Mettre à jour le téléphone si fourni
        if ($request->filled('phone')) {
            $phoneNumber = ($request->phone_country_code ?? '+33') . ' ' . $request->phone;
            $user->phone_number = $phoneNumber;
        }
        
        $user->save();

        $domainLabelMap = [];
        foreach ($domainsByUniverse as $domainRows) {
            foreach ((array)$domainRows as $row) {
                if (is_array($row) && isset($row[0], $row[1])) {
                    $domainLabelMap[(string)$row[0]] = (string)$row[1];
                }
            }
        }
        $freelancerProfile->skills = array_values(array_map(function ($slug) use ($domainLabelMap) {
            return $domainLabelMap[$slug] ?? $slug;
        }, $selectedDomains));
        $freelancerProfile->languages = $request->languages;
        $freelancerProfile->specialization = $specializationMain !== '' ? $specializationMain : null;

        if (Schema::hasColumn('freelancer_profiles', 'universes')) {
            $freelancerProfile->universes = $selectedUniverses;
        }
        if (Schema::hasColumn('freelancer_profiles', 'domains')) {
            $freelancerProfile->domains = $selectedDomains;
        }
        if (Schema::hasColumn('freelancer_profiles', 'can_online')) {
            $freelancerProfile->can_online = $canOnline;
        }
        if (Schema::hasColumn('freelancer_profiles', 'can_onsite')) {
            $freelancerProfile->can_onsite = $canOnsite;
        }
        if (Schema::hasColumn('freelancer_profiles', 'onsite_country')) {
            $freelancerProfile->onsite_country = $onsiteCountry ?: null;
        }
        if (Schema::hasColumn('freelancer_profiles', 'onsite_city')) {
            $freelancerProfile->onsite_city = $onsiteCity ?: null;
        }
        if (Schema::hasColumn('freelancer_profiles', 'matching_filters')) {
            $freelancerProfile->matching_filters = $matchingFilters;
        }
        if (Schema::hasColumn('freelancer_profiles', 'additional_specialization_ids')) {
            $freelancerProfile->additional_specialization_ids = $additionalSpecializations;
        }

        $freelancerProfile->save();

        return redirect()->route('freelance.onboarding.step2')
            ->with('success', __('Étape 1 enregistrée avec succès.'));
    }

    private function extractIdentityDocuments(?string $identityDocument): array
    {
        if (empty($identityDocument)) {
            return ['front' => null, 'back' => null];
        }

        $decoded = json_decode($identityDocument, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return [
                'front' => $decoded['front'] ?? null,
                'back' => $decoded['back'] ?? null,
            ];
        }

        // Rétrocompatibilité: ancienne valeur string = document unique (assimilé recto).
        return ['front' => $identityDocument, 'back' => null];
    }

    private function extractServiceScope(FreelancerProfile $profile): array
    {
        $servicesConfig = config('services_universes', []);
        $universesMap = (array)($servicesConfig['universes'] ?? []);
        $domainsByUniverse = (array)($servicesConfig['domains_by_universe'] ?? []);

        $domains = [];
        $universes = [];
        $domainUniverseIndex = [];
        $domainLabelIndex = [];
        foreach ($domainsByUniverse as $universeSlug => $rows) {
            foreach ((array)$rows as $row) {
                if (is_array($row) && isset($row[0], $row[1])) {
                    $slug = (string)$row[0];
                    $label = (string)$row[1];
                    $domainUniverseIndex[$slug] = $universeSlug;
                    $domainLabelIndex[\Illuminate\Support\Str::lower($label)] = $slug;
                }
            }
        }

        if (Schema::hasColumn('freelancer_profiles', 'universes') && is_array($profile->universes)) {
            $universes = array_values(array_filter($profile->universes, fn ($u) => isset($universesMap[$u])));
        }
        if (Schema::hasColumn('freelancer_profiles', 'domains') && is_array($profile->domains)) {
            $domains = array_values(array_filter($profile->domains, fn ($d) => isset($domainUniverseIndex[$d])));
        }

        if (empty($domains) && !empty($profile->skills) && is_array($profile->skills)) {
            foreach ($profile->skills as $skillLabel) {
                if (!is_string($skillLabel)) {
                    continue;
                }
                $slug = $domainLabelIndex[\Illuminate\Support\Str::lower($skillLabel)] ?? null;
                if ($slug && !in_array($slug, $domains, true)) {
                    $domains[] = $slug;
                }
            }
        }

        if (empty($universes) && !empty($domains)) {
            foreach ($domains as $domainSlug) {
                $u = $domainUniverseIndex[$domainSlug] ?? null;
                if ($u && !in_array($u, $universes, true)) {
                    $universes[] = $u;
                }
            }
        }

        $canOnline = Schema::hasColumn('freelancer_profiles', 'can_online') ? (bool)$profile->can_online : true;
        $canOnsite = Schema::hasColumn('freelancer_profiles', 'can_onsite') ? (bool)$profile->can_onsite : false;
        $mode = 'online';
        if ($canOnline && $canOnsite) {
            $mode = 'hybrid';
        } elseif (!$canOnline && $canOnsite) {
            $mode = 'onsite';
        }

        $onsiteCountry = Schema::hasColumn('freelancer_profiles', 'onsite_country') ? (string)($profile->onsite_country ?? '') : '';
        $onsiteCity = Schema::hasColumn('freelancer_profiles', 'onsite_city') ? (string)($profile->onsite_city ?? '') : '';

        return [
            'universes' => $universes,
            'domains' => $domains,
            'intervention_mode' => $mode,
            'can_online' => $canOnline,
            'can_onsite' => $canOnsite,
            'onsite_country' => $onsiteCountry,
            'onsite_city' => $onsiteCity,
        ];
    }

    private function extractMatchingFilters(FreelancerProfile $profile): array
    {
        if (!Schema::hasColumn('freelancer_profiles', 'matching_filters')) {
            return [];
        }
        return is_array($profile->matching_filters) ? $profile->matching_filters : [];
    }

    private function extractAdditionalSpecializations(FreelancerProfile $profile): array
    {
        if (!Schema::hasColumn('freelancer_profiles', 'additional_specialization_ids')) {
            return [];
        }
        return is_array($profile->additional_specialization_ids) ? array_values(array_filter($profile->additional_specialization_ids, fn ($v) => is_string($v) && $v !== '')) : [];
    }

    private function buildSpecializationsByDomain(): array
    {
        return [
            'strategie-conseil' => ['label' => 'Stratégie & Conseil', 'options' => [
                ['conseil_strategique', 'Conseil stratégique'],
                ['business_plan_modelisation', 'Business plan & modélisation'],
                ['etude_de_marche', 'Étude de marché'],
                ['structuration_de_projet', 'Structuration de projet'],
                ['pilotage_gouvernance', 'Pilotage & gouvernance'],
            ]],
            'marketing-croissance' => ['label' => 'Marketing & Croissance', 'options' => [
                ['strategie_marketing', 'Stratégie marketing'],
                ['branding_positionnement', 'Branding & positionnement'],
                ['acquisition_visibilite', 'Acquisition & visibilité'],
                ['content_marketing', 'Content marketing'],
                ['crm_email_marketing', 'CRM & Email marketing'],
            ]],
            'tech-produits-digitaux' => ['label' => 'Tech & Produits digitaux', 'options' => [
                ['developpement_web', 'Développement web'],
                ['nocode_automatisation', 'No-code & automatisation'],
                ['maintenance_optimisation_continue', 'Maintenance & optimisation continue'],
                ['outils_data_ia_appliquee', 'Outils data & IA appliquée'],
            ]],
            'creation-image-marque' => ['label' => 'Création & Image de marque', 'options' => [
                ['design_branding', 'Design & branding'],
                ['ux_ui', 'UX / UI'],
                ['video_motion_design', 'Vidéo & motion design'],
                ['copywriting_strategique', 'Copywriting stratégique'],
            ]],
            'formation-accompagnement' => ['label' => 'Formation & Accompagnement', 'options' => [
                ['coaching_professionnel', 'Coaching professionnel'],
                ['formation_business', 'Formation business'],
                ['mentorat_strategique', 'Mentorat stratégique'],
                ['accompagnement_dirigeants', 'Accompagnement dirigeants'],
            ]],
            'langues' => ['label' => 'Langues', 'options' => [
                ['anglais', 'Anglais'], ['francais', 'Français'], ['espagnol', 'Espagnol'], ['allemand', 'Allemand'], ['italien', 'Italien'], ['arabe', 'Arabe'],
            ]],
            'certifications' => ['label' => 'Certifications', 'options' => [
                ['ielts', 'IELTS'], ['toefl', 'TOEFL'], ['toeic', 'TOEIC'], ['cambridge', 'Cambridge (A2–C2)'], ['delf', 'DELF'], ['dalf', 'DALF'],
            ]],
            'soutien-scolaire' => ['label' => 'Soutien scolaire', 'options' => [
                ['mathematiques', 'Mathématiques'], ['francais_scolaire', 'Français'], ['anglais_scolaire', 'Anglais scolaire'], ['physique', 'Physique'], ['chimie', 'Chimie'], ['biologie', 'Biologie'],
            ]],
            'etudes-superieur' => ['label' => 'Études & supérieur', 'options' => [
                ['statistiques', 'Statistiques'], ['droit_bases', 'Droit (bases)'], ['sciences_sociales', 'Sciences sociales'], ['philosophie', 'Philosophie'], ['methodologie', 'Méthodologie'],
            ]],
            'tech-outils' => ['label' => 'Tech & outils', 'options' => [
                ['programmation', 'Programmation'], ['developpement_web', 'Développement Web'], ['data_ia_initiation', 'Data / IA (initiation)'], ['bureautique', 'Bureautique'], ['nocode', 'No-code'], ['cyber_bases', 'Cybersécurité (bases)'],
            ]],
            'carriere-soft-skills' => ['label' => 'Carrière & soft skills', 'options' => [
                ['communication_pro', 'Communication pro'], ['presentations', 'Présentations'], ['entretiens', 'Entretiens d\'embauche'], ['cv_linkedin', 'CV / LinkedIn'], ['gestion_projet', 'Gestion de projet'],
            ]],
            'beaute-soins' => ['label' => 'Beauté & soins', 'options' => [
                ['beaute', 'Beauté'], ['coiffure', 'Coiffure'], ['manucure', 'Manucure'], ['soins_visage', 'Soins du visage'], ['epilation', 'Épilation'], ['maquillage', 'Maquillage'],
            ]],
            'massage-relaxation' => ['label' => 'Massage & relaxation', 'options' => [
                ['massage_relaxation', 'Massage & relaxation'], ['amma_assis', 'Amma assis'], ['do_in', 'Do-In'], ['reflexologie', 'Réflexologie'], ['relaxation', 'Relaxation'],
            ]],
            'menage-repassage' => ['label' => 'Ménage & repassage', 'options' => [
                ['menage', 'Ménage'], ['repassage', 'Repassage'], ['entretien_domicile', 'Entretien du domicile'],
            ]],
            'bien-etre-sport' => ['label' => 'Bien-être & sport', 'options' => [
                ['coaching_sportif', 'Coaching sportif'], ['bien_etre', 'Bien-être'], ['yoga_domicile', 'Yoga à domicile'], ['pilates', 'Pilates'], ['stretching', 'Stretching'],
            ]],
            'accompagnement' => ['label' => 'Accompagnement', 'options' => [
                ['accompagnement_familial', 'Accompagnement familial'], ['garde_enfants', 'Garde d\'enfants'], ['aide_personne', 'Aide à la personne'],
            ]],
            'cardio-training' => ['label' => 'Cardio-Training', 'options' => [
                ['boxing', 'Boxing'], ['cross_training', 'Cross Training'], ['hiit_cardio', 'HIIT Cardio'], ['hiit_force', 'HIIT Force'], ['step', 'Step'], ['self_defense', 'Self-Défense'],
            ]],
            'renforcement-musculaire' => ['label' => 'Renforcement Musculaire', 'options' => [
                ['pilates', 'Pilates'], ['pilates_materiels', 'Pilates (petits matériels)'], ['pilates_ball', 'Pilates Ball'], ['trx', 'TRX'], ['caf', 'Cuisses-Abdos-Fessiers (CAF)'], ['af', 'Abdos & Fessiers (AF)'],
            ]],
            'bien-etre' => ['label' => 'Bien-Etre', 'options' => [
                ['stretching', 'Stretching'], ['ritual_flow', 'Ritual Flow'], ['ritual_recup', 'Ritual Récup\''], ['yoga', 'Yoga'], ['yoga_energie', 'Yoga Énergie'], ['yoga_antistress', 'Yoga Anti-stress'],
            ]],
            'danse' => ['label' => 'Danse', 'options' => [
                ['zumba', 'Zumba'], ['hiphop', 'Hip-Hop'], ['afro_move', 'Afro Move'], ['dance_workout', 'Dance Workout'], ['aerien', 'Aérien'], ['dance_hiit', 'Dance HIIT'],
            ]],
            'court-sejour' => ['label' => 'Court séjour', 'options' => [['court_sejour', 'Court séjour']]],
            'moyen-sejour' => ['label' => 'Moyen séjour', 'options' => [['moyen_sejour', 'Moyen séjour']]],
            'long-sejour' => ['label' => 'Long séjour', 'options' => [['long_sejour', 'Long séjour']]],
            'pause-souffle' => ['label' => 'Pause Souffle', 'options' => [
                ['clarte_priorites', 'Clarté & priorités'], ['transition_vie', 'Transition de vie'], ['equilibre_charge_mentale', 'Équilibre & charge mentale'], ['leadership_decision', 'Leadership & décision'],
            ]],
            'experiences-bien-etre-serinite' => ['label' => 'Expériences Bien-Être & Sérénité', 'options' => [
                ['massage_amma_entreprise', 'Massage amma assis (entreprise)'], ['journee_bien_etre_entreprise', 'Journée bien-être en entreprise'], ['espace_bien_etre_evenementiel', 'Espace bien-être événementiel'],
            ]],
            'team-building-cohesion-qvt' => ['label' => 'Team Building & Cohésion (QVT)', 'options' => [
                ['team_building_presentiel', 'Team building en présentiel'], ['journee_qvt', 'Journée QVT'], ['cohesion_equipe', 'Cohésion d\'équipe'],
            ]],
            'evenements-vie-celebrations' => ['label' => 'Événements de Vie & Célébrations', 'options' => [
                ['evjf', 'EVJF'], ['evg', 'EVG'], ['preparation_mariage', 'Préparation mariage'], ['anniversaire', 'Anniversaire'],
            ]],
            'vitalite-experiences-immersives' => ['label' => 'Vitalité & Expériences Immersives', 'options' => [
                ['journee_vitalite', 'Journée vitalité'], ['pilates_groupe', 'Pilates en groupe'], ['yoga_groupe', 'Yoga en groupe'],
            ]],
            'intervenants-experts-experience-humaine' => ['label' => 'Intervenants & Experts en Expérience Humaine', 'options' => [
                ['praticien_massage_amma', 'Praticien massage amma'], ['professeur_pilates', 'Professeur Pilates'], ['professeur_yoga', 'Professeur yoga'], ['conferencier', 'Conférencier'],
            ]],
            'partenaires-logistique-evenementielle' => ['label' => 'Partenaires & Logistique Événementielle', 'options' => [
                ['location_salle', 'Location de salle'], ['traiteur_evenementiel', 'Traiteur événementiel'], ['personnel_evenementiel', 'Personnel événementiel'], ['son_audiovisuel', 'Son & audiovisuel'],
            ]],
        ];
    }

    private function buildOnboardingUniverseFilters(): array
    {
        $cfg = config('services_universes', []);
        $domainsByUniverse = (array)($cfg['domains_by_universe'] ?? []);

        $projectsLike = function (string $u) use ($domainsByUniverse): array {
            $rows = [];
            foreach ((array)($domainsByUniverse[$u] ?? []) as $row) {
                if (is_array($row) && isset($row[0], $row[1])) {
                    $rows[] = ['slug' => (string)$row[0], 'label' => (string)$row[1], 'description' => ''];
                }
            }
            return $rows;
        };

        $lessonsLike = function (string $u) use ($domainsByUniverse): array {
            $rows = [];
            foreach ((array)($domainsByUniverse[$u] ?? []) as $row) {
                if (is_array($row) && isset($row[1])) {
                    $label = (string)$row[1];
                    $rows[$label] = [$label];
                }
            }
            return $rows;
        };

        return [
            'projects' => [
                'categories' => $projectsLike('projects'),
                'lessonGoals' => [],
                'hierarchyMode' => true,
            ],
            'lessons' => [
                'categories' => $lessonsLike('lessons'),
                'lessonGoals' => [
                    'conversation_beginner' => 'Conversation (Débutant)',
                    'conversation_intermediate' => 'Conversation (Intermédiaire)',
                    'conversation_advanced' => 'Conversation (Avancé)',
                    'business' => 'Business',
                    'exams' => 'Examens',
                    'kids' => 'Enfants',
                    'travel' => 'Voyage',
                ],
                'hierarchyMode' => true,
            ],
            'at-home' => [
                'categories' => $lessonsLike('at-home'),
                'lessonGoals' => [],
                'hierarchyMode' => true,
            ],
            'wellnesslive' => [
                'categories' => $lessonsLike('wellnesslive'),
                'lessonGoals' => [],
                'hierarchyMode' => true,
            ],
            'homeswap' => [
                'categories' => $projectsLike('homeswap'),
                'lessonGoals' => [],
                'hierarchyMode' => true,
            ],
            'corporate' => [
                'categories' => $projectsLike('corporate'),
                'lessonGoals' => [],
                'hierarchyMode' => true,
            ],
        ];
    }

    /**
     * Obtenir les catégories et sous-catégories de services
     */
    private function getServiceCategories()
    {
        // Déterminer la langue (français par défaut)
        $locale = Session::get('currentLocaleCode', 'fr');
        $isEnglish = $locale === 'en' || $locale === 'english';

        if ($isEnglish) {
            return [
                [
                    'name' => 'GRAPHICS & DESIGN',
                    'icon' => '🎨',
                    'subcategories' => [
                        'Logo Design', 'Brand Identity', 'Web Design', 'UI/UX Design',
                        'Print Design', 'Packaging Design', 'Illustration', 'Icon Design'
                    ]
                ],
                [
                    'name' => 'DIGITAL MARKETING',
                    'icon' => '📢',
                    'subcategories' => [
                        'Social Media Marketing', 'SEO', 'Content Marketing', 'Email Marketing',
                        'PPC Advertising', 'Influencer Marketing', 'Marketing Strategy', 'Analytics'
                    ]
                ],
                [
                    'name' => 'PROGRAMMING & TECH',
                    'icon' => '💻',
                    'subcategories' => [
                        'Web Development', 'Mobile Development', 'Desktop Development',
                        'Game Development', 'E-commerce Development', 'API Development',
                        'DevOps', 'QA & Testing'
                    ]
                ],
                [
                    'name' => 'VIDEO & ANIMATION',
                    'icon' => '🎬',
                    'subcategories' => [
                        'Video Editing', 'Animation', 'Motion Graphics', 'Video Production',
                        'Video Marketing', '3D Animation', 'Visual Effects', 'Video Transcription'
                    ]
                ],
                [
                    'name' => 'WRITING & TRANSLATION',
                    'icon' => '✍️',
                    'subcategories' => [
                        'Content Writing', 'Copywriting', 'Translation', 'Proofreading',
                        'Technical Writing', 'Creative Writing', 'Blog Writing', 'Resume Writing'
                    ]
                ],
                [
                    'name' => 'MUSIC & AUDIO',
                    'icon' => '🎵',
                    'subcategories' => [
                        'Music Production', 'Voice Over', 'Audio Editing', 'Sound Design',
                        'Mixing & Mastering', 'Podcast Production', 'Jingles', 'Audio Transcription'
                    ]
                ],
                [
                    'name' => 'BUSINESS',
                    'icon' => '💼',
                    'subcategories' => [
                        'Business Consulting', 'Financial Consulting', 'Legal Consulting',
                        'Virtual Assistant', 'Data Entry', 'Project Management', 'Business Plans',
                        'Market Research'
                    ]
                ],
                [
                    'name' => 'LIFESTYLE',
                    'icon' => '⭐',
                    'subcategories' => [
                        'Life Coaching', 'Fitness', 'Nutrition', 'Beauty', 'Fashion',
                        'Travel Planning', 'Event Planning', 'Personal Styling'
                    ]
                ],
                [
                    'name' => 'DATA & ANALYTICS',
                    'icon' => '📊',
                    'subcategories' => [
                        'Data Analysis', 'Data Visualization', 'Data Entry', 'Data Science',
                        'Machine Learning', 'Business Intelligence', 'Excel', 'Database Management'
                    ]
                ],
                [
                    'name' => 'ENGINEERING & ARCHITECTURE',
                    'icon' => '🏗️',
                    'subcategories' => [
                        'Architecture', 'Engineering', 'CAD', '3D Modeling', 'Structural Engineering',
                        'Electrical Engineering', 'Mechanical Engineering', 'Interior Design'
                    ]
                ],
                [
                    'name' => 'AI SERVICES',
                    'icon' => '🤖',
                    'subcategories' => [
                        'AI Chatbots', 'AI Consulting', 'Machine Learning', 'Natural Language Processing',
                        'Computer Vision', 'AI Integration', 'AI Training', 'AI Strategy'
                    ]
                ],
                [
                    'name' => 'PHOTOGRAPHY',
                    'icon' => '📷',
                    'subcategories' => [
                        'Product Photography', 'Portrait Photography', 'Event Photography',
                        'Real Estate Photography', 'Photo Editing', 'Photo Retouching',
                        'Drone Photography', 'Food Photography'
                    ]
                ],
                [
                    'name' => 'TRADING',
                    'icon' => '📈',
                    'subcategories' => [
                        'Forex Trading', 'Stock Trading', 'Cryptocurrency Trading',
                        'Trading Strategy', 'Market Analysis', 'Investment Consulting'
                    ]
                ]
            ];
        } else {
            // Français
            return [
                [
                    'name' => 'GRAPHISME & DESIGN',
                    'icon' => '🎨',
                    'subcategories' => [
                        'Création de logo', 'Identité de marque', 'Design web', 'Design UI/UX',
                        'Design print', 'Design d\'emballage', 'Illustration', 'Design d\'icônes'
                    ]
                ],
                [
                    'name' => 'MARKETING DIGITAL',
                    'icon' => '📢',
                    'subcategories' => [
                        'Marketing des réseaux sociaux', 'SEO', 'Marketing de contenu', 'Email marketing',
                        'Publicité PPC', 'Marketing d\'influence', 'Stratégie marketing', 'Analytique'
                    ]
                ],
                [
                    'name' => 'PROGRAMMATION & TECH',
                    'icon' => '💻',
                    'subcategories' => [
                        'Développement Web', 'Développement Mobile', 'Développement Desktop',
                        'Développement de jeux', 'Développement E-commerce', 'Développement API',
                        'DevOps', 'QA & Tests'
                    ]
                ],
                [
                    'name' => 'VIDÉO & ANIMATION',
                    'icon' => '🎬',
                    'subcategories' => [
                        'Montage vidéo', 'Animation', 'Motion design', 'Production vidéo',
                        'Marketing vidéo', 'Animation 3D', 'Effets visuels', 'Transcription vidéo'
                    ]
                ],
                [
                    'name' => 'RÉDACTION & TRADUCTION',
                    'icon' => '✍️',
                    'subcategories' => [
                        'Rédaction de contenu', 'Rédaction publicitaire', 'Traduction', 'Correction',
                        'Rédaction technique', 'Rédaction créative', 'Rédaction de blog', 'Rédaction de CV'
                    ]
                ],
                [
                    'name' => 'MUSIQUE & AUDIO',
                    'icon' => '🎵',
                    'subcategories' => [
                        'Production musicale', 'Voix off', 'Montage audio', 'Design sonore',
                        'Mixage & Mastering', 'Production de podcast', 'Jingles', 'Transcription audio'
                    ]
                ],
                [
                    'name' => 'BUSINESS',
                    'icon' => '💼',
                    'subcategories' => [
                        'Conseil en affaires', 'Conseil financier', 'Conseil juridique',
                        'Assistant virtuel', 'Saisie de données', 'Gestion de projet', 'Plans d\'affaires',
                        'Étude de marché'
                    ]
                ],
                [
                    'name' => 'STYLE DE VIE',
                    'icon' => '⭐',
                    'subcategories' => [
                        'Coaching de vie', 'Fitness', 'Nutrition', 'Beauté', 'Mode',
                        'Planification de voyage', 'Organisation d\'événements', 'Styling personnel'
                    ]
                ],
                [
                    'name' => 'DONNÉES & ANALYSE',
                    'icon' => '📊',
                    'subcategories' => [
                        'Analyse de données', 'Visualisation de données', 'Saisie de données', 'Science des données',
                        'Machine Learning', 'Business Intelligence', 'Excel', 'Gestion de base de données'
                    ]
                ],
                [
                    'name' => 'INGÉNIERIE & ARCHITECTURE',
                    'icon' => '🏗️',
                    'subcategories' => [
                        'Architecture', 'Ingénierie', 'CAO', 'Modélisation 3D', 'Ingénierie structurelle',
                        'Ingénierie électrique', 'Ingénierie mécanique', 'Design d\'intérieur'
                    ]
                ],
                [
                    'name' => 'SERVICES IA',
                    'icon' => '🤖',
                    'subcategories' => [
                        'Chatbots IA', 'Conseil IA', 'Machine Learning', 'Traitement du langage naturel',
                        'Vision par ordinateur', 'Intégration IA', 'Formation IA', 'Stratégie IA'
                    ]
                ],
                [
                    'name' => 'PHOTOGRAPHIE',
                    'icon' => '📷',
                    'subcategories' => [
                        'Photographie de produit', 'Photographie portrait', 'Photographie d\'événement',
                        'Photographie immobilière', 'Retouche photo', 'Édition photo',
                        'Photographie par drone', 'Photographie culinaire'
                    ]
                ],
                [
                    'name' => 'TRADING',
                    'icon' => '📈',
                    'subcategories' => [
                        'Trading Forex', 'Trading d\'actions', 'Trading de cryptomonnaies',
                        'Stratégie de trading', 'Analyse de marché', 'Conseil en investissement'
                    ]
                ]
            ];
        }
    }

    /**
     * Étape 2 : Photo de profil
     */
    public function step2(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        return view('frontend.freelance.onboarding.step2', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
        ]);
    }

    /**
     * Sauvegarder l'étape 2 (photo de profil)
     */
    public function step2Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        // Vérifier si l'utilisateur a déjà une photo
        $hasExistingPhoto = !empty($user->image);
        
        $validator = Validator::make($request->all(), [
            'photo' => $hasExistingPhoto ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120' : 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max
        ], [
            'photo.required' => __('Veuillez sélectionner une photo.'),
            'photo.image' => __('Le fichier doit être une image.'),
            'photo.mimes' => __('Le format de l\'image doit être JPG, PNG ou WEBP.'),
            'photo.max' => __('L\'image ne doit pas dépasser 5 Mo.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Sauvegarder la nouvelle photo si fournie
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->image && Storage::disk('public')->exists('img/users/' . $user->image)) {
                Storage::disk('public')->delete('img/users/' . $user->image);
            }

            // Sauvegarder la nouvelle photo
            $photo = $request->file('photo');
            $filename = 'freelance_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('img/users', $filename, 'public');

            // Mettre à jour l'utilisateur
            $user->image = $filename;
            $user->save();
        }

        // Rediriger vers l'étape 3 (Certifications)
        return redirect()->route('freelance.onboarding.step3')
            ->with('success', __('Photo de profil enregistrée avec succès.'));
    }

    /**
     * Étape 3 : Certifications
     */
    public function step3(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Récupérer les certifications existantes
        $certifications = $freelancerProfile->certifications ?? [];
        if (empty($certifications) || !is_array($certifications)) {
            $certifications = [];
        }

        $data = [
            'certifications' => old('certifications', $certifications),
            'no_certificate' => old('no_certificate', empty($certifications)),
        ];

        return view('frontend.freelance.onboarding.step3', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 3 (Certifications)
     */
    public function step3Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Si l'utilisateur n'a pas de certificat, on passe directement à l'étape suivante
        if ($request->has('no_certificate') && $request->no_certificate == '1') {
            $freelancerProfile->certifications = [];
            $freelancerProfile->save();
            
        // Rediriger vers l'étape 4 (Formation)
        return redirect()->route('freelance.onboarding.step4')
                ->with('success', __('Informations enregistrées avec succès.'));
        }

        // Validation des certifications
        $validator = Validator::make($request->all(), [
            'certifications' => 'required|array|min:1',
            'certifications.*.subject' => 'required|string|max:255',
            'certifications.*.name' => 'required|string|max:255',
            'certifications.*.description' => 'required|string|max:2000',
            'certificate_file.*' => 'nullable|image|mimes:jpeg,png,jpg|max:20480', // 20MB max
        ], [
            'certifications.required' => __('Vous devez ajouter au moins une certification ou cocher "Je n\'ai pas de certification".'),
            'certifications.min' => __('Vous devez ajouter au moins une certification ou cocher "Je n\'ai pas de certification".'),
            'certifications.*.subject.required' => __('Le domaine de compétences est obligatoire.'),
            'certifications.*.name.required' => __('Le nom de la certification est obligatoire.'),
            'certifications.*.description.required' => __('La description est obligatoire.'),
            'certificate_file.*.image' => __('Le fichier doit être une image.'),
            'certificate_file.*.mimes' => __('Le format de l\'image doit être JPG ou PNG.'),
            'certificate_file.*.max' => __('L\'image ne doit pas dépasser 20 Mo.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sauvegarder les certifications
        $certifications = [];
        foreach ($request->certifications as $cert) {
            $certifications[] = [
                'subject' => $cert['subject'],
                'name' => $cert['name'],
                'description' => $cert['description'],
            ];
        }
        $freelancerProfile->certifications = $certifications;

        // Sauvegarder les fichiers de certificats si fournis
        if ($request->hasFile('certificate_file')) {
            $certificateFiles = [];
            foreach ($request->file('certificate_file') as $file) {
                $filename = 'certificate_' . $user->id . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('img/certificates', $filename, 'public');
                $certificateFiles[] = $filename;
            }
            // Stocker les noms de fichiers dans le profil (vous pouvez créer une colonne dédiée si nécessaire)
            $freelancerProfile->certificate_files = $certificateFiles;
        }

        $freelancerProfile->save();

        // Rediriger vers l'étape 4 (Formation)
        return redirect()->route('freelance.onboarding.step4')
            ->with('success', __('Certifications enregistrées avec succès.'));
    }

    /**
     * Étape 4 : Formation
     */
    public function step4(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        $data = [
            'university' => old('university', $freelancerProfile->university ?? ''),
            'degree' => old('degree', $freelancerProfile->degree ?? ''),
            'degree_type' => old('degree_type', $freelancerProfile->degree_type ?? ''),
            'specialization' => old('specialization', $freelancerProfile->specialization ?? ''),
            'study_start_year' => old('study_start_year', $freelancerProfile->study_start_year ?? ''),
            'study_end_year' => old('study_end_year', $freelancerProfile->study_end_year ?? ''),
            'no_degree' => old('no_degree', $freelancerProfile->no_degree ?? false),
            'diploma_files' => $freelancerProfile->diploma_files ?? [],
        ];

        return view('frontend.freelance.onboarding.step4', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 4 (Formation)
     */
    public function step4Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Si l'utilisateur n'a pas de diplôme, on passe directement à l'étape suivante
        if (($request->has('no_degree') && $request->no_degree == '1') || ($request->has('no_degree_submitted') && $request->no_degree_submitted == '1')) {
            $freelancerProfile->no_degree = true;
            $freelancerProfile->university = null;
            $freelancerProfile->degree = null;
            $freelancerProfile->degree_type = null;
            $freelancerProfile->specialization = null;
            $freelancerProfile->study_start_year = null;
            $freelancerProfile->study_end_year = null;
            $freelancerProfile->diploma_files = null;
            $freelancerProfile->save();
            
            // Rediriger vers l'étape 5 (Description)
            return redirect()->route('freelance.onboarding.step5')
                ->with('success', __('Informations enregistrées avec succès.'));
        }

        // Validation des champs de formation
        $validator = Validator::make($request->all(), [
            'university' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'degree_type' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'study_start_year' => 'required|integer|min:1950|max:' . date('Y'),
            'study_end_year' => 'nullable|integer|min:1950|max:' . (date('Y') + 10),
            'diploma_file.*' => 'nullable|image|mimes:jpeg,png,jpg|max:20480', // 20MB max
        ], [
            'university.required' => __('Le nom de l\'université ou établissement est obligatoire.'),
            'degree.required' => __('Le nom du diplôme est obligatoire.'),
            'degree_type.required' => __('Le type de diplôme est obligatoire.'),
            'study_start_year.required' => __('L\'année de début d\'études est obligatoire.'),
            'study_start_year.integer' => __('L\'année de début doit être un nombre.'),
            'study_start_year.min' => __('L\'année de début doit être supérieure à 1950.'),
            'study_start_year.max' => __('L\'année de début ne peut pas être dans le futur.'),
            'study_end_year.integer' => __('L\'année de fin doit être un nombre.'),
            'study_end_year.min' => __('L\'année de fin doit être supérieure à 1950.'),
            'diploma_file.*.image' => __('Le fichier doit être une image.'),
            'diploma_file.*.mimes' => __('Le format de l\'image doit être JPG ou PNG.'),
            'diploma_file.*.max' => __('L\'image ne doit pas dépasser 20 Mo.'),
        ]);

        // Validation supplémentaire : année de fin >= année de début (seulement si pas de diplôme n'est pas coché)
        if (!$hasNoDegree && $request->filled('study_end_year') && $request->filled('study_start_year')) {
            if ($request->study_end_year < $request->study_start_year) {
                $validator->errors()->add('study_end_year', __('L\'année de fin doit être supérieure ou égale à l\'année de début.'));
            }
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sauvegarder les informations de formation
        if (!$hasNoDegree) {
            $freelancerProfile->university = $request->university;
            $freelancerProfile->degree = $request->degree;
            $freelancerProfile->degree_type = $request->degree_type;
            $freelancerProfile->specialization = $request->specialization;
            $freelancerProfile->study_start_year = $request->study_start_year;
            $freelancerProfile->study_end_year = $request->study_end_year;
            $freelancerProfile->no_degree = false;
        }

        // Sauvegarder les fichiers de diplômes si fournis
        if ($request->hasFile('diploma_file')) {
            $diplomaFiles = $freelancerProfile->diploma_files ?? [];
            foreach ($request->file('diploma_file') as $file) {
                $filename = 'diploma_' . $user->id . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('img/diplomas', $filename, 'public');
                $diplomaFiles[] = $filename;
            }
            $freelancerProfile->diploma_files = $diplomaFiles;
        }

        $freelancerProfile->save();

        // Rediriger vers l'étape 5 (Description)
        return redirect()->route('freelance.onboarding.step5')
            ->with('success', __('Informations de formation enregistrées avec succès.'));
    }

    /**
     * Étape 5 : Description du profil
     */
    public function step5(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        $data = [
            'bio' => old('bio', $freelancerProfile->bio ?? ''),
        ];

        return view('frontend.freelance.onboarding.step5', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 5 (Description du profil)
     */
    public function step5Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'bio' => 'required|string|min:100|max:5000',
        ], [
            'bio.required' => __('La description professionnelle est obligatoire.'),
            'bio.min' => __('La description professionnelle doit contenir au moins 100 caractères.'),
            'bio.max' => __('La description professionnelle ne doit pas dépasser 5000 caractères.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sauvegarder la description professionnelle
        $freelancerProfile->bio = $request->bio;

        $freelancerProfile->save();

        // Rediriger vers l'étape 6 (Vidéo)
        return redirect()->route('freelance.onboarding.step6')
            ->with('success', __('Description du profil enregistrée avec succès.'));
    }

    /**
     * Étape 6 : Vidéo de présentation
     */
    public function step6(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        $data = [
            'video_url' => old('video_url', $freelancerProfile->video_url ?? ''),
            'video_thumbnail_url' => old('video_thumbnail_url', $freelancerProfile->video_thumbnail_url ?? ''),
        ];

        return view('frontend.freelance.onboarding.step6', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 6 (Vidéo de présentation)
     */
    public function step6Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'video_url' => 'nullable|url|max:500',
            'video_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max
        ], [
            'video_url.url' => __('L\'URL de la vidéo doit être valide.'),
            'video_url.max' => __('L\'URL de la vidéo ne doit pas dépasser 500 caractères.'),
            'video_thumbnail.image' => __('Le fichier doit être une image.'),
            'video_thumbnail.mimes' => __('Le format de l\'image doit être JPG, PNG ou WEBP.'),
            'video_thumbnail.max' => __('L\'image ne doit pas dépasser 5 Mo.'),
        ]);

        // Note: La vidéo est optionnelle pour permettre de passer à l'étape suivante
        // L'utilisateur peut ajouter sa vidéo plus tard

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Sauvegarder l'URL de la vidéo si fournie
        if ($request->filled('video_url')) {
            $freelancerProfile->video_url = $request->video_url;
        }

        // Sauvegarder la miniature vidéo si fournie
        if ($request->hasFile('video_thumbnail')) {
            // Supprimer l'ancienne miniature si elle existe
            if ($freelancerProfile->video_thumbnail_url && Storage::disk('public')->exists('img/video-thumbnails/' . $freelancerProfile->video_thumbnail_url)) {
                Storage::disk('public')->delete('img/video-thumbnails/' . $freelancerProfile->video_thumbnail_url);
            }

            // Sauvegarder la nouvelle miniature
            $thumbnail = $request->file('video_thumbnail');
            $filename = 'video_thumbnail_' . $user->id . '_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->storeAs('img/video-thumbnails', $filename, 'public');
            $freelancerProfile->video_thumbnail_url = asset('storage/img/video-thumbnails/' . $filename);
        }

        $freelancerProfile->save();

        // Rediriger vers l'étape 7 (Disponibilité)
        return redirect()->route('freelance.onboarding.step7')
            ->with('success', __('Vidéo de présentation enregistrée avec succès.'));
    }

    /**
     * Étape 7 : Disponibilité
     */
    public function step7(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Récupérer les données existantes
        $timezone = old('timezone', $freelancerProfile->timezone ?? $user->timezone ?? '');
        $availability = old('availability', $user->availability ?? []);

        // Si availability est une chaîne JSON, la décoder
        if (is_string($availability)) {
            $availability = json_decode($availability, true) ?? [];
        }

        $data = [
            'timezone' => $timezone,
            'availability' => $availability,
        ];

        return view('frontend.freelance.onboarding.step7', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 7 (Disponibilité)
     */
    public function step7Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Déterminer le fuseau horaire à utiliser
        $timezoneToUse = null;
        if ($request->timezone_confirmed == '1') {
            // Si "Oui" est sélectionné, utiliser le fuseau horaire détecté (par défaut)
            $timezoneToUse = old('timezone', $freelancerProfile->timezone ?? $user->timezone ?? 'Europe/Paris');
        } else {
            // Si "Non" est sélectionné, utiliser celui choisi dans le dropdown
            $timezoneToUse = $request->timezone;
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'timezone' => $request->timezone_confirmed == '0' ? 'required|string|max:64' : 'nullable|string|max:64',
            'timezone_confirmed' => 'required|in:0,1',
            'availability' => 'required|array',
            'availability.*.enabled' => 'sometimes|boolean',
            'availability.*.slots' => 'required_if:availability.*.enabled,1|array|min:1',
            'availability.*.slots.*.from' => 'required_with:availability.*.slots|date_format:H:i',
            'availability.*.slots.*.to' => 'required_with:availability.*.slots|date_format:H:i|after:availability.*.slots.*.from',
        ], [
            'timezone.required' => __('Le fuseau horaire est obligatoire.'),
            'availability.required' => __('Veuillez définir au moins un jour de disponibilité.'),
            'availability.*.slots.required_if' => __('Veuillez définir au moins un créneau horaire pour les jours sélectionnés.'),
            'availability.*.slots.*.from.required_with' => __('L\'heure de début est obligatoire.'),
            'availability.*.slots.*.to.required_with' => __('L\'heure de fin est obligatoire.'),
            'availability.*.slots.*.to.after' => __('L\'heure de fin doit être postérieure à l\'heure de début.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Nettoyer les données de disponibilité (ne garder que les jours activés)
        $availability = [];
        foreach ($request->availability as $dayKey => $dayData) {
            if (isset($dayData['enabled']) && $dayData['enabled'] == '1') {
                $slots = [];
                if (isset($dayData['slots']) && is_array($dayData['slots'])) {
                    foreach ($dayData['slots'] as $slot) {
                        if (isset($slot['from']) && isset($slot['to']) && $slot['from'] < $slot['to']) {
                            $slots[] = [
                                'from' => $slot['from'],
                                'to' => $slot['to'],
                            ];
                        }
                    }
                }
                if (!empty($slots)) {
                    $availability[$dayKey] = [
                        'enabled' => true,
                        'slots' => $slots,
                    ];
                }
            }
        }

        // Vérifier qu'au moins un jour est défini
        if (empty($availability)) {
            return redirect()->back()
                ->withErrors(['availability' => __('Veuillez définir au moins un jour de disponibilité avec des créneaux horaires valides.')])
                ->withInput();
        }

        // Sauvegarder le fuseau horaire dans le profil freelance
        $freelancerProfile->timezone = $timezoneToUse;
        $freelancerProfile->save();

        // Sauvegarder la disponibilité dans l'utilisateur
        $user->timezone = $timezoneToUse;
        $user->availability = $availability;
        $user->save();

        // Rediriger vers l'étape 8 (Tarif)
        return redirect()->route('freelance.onboarding.step8')
            ->with('success', __('Disponibilités enregistrées avec succès.'));
    }

    /**
     * Étape 8 : Tarif
     */
    public function step8(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        // Récupérer le tarif, la banque et les données KYC existantes
        $hourlyRate = old('hourly_rate', $freelancerProfile->hourly_rate ?? 0);
        $bankIban = old('bank_iban', $freelancerProfile->bank_iban ?? '');
        $bankAccountHolder = old('bank_account_holder', $freelancerProfile->bank_account_holder ?? '');
        $identityDocuments = $this->extractIdentityDocuments($freelancerProfile->identity_document);

        // Formater l'IBAN pour l'affichage (ajouter des espaces tous les 4 caractères)
        if (!empty($bankIban)) {
            $bankIbanFormatted = '';
            $bankIbanClean = str_replace(' ', '', $bankIban);
            for ($i = 0; $i < strlen($bankIbanClean); $i++) {
                if ($i > 0 && $i % 4 === 0) {
                    $bankIbanFormatted .= ' ';
                }
                $bankIbanFormatted .= $bankIbanClean[$i];
            }
            $bankIban = $bankIbanFormatted;
        }

        $data = [
            'hourly_rate' => $hourlyRate,
            'bank_iban' => $bankIban,
            'bank_account_holder' => $bankAccountHolder,
            'birth_country' => old('birth_country', $user->country_code ?? ''),
            'address' => old('address', $user->address ?? ''),
            'postal_code' => old('postal_code', $user->postal_code ?? '10001'),
            'age_confirmation' => old('age_confirmation', false),
            'identity_document_front' => $identityDocuments['front'],
            'identity_document_back' => $identityDocuments['back'],
            'identity_document_front_name' => $identityDocuments['front'] ? basename($identityDocuments['front']) : null,
            'identity_document_back_name' => $identityDocuments['back'] ? basename($identityDocuments['back']) : null,
        ];

        return view('frontend.freelance.onboarding.step8', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'data' => $data,
        ]);
    }

    /**
     * Sauvegarder l'étape 8 (Tarif) et terminer l'inscription
     */
    public function step8Store(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Veuillez d\'abord compléter l\'étape 1.'));
        }

        $identityDocuments = $this->extractIdentityDocuments($freelancerProfile->identity_document);
        $hasFrontDocument = !empty($identityDocuments['front']);
        $hasBackDocument = !empty($identityDocuments['back']);

        // Nettoyer l'IBAN avant validation (retirer les espaces)
        $ibanClean = strtoupper(str_replace(' ', '', $request->bank_iban ?? ''));
        
        // Validation
        $validator = Validator::make([
            'hourly_rate' => $request->hourly_rate,
            'bank_iban' => $ibanClean,
            'bank_account_holder' => $request->bank_account_holder,
            'birth_country' => $request->birth_country,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'age_confirmation' => $request->age_confirmation,
            'identity_document_front' => $request->file('identity_document_front'),
            'identity_document_back' => $request->file('identity_document_back'),
        ], [
            'hourly_rate' => 'required|numeric|min:5|max:1000',
            'bank_iban' => 'required|string|regex:/^[A-Z]{2}[0-9]{2}[A-Z0-9]{10,30}$/',
            'bank_account_holder' => 'required|string|max:255|min:2',
            'birth_country' => 'required|string|max:3',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'age_confirmation' => 'required|accepted',
            'identity_document_front' => ($hasFrontDocument ? 'nullable' : 'required') . '|file|mimes:jpeg,jpg,png,pdf|max:5120',
            'identity_document_back' => ($hasBackDocument ? 'nullable' : 'required') . '|file|mimes:jpeg,jpg,png,pdf|max:5120',
        ], [
            'hourly_rate.required' => __('Le tarif est obligatoire.'),
            'hourly_rate.numeric' => __('Le tarif doit être un nombre.'),
            'hourly_rate.min' => __('Le tarif minimum est de 5€ par Rituel.'),
            'hourly_rate.max' => __('Le tarif maximum est de 1000€ par Rituel.'),
            'bank_iban.required' => __('L\'IBAN est obligatoire.'),
            'bank_iban.regex' => __('L\'IBAN doit être au format valide (ex: FR76 1234 5678 9012 3456 7890 123).'),
            'bank_account_holder.required' => __('Le nom du titulaire du compte est obligatoire.'),
            'bank_account_holder.min' => __('Le nom du titulaire doit contenir au moins 2 caractères.'),
            'birth_country.required' => __('Le pays de naissance est obligatoire.'),
            'address.required' => __('L\'adresse est obligatoire.'),
            'postal_code.required' => __('Le code postal est obligatoire.'),
            'age_confirmation.required' => __('Vous devez confirmer avoir plus de 18 ans.'),
            'age_confirmation.accepted' => __('Vous devez confirmer avoir plus de 18 ans.'),
            'identity_document_front.required' => __('Le recto de la pièce d\'identité est obligatoire.'),
            'identity_document_back.required' => __('Le verso de la pièce d\'identité est obligatoire.'),
            'identity_document_front.file' => __('Le fichier du recto est invalide.'),
            'identity_document_back.file' => __('Le fichier du verso est invalide.'),
            'identity_document_front.mimes' => __('Le recto doit être au format JPEG, JPG, PNG ou PDF.'),
            'identity_document_back.mimes' => __('Le verso doit être au format JPEG, JPG, PNG ou PDF.'),
            'identity_document_front.max' => __('Le recto ne doit pas dépasser 5 Mo.'),
            'identity_document_back.max' => __('Le verso ne doit pas dépasser 5 Mo.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('identity_document_front')) {
            if (!empty($identityDocuments['front']) && Storage::disk('public')->exists($identityDocuments['front'])) {
                Storage::disk('public')->delete($identityDocuments['front']);
            }
            $frontFile = $request->file('identity_document_front');
            $frontFilename = 'identity_front_' . $user->id . '_' . time() . '.' . $frontFile->getClientOriginalExtension();
            $identityDocuments['front'] = $frontFile->storeAs('identity_documents', $frontFilename, 'public');
        }

        if ($request->hasFile('identity_document_back')) {
            if (!empty($identityDocuments['back']) && Storage::disk('public')->exists($identityDocuments['back'])) {
                Storage::disk('public')->delete($identityDocuments['back']);
            }
            $backFile = $request->file('identity_document_back');
            $backFilename = 'identity_back_' . $user->id . '_' . time() . '.' . $backFile->getClientOriginalExtension();
            $identityDocuments['back'] = $backFile->storeAs('identity_documents', $backFilename, 'public');
        }

        // Sauvegarder le tarif et les coordonnées bancaires
        $freelancerProfile->hourly_rate = $request->hourly_rate;
        $freelancerProfile->bank_iban = $ibanClean; // Utiliser l'IBAN déjà nettoyé
        $freelancerProfile->bank_account_holder = $request->bank_account_holder;
        if (!empty($identityDocuments['front']) || !empty($identityDocuments['back'])) {
            $freelancerProfile->identity_document = json_encode([
                'front' => $identityDocuments['front'],
                'back' => $identityDocuments['back'],
            ], JSON_UNESCAPED_SLASHES);
        }
        $freelancerProfile->save();

        $user->country_code = $request->birth_country;
        $user->address = $request->address;
        $user->postal_code = $request->postal_code ?: '10001';

        // Marquer l'utilisateur comme freelance
        $user->is_freelancer = true;
        $user->save();

        // Rediriger vers une page de confirmation ou le dashboard
        return redirect()->route('freelance.onboarding.complete')
            ->with('success', __('Félicitations ! Votre profil freelance a été créé avec succès.'));
    }

    /**
     * Page de confirmation après l'inscription
     */
    public function complete()
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login');
        }

        return view('frontend.freelance.onboarding.complete', [
            'user' => $user,
        ]);
    }

    /**
     * Modifier l'email à la dernière étape
     */
    public function updateEmail(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')->with('error', __('Vous devez être connecté.'));
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|unique:users,email_address,' . $user->id . '|max:255',
        ], [
            'email.required' => __('L\'adresse e-mail est obligatoire.'),
            'email.email' => __('L\'adresse e-mail doit être valide.'),
            'email.unique' => __('Cette adresse e-mail est déjà utilisée.'),
            'email.max' => __('L\'adresse e-mail ne doit pas dépasser 255 caractères.'),
        ]);

        if ($validator->fails()) {
            return redirect()->route('freelance.onboarding.complete')
                ->withErrors($validator)
                ->withInput();
        }

        // Mettre à jour l'email
        $oldEmail = $user->email_address;
        $user->email_address = $request->email;
        $user->email_verified = 0; // Réinitialiser la vérification
        $user->verification_token = md5(Str::random(20) . $user->username . $user->email_address);
        $user->save();

        // Envoyer un nouvel email de vérification
        $websiteTitle = \App\Models\BasicSettings\Basic::query()->pluck('website_title')->first();
        $mailTemplate = \App\Models\MailTemplate::query()->where('mail_type', '=', 'verify_email')->first();
        
        if ($mailTemplate) {
            $mailData['subject'] = $mailTemplate->mail_subject;
            $mailBody = $mailTemplate->mail_body;

            $link = '<a href=' . url("user/signup-verify/" . $user->verification_token) . '>Click Here</a>';

            $mailBody = str_replace('{username}', $user->username, $mailBody);
            $mailBody = str_replace('{verification_link}', $link, $mailBody);
            $mailBody = str_replace('{website_title}', $websiteTitle, $mailBody);

            $mailData['body'] = $mailBody;
            $mailData['recipient'] = $request->email;

            \App\Helpers\BasicMailer::sendMail($mailData);
        }

        return redirect()->route('freelance.onboarding.complete')
            ->with('success', __('Votre adresse e-mail a été modifiée avec succès. Un nouvel email de vérification a été envoyé à votre nouvelle adresse.'));
    }
}
