<?php

namespace App\Services\Junspro;

use App\Models\FormationEnrollment;
use App\Models\FormationModule;
use App\Models\FormationModuleProgress;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormationService
{
    // ─── Catalogue des 49 modules (Parcours 39 + Praticien 10) ────────────────────
    public const MODULES_SEED = [
        // ── PARCOURS 1 — Se Retrouver (10 modules) → Certification Niveau 1 · Éveil ──────────
        ['slug' => '01-je-me-rencontre',               'title' => 'Je me rencontre',                                               'week_label' => 'Module 01', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 1,  'part' => 1],
        ['slug' => '02-je-reconnais-mes-blessures',    'title' => 'Je reconnais mes blessures',                                   'week_label' => 'Module 02', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 2,  'part' => 1],
        ['slug' => '03-j-accepte-mes-limites',         'title' => 'J\'accepte ce que je ne peux pas changer — lâcher-prise & ACT','week_label' => 'Module 03', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 3,  'part' => 1],
        ['slug' => '04-je-reconnais-ce-qui-me-draine', 'title' => 'Je reconnais ce qui me draine — audit énergétique',            'week_label' => 'Module 04', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 4,  'part' => 1],
        ['slug' => '03-je-decris-mon-bonheur',         'title' => 'Je décris mon bonheur',                                        'week_label' => 'Module 05', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 5,  'part' => 1],
        ['slug' => '04-j-ecoute-mon-souffle',          'title' => 'J\'écoute mon souffle intérieur',                              'week_label' => 'Module 06', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 6,  'part' => 1],
        ['slug' => '05-je-decouvre-ma-mission',        'title' => 'Je découvre ma mission unique',                                'week_label' => 'Module 07', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 7,  'part' => 1],
        ['slug' => '06-je-visualise-ma-vie',           'title' => 'J\'incarne ma Vision — Clarté, Courage & Discipline',          'week_label' => 'Module 08', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 8,  'part' => 1],
        ['slug' => '07-je-prends-soin-de-moi',         'title' => 'Je prends soin de moi en premier — le masque à oxygène',      'week_label' => 'Module 09', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 9,  'part' => 1],
        ['slug' => '08-gratitude-et-intention',        'title' => 'La gratitude & l\'intention — bilan du soir, élan du matin',  'week_label' => 'Module 10', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 10, 'part' => 1],
        // ── PARCOURS 2 — Se Construire (13 modules) → Certification Niveau 2 · Ancrage ───────
        ['slug' => '09-mes-priorites-dabord',          'title' => 'Définir mes priorités — réalise tes rêves ou tu réaliseras ceux des autres', 'week_label' => 'Module 11', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 11, 'part' => 2],
        ['slug' => '12-maitriser-son-temps',            'title' => 'Je maîtrise mon temps — Deep Work & architecture des journées', 'week_label' => 'Module 12', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 12, 'part' => 2],
        ['slug' => '13-gerer-ses-finances',             'title' => 'Je gère mes finances — la sécurité qui libère',                'week_label' => 'Module 13', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 13, 'part' => 2],
        ['slug' => '10-interieur-propre-et-range',     'title' => 'Un intérieur propre et rangé — la discipline qui commence chez soi', 'week_label' => 'Module 14', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 14, 'part' => 2],
        ['slug' => '07-mouvement-et-posture',          'title' => 'Je bouge avec conscience',                                    'week_label' => 'Module 15', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 15, 'part' => 2],
        ['slug' => '08-systeme-nerveux',               'title' => 'Je comprends mon système nerveux',                            'week_label' => 'Module 16', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 16, 'part' => 2],
        ['slug' => '09-gestion-des-emotions',          'title' => 'Je régule mes émotions',                                      'week_label' => 'Module 17', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 17, 'part' => 2],
        ['slug' => '10-vivre-ici-et-maintenant',       'title' => 'Je vis ici et maintenant',                                    'week_label' => 'Module 18', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 18, 'part' => 2],
        ['slug' => '10-sommeil-et-recuperation',       'title' => 'Je dors et je récupère',                                      'week_label' => 'Module 19', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 19, 'part' => 2],
        ['slug' => '11-relation-alimentation',         'title' => 'Je mange en conscience',                                      'week_label' => 'Module 20', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 20, 'part' => 2],
        ['slug' => '15-activite-physique',             'title' => 'Je pratique — activité physique & bien-être',                 'week_label' => 'Module 21', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 21, 'part' => 2],
        ['slug' => '22-nutrition-et-vitalite',         'title' => 'Nutrition & Vitalité — nourrir le corps intelligemment',      'week_label' => 'Module 22', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 22, 'part' => 2],
        ['slug' => '19-medecines-complementaires',     'title' => 'Choisir avec discernement — médecines & santé',               'week_label' => 'Module 23', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 23, 'part' => 2],
        // ── PARCOURS 3 — S'Ouvrir (16 modules) → Certification Niveau 3 · Maître ─────────────
        ['slug' => '12-presence-a-soi',                'title' => 'Je suis présent(e) à moi',                                    'week_label' => 'Module 24', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 24, 'part' => 3],
        ['slug' => '13-confiance-corporelle',          'title' => 'Je m\'accepte — confiance & image de soi',                    'week_label' => 'Module 25', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 25, 'part' => 3],
        ['slug' => '14-interactions-sociales',         'title' => 'Je crée du lien — interactions sociales',                     'week_label' => 'Module 26', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 26, 'part' => 3],
        // Avant de s'ouvrir aux autres, apprendre à être seul(e) avec soi
        ['slug' => '27-solitude-choisie',              'title' => 'Apprivoiser la solitude choisie — présence sans fuite',        'week_label' => 'Module 27', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 27, 'part' => 3],
        ['slug' => '16-loisirs-et-vie',                'title' => 'Je vis pleinement — loisirs, sorties & voyages',              'week_label' => 'Module 28', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 28, 'part' => 3],
        // M32 : les écrans volent la plénitude et la capacité de créer du lien réel
        ['slug' => '32-pieges-ecrans',                 'title' => 'Le Piège des Écrans — attention, solitude & présence retrouvée', 'week_label' => 'Module 29', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 29, 'part' => 3],
        ['slug' => '17-relation-a-lautre',             'title' => 'Je communique — relation à l\'autre',                         'week_label' => 'Module 30', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 30, 'part' => 3],
        ['slug' => '18-intimite-et-energie',           'title' => 'Énergie relationnelle & intimité',                            'week_label' => 'Module 31', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 31, 'part' => 3],
        ['slug' => '20-vivre-choisir-reconstruire',    'title' => 'Vivre, choisir, se reconstruire',                             'week_label' => 'Module 32', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 32, 'part' => 3],
        // M31 : après reconstruction, approfondissement culturel
        ['slug' => '31-amour-ere-jetable',             'title' => 'L\'Amour à l\'ère du jetable — famille, engagement & lucidité', 'week_label' => 'Module 33', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 33, 'part' => 3],
        // M33 : conséquence — ce que le délitement du couple fait à l'enfant et à la famille
        ['slug' => '33-education-sacrifiee',           'title' => 'L\'Enfant abandonné — éducation, famille & transmission retrouvée', 'week_label' => 'Module 34', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 34, 'part' => 3],
        ['slug' => '21-entretenir-nos-relations',      'title' => 'Entretenir nos relations — la durée du lien',                 'week_label' => 'Module 35', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 35, 'part' => 3],
        // Avant la transmission : donner un sens à l'existence
        ['slug' => '36-sens-de-la-vie',                'title' => 'Le sens de ma vie — Frankl, ikigai & la question qui libère', 'week_label' => 'Module 36', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 36, 'part' => 3],
        ['slug' => '11-je-transmets-ma-transformation','title' => 'Je transmets ma transformation — Rayonnement personnel',     'week_label' => 'Module 37', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 37, 'part' => 3],
        ['slug' => '29-synthese-du-parcours',          'title' => 'Je synthétise mon Parcours — bilan de transformation',        'week_label' => 'Module 38', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 38, 'part' => 3],
        ['slug' => '30-mon-programme-quotidien',       'title' => 'Mon Programme Quotidien — rituel vivant & personnalisable',  'week_label' => 'Module 39', 'track' => FormationModule::TRACK_PARCOURS, 'order' => 39, 'part' => 3],
        // ── LA FORMATION PRATICIEN (10 modules — restructurée Option B) ─────────────────────────
        // 00 : Anatomie (inchangé)
        // 01 : Condensé Soi+Blessures+Bonheur (ex-modules 01-03)
        // 02 : Condensé Souffle+Mission+Vision initiation (ex-modules 04-06)
        // 07-09 : Vision maîtrise · Discipline · Rituel (inchangés)
        // 10-13 : 4 modules professionnels exclusifs (nouveaux)
        ['slug' => '00-comprendre-le-corps',                       'title' => 'Comprendre le Corps — Anatomie & Physiologie',                          'week_label' => 'Module 00', 'track' => FormationModule::TRACK_PRATICIEN, 'order' => 0],
        ['slug' => '01-je-me-connais-pour-accompagner',            'title' => 'Je me connais pour accompagner — Soi, Blessures & Bonheur',            'week_label' => 'Module 01', 'track' => FormationModule::TRACK_PRATICIEN, 'order' => 1],
        ['slug' => '02-je-maitrise-les-outils-du-souffle',         'title' => 'Je maîtrise les outils du souffle — Respiration, Mission & Vision',    'week_label' => 'Module 02', 'track' => FormationModule::TRACK_PRATICIEN, 'order' => 2],
        ['slug' => '07-je-maitrise-la-vision',                     'title' => 'Je maîtrise la Vision — Pratique Avancée & Transmission',              'week_label' => 'Module 07', 'track' => FormationModule::TRACK_PRATICIEN, 'order' => 3],
        ['slug' => '08-je-renforce-ma-discipline',                 'title' => 'Je renforce ma Discipline — le Pouvoir du Quotidien',                  'week_label' => 'Module 08', 'track' => FormationModule::TRACK_PRATICIEN, 'order' => 4],
        ['slug' => '09-je-transmets-le-rituel',                    'title' => 'Je transmets le Rituel Pause Souffle',                                  'week_label' => 'Module 09', 'track' => FormationModule::TRACK_PRATICIEN, 'order' => 5],
        ['slug' => '10-la-posture-du-praticien',                   'title' => 'La Posture du Praticien — Présence, Voix & Burn-out',                  'week_label' => 'Module 10', 'track' => FormationModule::TRACK_PRATICIEN, 'order' => 6],
        ['slug' => '11-lire-un-client-adapter-le-protocole',       'title' => 'Lire un Client — Adapter le Protocole',                                'week_label' => 'Module 11', 'track' => FormationModule::TRACK_PRATICIEN, 'order' => 7],
        ['slug' => '12-construire-une-pratique-professionnelle',   'title' => 'Construire une Pratique Professionnelle',                               'week_label' => 'Module 12', 'track' => FormationModule::TRACK_PRATICIEN, 'order' => 8],
        ['slug' => '13-limites-contre-indications-responsabilite', 'title' => 'Limites, Contre-indications & Responsabilité',                         'week_label' => 'Module 13', 'track' => FormationModule::TRACK_PRATICIEN, 'order' => 9],
        // ── FORMATION MENTOR (9 modules) ────────────────────────────────────────────────────
        ['slug' => 'mentor-01-identite-du-mentor',       'title' => 'L\'Identité du Mentor',           'week_label' => 'Module 01', 'track' => FormationModule::TRACK_MENTOR, 'order' => 1],
        ['slug' => 'mentor-02-posture-du-serviteur',     'title' => 'La Posture du Serviteur',         'week_label' => 'Module 02', 'track' => FormationModule::TRACK_MENTOR, 'order' => 2],
        ['slug' => 'mentor-03-ecoute-active',            'title' => 'L\'Écoute Active',                'week_label' => 'Module 03', 'track' => FormationModule::TRACK_MENTOR, 'order' => 3],
        ['slug' => 'mentor-04-transmission-vivante',     'title' => 'La Transmission Vivante',         'week_label' => 'Module 04', 'track' => FormationModule::TRACK_MENTOR, 'order' => 4],
        ['slug' => 'mentor-05-les-resistances',          'title' => 'Les Résistances',                 'week_label' => 'Module 05', 'track' => FormationModule::TRACK_MENTOR, 'order' => 5],
        ['slug' => 'mentor-06-energie-du-mentor',        'title' => 'L\'Énergie du Mentor',            'week_label' => 'Module 06', 'track' => FormationModule::TRACK_MENTOR, 'order' => 6],
        ['slug' => 'mentor-07-cadre-sacre',              'title' => 'Le Cadre Sacré',                  'week_label' => 'Module 07', 'track' => FormationModule::TRACK_MENTOR, 'order' => 7],
        ['slug' => 'mentor-08-art-du-lacher-prise',      'title' => 'L\'Art du Lâcher-Prise',          'week_label' => 'Module 08', 'track' => FormationModule::TRACK_MENTOR, 'order' => 8],
        ['slug' => 'mentor-09-signature-de-mentor',      'title' => 'Ma Signature de Mentor',          'week_label' => 'Module 09', 'track' => FormationModule::TRACK_MENTOR, 'order' => 9],
    ];

    // ──────────────────────────────────────────────────────────
    // INSCRIPTION
    // ──────────────────────────────────────────────────────────

    /**
     * Créer un enrollment après paiement confirmé (Stripe)
     */
    public function enroll(User $user, float $amountPaid, string $stripePaymentIntent): FormationEnrollment
    {
        return DB::transaction(function () use ($user, $amountPaid, $stripePaymentIntent) {

            $existing = FormationEnrollment::where('user_id', $user->id)->first();
            if ($existing) {
                // Déjà inscrit : activer si pending
                if ($existing->status === 'pending') {
                    $existing->update([
                        'status'                 => 'active',
                        'stripe_payment_intent'  => $stripePaymentIntent,
                        'amount_paid'            => $amountPaid,
                        'enrolled_at'            => now(),
                    ]);
                }
                $this->initModuleProgress($existing);
                return $existing->fresh();
            }

            $enrollment = FormationEnrollment::create([
                'user_id'               => $user->id,
                'status'                => 'active',
                'stripe_payment_intent' => $stripePaymentIntent,
                'amount_paid'           => $amountPaid,
                'enrolled_at'           => now(),
            ]);

            $this->initModuleProgress($enrollment);

            Log::info('[FormationService] Nouvel enrollment', ['user_id' => $user->id, 'amount' => $amountPaid]);

            return $enrollment;
        });
    }

    /**
     * Créer un enrollment "pending" sans paiement (inscription gratuite/test)
     */
    public function enrollFree(User $user): FormationEnrollment
    {
        $existing = FormationEnrollment::where('user_id', $user->id)->first();
        if ($existing) return $existing;

        $enrollment = FormationEnrollment::create([
            'user_id'    => $user->id,
            'status'     => 'pending',
            'amount_paid'=> 0,
        ]);

        $this->initModuleProgress($enrollment);
        return $enrollment;
    }

    // ──────────────────────────────────────────────────────────
    // PROGRESSION
    // ──────────────────────────────────────────────────────────

    /**
     * Marquer un module comme démarré
     */
    public function startModule(FormationEnrollment $enrollment, int $moduleId): FormationModuleProgress
    {
        $this->syncModuleProgress($enrollment);

        $progress = FormationModuleProgress::where('enrollment_id', $enrollment->id)
            ->where('module_id', $moduleId)
            ->first();

        if (!$progress || $progress->status === 'locked') {
            abort(403, 'Module non disponible.');
        }

        $progress->markStarted();
        return $progress->fresh();
    }

    /**
     * Marquer un module comme complété et débloquer le suivant
     */
    public function completeModule(FormationEnrollment $enrollment, int $moduleId, array $activityChecks = []): FormationModuleProgress
    {
        $this->syncModuleProgress($enrollment);

        $progress = FormationModuleProgress::where('enrollment_id', $enrollment->id)
            ->where('module_id', $moduleId)
            ->firstOrFail();

        DB::transaction(function () use ($progress, $activityChecks, $enrollment) {

            $progress->update([
                'status'           => 'completed',
                'completion_pct'   => 100,
                'completed_at'     => now(),
                'activity_checks'  => $activityChecks,
            ]);

            // Débloquer le module suivant
            $currentModule = $progress->module;
            $nextModule = FormationModule::where('track', $currentModule->track)
                ->where('order', '>', $currentModule->order)
                ->where('is_active', true)
                ->orderBy('order')
                ->first();

            if ($nextModule) {
                FormationModuleProgress::where('enrollment_id', $enrollment->id)
                    ->where('module_id', $nextModule->id)
                    ->update(['status' => 'available']);
            }

            // Vérifier si tous les modules de la Part 1 (ordres 1-9) sont complétés → Certification Niveau 1
            $part1ModuleIds = FormationModule::active()
                ->forTrack(FormationModule::TRACK_PARCOURS)
                ->where('part', 1)
                ->pluck('id');

            if ($part1ModuleIds->isNotEmpty()) {
                $donePart1 = FormationModuleProgress::where('enrollment_id', $enrollment->id)
                    ->whereIn('module_id', $part1ModuleIds)
                    ->where('status', 'completed')
                    ->count();

                if ($donePart1 >= $part1ModuleIds->count() && !$enrollment->isLevel1Certified()) {
                    $enrollment->issueLevel1Attestation();
                    Log::info('[FormationService] Certification Niveau 1 émise', ['enrollment_id' => $enrollment->id]);
                }
            }

            // Vérifier si tous les modules de la Part 2 sont complétés → Certification Niveau 2 · Ancrage
            $part2ModuleIds = FormationModule::active()
                ->forTrack(FormationModule::TRACK_PARCOURS)
                ->where('part', 2)
                ->pluck('id');

            if ($part2ModuleIds->isNotEmpty()) {
                $donePart2 = FormationModuleProgress::where('enrollment_id', $enrollment->id)
                    ->whereIn('module_id', $part2ModuleIds)
                    ->where('status', 'completed')
                    ->count();

                if ($donePart2 >= $part2ModuleIds->count() && !$enrollment->isLevel2Certified()) {
                    $enrollment->issueLevel2Attestation();
                    Log::info('[FormationService] Certification Niveau 2 émise', ['enrollment_id' => $enrollment->id]);
                }
            }

            // Vérifier si tous les modules de la Part 3 sont complétés → Certification Niveau 3 · Maître
            $part3ModuleIds = FormationModule::active()
                ->forTrack(FormationModule::TRACK_PARCOURS)
                ->where('part', 3)
                ->pluck('id');

            if ($part3ModuleIds->isNotEmpty()) {
                $donePart3 = FormationModuleProgress::where('enrollment_id', $enrollment->id)
                    ->whereIn('module_id', $part3ModuleIds)
                    ->where('status', 'completed')
                    ->count();

                if ($donePart3 >= $part3ModuleIds->count() && !$enrollment->isLevel3Certified()) {
                    $enrollment->issueLevel3Attestation();
                    Log::info('[FormationService] Certification Niveau 3 émise', ['enrollment_id' => $enrollment->id]);
                }
            }

            // Vérifier si tous les modules PRATICIEN sont complétés → attestation praticien (rétrocompatibilité)
            $praticienModuleIds = FormationModule::active()
                ->forTrack(FormationModule::TRACK_PRATICIEN)
                ->pluck('id');

            $totalModules  = $praticienModuleIds->count();
            $doneModules   = FormationModuleProgress::where('enrollment_id', $enrollment->id)
                ->whereIn('module_id', $praticienModuleIds)
                ->where('status', 'completed')
                ->count();

            if ($totalModules > 0 && $doneModules >= $totalModules) {
                $enrollment->issueAttestation();
                Log::info('[FormationService] Attestation émise', ['enrollment_id' => $enrollment->id]);
            }
        });

        return $progress->fresh();
    }

    /**
     * Récupérer la progression d'un module spécifique pour un enrollment
     */
    public function getModuleProgress(FormationEnrollment $enrollment, int $moduleId): ?FormationModuleProgress
    {
        $this->syncModuleProgress($enrollment);

        return FormationModuleProgress::where('enrollment_id', $enrollment->id)
            ->where('module_id', $moduleId)
            ->first();
    }

    /**
     * Récupérer les stats du tableau de bord praticien
     */
    public function getDashboardData(FormationEnrollment $enrollment, string $track): array
    {
        $this->syncModuleProgress($enrollment);

        $modules  = FormationModule::active()->forTrack($track)->get();
        $allProgress = FormationModuleProgress::where('enrollment_id', $enrollment->id)
            ->with('module')
            ->get()
            ->keyBy('module_id');

        $modulesWithStatus = $modules->map(function (FormationModule $module) use ($allProgress) {
            $prog = $allProgress->get($module->id);
            return [
                'module'         => $module,
                'status'         => $prog?->status ?? 'locked',
                'completion_pct' => $prog?->completion_pct ?? 0,
                'started_at'     => $prog?->started_at,
                'completed_at'   => $prog?->completed_at,
                'activity_checks'=> $prog?->activity_checks ?? [],
            ];
        });

        $totalModules = $modules->count();
        $completedModules = $modules->filter(function (FormationModule $module) use ($allProgress) {
            return ($allProgress->get($module->id)?->status ?? 'locked') === 'completed';
        })->count();

        return [
            'enrollment'               => $enrollment,
            'modules'                  => $modulesWithStatus,
            'global_progress'          => $totalModules > 0 ? (int) round($completedModules / $totalModules * 100) : 0,
            'is_certified'             => $track === FormationModule::TRACK_PRATICIEN && $enrollment->isCertified(),
            'attestation_code'         => $enrollment->attestation_code,
            'track'                    => $track,
            // Certification Parcours niveaux 1, 2 & 3
            'is_certified_level_1'     => $track === FormationModule::TRACK_PARCOURS && $enrollment->isLevel1Certified(),
            'is_certified_level_2'     => $track === FormationModule::TRACK_PARCOURS && $enrollment->isLevel2Certified(),
            'is_certified_level_3'     => $track === FormationModule::TRACK_PARCOURS && $enrollment->isLevel3Certified(),
            'attestation_code_lvl1'    => $enrollment->attestation_code_lvl1,
            'attestation_code_lvl2'    => $enrollment->attestation_code_lvl2,
            'attestation_code_lvl3'    => $enrollment->attestation_code_lvl3,
            'certification_level'      => $enrollment->certification_level,
        ];
    }

    // ──────────────────────────────────────────────────────────
    // PRIVÉ
    // ──────────────────────────────────────────────────────────

    /**
     * Synchroniser les rows de progression pour chaque track.
     */
    private function initModuleProgress(FormationEnrollment $enrollment): void
    {
        $this->syncModuleProgress($enrollment);
    }

    private function syncModuleProgress(FormationEnrollment $enrollment): void
    {
        foreach ([FormationModule::TRACK_PARCOURS, FormationModule::TRACK_PRATICIEN, FormationModule::TRACK_MENTOR] as $track) {
            $modules = FormationModule::active()->forTrack($track)->get();

            if ($modules->isEmpty()) {
                continue;
            }

            $existingProgress = FormationModuleProgress::where('enrollment_id', $enrollment->id)
                ->whereIn('module_id', $modules->pluck('id'))
                ->pluck('status', 'module_id');

            $hasTrackProgress = $existingProgress->isNotEmpty();

            foreach ($modules as $index => $module) {
                FormationModuleProgress::firstOrCreate(
                    ['enrollment_id' => $enrollment->id, 'module_id' => $module->id],
                    ['status' => !$hasTrackProgress && $index === 0 ? 'available' : 'locked']
                );
            }
        }
    }
}
