<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Models\FormationActivityProgress;
use App\Models\FormationEnrollment;
use App\Models\FormationModule;
use App\Models\PsAmbassadeur;
use App\Mail\FormationAttestationIssued;
use App\Services\Junspro\FormationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FormationController extends Controller
{
    private const TRACK_PARCOURS = FormationModule::TRACK_PARCOURS;
    private const TRACK_PRATICIEN = FormationModule::TRACK_PRATICIEN;

    protected $miscController;
    protected $formationService;

    public function __construct(
        MiscellaneousController $miscController,
        FormationService $formationService
    ) {
        $this->miscController = $miscController;
        $this->formationService = $formationService;
    }

    /**
     * Tableau de bord de l'espace formation
     * Route : GET /mon-espace/formation
     */
    public function dashboard()
    {
        return redirect()->route('formation.dashboard');
    }

    public function dashboardParcours()
    {
        return $this->renderDashboard(self::TRACK_PARCOURS);
    }

    public function dashboardPraticien()
    {
        return $this->renderDashboard(self::TRACK_PRATICIEN);
    }

    /**
     * Page intermédiaire d'upgrade vers le Parcours 2 "S'Ouvrir"
     * Route : GET /mon-espace/parcours/upgrade
     */
    public function parcoursUpgrade()
    {
        return redirect()->route('presence.parcours')
            ->with('info', 'Découvrez le Parcours 2 «&nbsp;S\'Ouvrir&nbsp;» pour obtenir votre Certification Niveau 2 · Praticien Maître.');
    }

    private function renderDashboard(string $track)
    {
        $user = Auth::user();
        $misc = $this->miscController;

        $enrollment = $this->getActiveEnrollment($user->id);

        if (!$enrollment) {
            return redirect()->route('presence.formation-praticien')
                ->with('info', 'Vous n\'êtes pas encore inscrit à la formation.');
        }

        $dashboardData = $this->formationService->getDashboardData($enrollment, $track);

        // Mode créateur : déverrouiller tous les modules dans le dashboard
        if ($this->isCreatorMode()) {
            $dashboardData['modules'] = $dashboardData['modules']->map(function ($item) {
                if ($item['status'] === 'locked') {
                    $item['status'] = 'available';
                }
                return $item;
            });
            $dashboardData['creator_mode'] = true;
        }

        return view('frontend.formation.dashboard', array_merge($dashboardData, [
            'spaceKey'    => $track,
            'dashboardRouteName' => $track === self::TRACK_PARCOURS ? 'parcours.dashboard' : 'formation.dashboard',
            'moduleRouteName'    => $track === self::TRACK_PARCOURS ? 'parcours.module.show' : 'formation.module.show',
            'moduleStartRouteName' => $track === self::TRACK_PARCOURS ? 'parcours.module.start' : 'formation.module.start',
            'attestationRouteName' => 'formation.attestation',
            'showPraticienExtras' => $track === self::TRACK_PRATICIEN,
            'showAttestationBanner' => true,
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $misc->getLanguage(),
        ]));
    }

    /**
     * Démarrer un module
     * Route : POST /mon-espace/formation/module/{moduleId}/start
     */
    public function startModule(Request $request, int $moduleId)
    {
        $user = Auth::user();

        $enrollment = $this->getActiveEnrollment($user->id);
        abort_unless($enrollment, 403);

        $this->formationService->startModule($enrollment, $moduleId);

        $module = \App\Models\FormationModule::findOrFail($moduleId);
        return redirect()->route($this->moduleShowRouteName($module->track), $module->slug)
            ->with('success', 'Module démarré. Bonne progression !');
    }

    /**
     * Marquer un module comme complété
     * Route : POST /mon-espace/formation/module/{moduleId}/complete
     */
    public function completeModule(Request $request, int $moduleId)
    {
        $user = Auth::user();

        $enrollment = $this->getActiveEnrollment($user->id);
        abort_unless($enrollment, 403);

        $module = FormationModule::findOrFail($moduleId);

        $activityChecks = $request->input('activity_checks', []);
        $this->formationService->completeModule($enrollment, $moduleId, $activityChecks);

        $enrollment->refresh();

        if ($enrollment->isCertified() && $enrollment->attestation_issued_at) {
            try {
                Mail::to($enrollment->user->email)->send(new FormationAttestationIssued($enrollment));
            } catch (\Throwable $e) {
                logger()->error('FormationAttestationIssued mail error: ' . $e->getMessage());
            }
        }

        $message = $enrollment->isCertified()
            ? 'Félicitations ! Vous avez complété la formation et reçu votre attestation Junspro.'
            : 'Module complété ! Le suivant est maintenant disponible.';

        return redirect()->route($this->dashboardRouteName($module->track))->with('success', $message);
    }

    /**
     * Page immersive d'un module
     * Route : GET /mon-espace/formation/module/{slug}
     */
    public function showModule(Request $request, string $slug)
    {
        $preferredTrack = $request->query('track') === self::TRACK_PARCOURS
            ? self::TRACK_PARCOURS
            : self::TRACK_PRATICIEN;

        $module = FormationModule::where('slug', $slug)
            ->where('track', $preferredTrack)
            ->first();

        if (!$module) {
            $module = FormationModule::where('slug', $slug)->firstOrFail();
        }

        return redirect()->route($this->moduleShowRouteName($module->track), $slug);
    }

    public function showParcoursModule(string $slug)
    {
        return $this->renderTrackModule(self::TRACK_PARCOURS, $slug);
    }

    public function showPraticienModule(string $slug)
    {
        return $this->renderTrackModule(self::TRACK_PRATICIEN, $slug);
    }

    private function renderTrackModule(string $track, string $slug)
    {
        $user = Auth::user();
        $misc = $this->miscController;

        $enrollment = $this->getActiveEnrollment($user->id);

        if (!$enrollment) {
            return redirect()->route('presence.formation-praticien')
                ->with('info', 'Vous n\'êtes pas encore inscrit à la formation.');
        }

        $module = FormationModule::where('slug', $slug)
            ->where('track', $track)
            ->firstOrFail();

        // Mode créateur : accès libre à tous les modules sans verrou
        $creatorMode = $this->isCreatorMode();

        // Vérifier que le module est accessible (pas locked) — sauf créateur
        $progress = $this->formationService->getModuleProgress($enrollment, $module->id);
        if (!$creatorMode && $progress?->status === 'locked') {
            return redirect()->route($this->dashboardRouteName($track))
                ->with('info', 'Ce module se débloque après avoir complété le précédent.');
        }

        // Pour le créateur : simuler un statut 'available' si le module est locked
        // (permet d'afficher le contenu sans erreur dans la vue)
        if ($creatorMode && $progress?->status === 'locked') {
            $progress = (object) array_merge(
                (array) $progress,
                ['status' => 'available', 'completion_pct' => 0]
            );
        }

        // Charger la progression des activités
        $activityProgress = FormationActivityProgress::where('enrollment_id', $enrollment->id)
            ->where('module_id', $module->id)
            ->get()
            ->keyBy('activity_index');

        // Sélection des activités selon la langue active
        $lang = $misc->getLanguage();
        $isEn = $lang->code === 'en';

        $activitiesFr = is_array($module->activities)
            ? $module->activities
            : json_decode($module->activities ?? '[]', true);

        $activitiesEn = is_array($module->activities_en)
            ? $module->activities_en
            : json_decode($module->activities_en ?? '[]', true);

        $activities = ($isEn && !empty($activitiesEn)) ? $activitiesEn : $activitiesFr;

        $moduleTitle       = ($isEn && !empty($module->title_en))       ? $module->title_en       : $module->title;
        $moduleDescription = ($isEn && !empty($module->description_en)) ? $module->description_en  : $module->description;

        $completedCount = $activityProgress->where('completed_at', '!=', null)->count();
        $totalCount     = count($activities);

        // Modules prev/next
        $allModules = FormationModule::where('track', $track)->orderBy('order')->get();
        $allSlugs   = $allModules->pluck('slug')->values();
        $currentIdx = $allSlugs->search($slug);
        $prevSlug   = $currentIdx > 0 ? $allSlugs[$currentIdx - 1] : null;
        $nextSlug   = $currentIdx < $allSlugs->count() - 1 ? $allSlugs[$currentIdx + 1] : null;

        // Statut du module
        $moduleStatus = $progress?->status ?? 'available';
        if ($creatorMode && $moduleStatus === 'locked') {
            $moduleStatus = 'available';
        }

        // Dernier module ? (pour section "Continuer le chemin")
        $isLastModule = $nextSlug === null;
        $psAmbassadeur = null;
        $isAlreadyAmbassadeur = false;
        if ($isLastModule) {
            $psAmbassadeur = PsAmbassadeur::where('user_id', $user->id)->first();
            $isAlreadyAmbassadeur = $psAmbassadeur && in_array($psAmbassadeur->status, ['active', 'pending']);
        }

        $spaceLabel = $isEn
            ? ($track === self::TRACK_PARCOURS ? 'Wellness Journey' : 'Practitioner Training')
            : ($track === self::TRACK_PARCOURS ? 'Espace Parcours Pause Souffle' : 'Espace Formation Pause Souffle');

        return view('frontend.formation.module', [
            'module'               => $module,
            'spaceKey'             => $track,
            'spaceLabel'           => $spaceLabel,
            'isEn'                 => $isEn,
            'moduleTitle'          => $moduleTitle,
            'moduleDescription'    => $moduleDescription,
            'dashboardRouteName'   => $this->dashboardRouteName($track),
            'moduleShowRouteName'  => $this->moduleShowRouteName($track),
            'activityCompleteRouteName' => $this->activityCompleteRouteName($track),
            'activityNotesRouteName' => $this->activityNotesRouteName($track),
            'moduleCompleteRouteName' => $this->moduleCompleteRouteName($track),
            'modulePdfRouteName'   => $this->modulePdfRouteName($track),
            'showEndOfParcoursSection' => $track === self::TRACK_PARCOURS && $nextSlug === null,
            'enrollment'           => $enrollment,
            'activityProgress'     => $activityProgress,
            'activities'           => $activities,
            'completedCount'       => $completedCount,
            'totalCount'           => $totalCount,
            'moduleStatus'         => $moduleStatus,
            'prevSlug'             => $prevSlug,
            'nextSlug'             => $nextSlug,
            'isLastModule'         => $isLastModule,
            'psAmbassadeur'        => $psAmbassadeur,
            'isAlreadyAmbassadeur' => $isAlreadyAmbassadeur,
            'creatorMode'          => $creatorMode,
            'breadcrumb'           => $misc->getBreadcrumb(),
            'language'             => $lang,
        ]);
    }

    /**
     * Valider / sauvegarder une activité
     * Route : POST /mon-espace/formation/module/{slug}/activity/{idx}
     */
    public function completeActivity(Request $request, string $slug, int $idx)
    {
        $user = Auth::user();

        $enrollment = $this->getActiveEnrollment($user->id);
        abort_unless($enrollment, 403);

        $track = $this->resolveTrackFromRoute($request);
        $module = FormationModule::where('slug', $slug)
            ->where('track', $track)
            ->firstOrFail();

        $notes = $request->input('notes', '');

        FormationActivityProgress::updateOrCreate(
            [
                'enrollment_id'  => $enrollment->id,
                'module_id'      => $module->id,
                'activity_index' => $idx,
            ],
            [
                'notes'        => $notes,
                'completed_at' => now(),
            ]
        );

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['ok' => true]);
        }

        return redirect()->route($this->moduleShowRouteName($track), $slug)
            ->with('success', 'Activité validée !');
    }

    /**
     * Sauvegarder les notes d'une activité (autosave, sans marquer terminé)
     * Route : POST /mon-espace/formation/module/{slug}/activity/{idx}/notes
     */
    public function saveActivityNotes(Request $request, string $slug, int $idx)
    {
        $user = Auth::user();

        $enrollment = $this->getActiveEnrollment($user->id);
        abort_unless($enrollment, 403);

        $track = $this->resolveTrackFromRoute($request);
        $module = FormationModule::where('slug', $slug)
            ->where('track', $track)
            ->firstOrFail();

        $existing = FormationActivityProgress::where([
            'enrollment_id'  => $enrollment->id,
            'module_id'      => $module->id,
            'activity_index' => $idx,
        ])->first();

        if ($existing) {
            $existing->update(['notes' => $request->input('notes', '')]);
        } else {
            FormationActivityProgress::create([
                'enrollment_id'  => $enrollment->id,
                'module_id'      => $module->id,
                'activity_index' => $idx,
                'notes'          => $request->input('notes', ''),
                'completed_at'   => null,
            ]);
        }

        return response()->json(['ok' => true]);
    }

    /**
     * Module d'intégration : Ma Pause Souffle
     * Route : GET /mon-espace/formation/ma-pause-souffle
     */
    public function showMaPauseSouffle()
    {
        $user = Auth::user();
        $misc = $this->miscController;

        $enrollment = $this->getActiveEnrollment($user->id);

        if (!$enrollment) {
            return redirect()->route('presence.formation-praticien')
                ->with('info', 'Vous devez être inscrit à la formation pour accéder à cette page.');
        }

        return view('frontend.formation.ma-pause-souffle', [
            'user'       => $user,
            'enrollment' => $enrollment,
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $misc->getLanguage(),
        ]);
    }

    /**
     * Programme de la séance visio (20%)
     * Route : GET /mon-espace/formation/visio-programme
     */
    public function showVisio()
    {
        $user = Auth::user();
        $misc = $this->miscController;

        $enrollment = $this->getActiveEnrollment($user->id);

        if (!$enrollment) {
            return redirect()->route('presence.formation-praticien')
                ->with('info', 'Vous devez être inscrit à la formation pour accéder à cette page.');
        }

        return view('frontend.formation.visio-programme', [
            'user'       => $user,
            'enrollment' => $enrollment,
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $misc->getLanguage(),
        ]);
    }

    /**
     * Page attestation
     * Route : GET /mon-espace/formation/attestation
     */
    public function showAttestation()
    {
        return redirect()->route('formation.attestation');
    }

    public function showPraticienAttestation()
    {
        $user = Auth::user();
        $misc = $this->miscController;

        $enrollment = $this->getActiveEnrollment($user->id);

        if (!$enrollment) {
            return redirect()->route('presence.formation-praticien')
                ->with('error', 'Vous devez être inscrit à la formation pour accéder à cette page.');
        }

        if (!$enrollment->isCertified()) {
            return redirect()->route('formation.dashboard')
                ->with('info', 'Votre attestation sera disponible une fois la partie praticien complétée.');
        }

        return view('frontend.formation.attestation', [
            'user'       => $user,
            'enrollment' => $enrollment,
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $misc->getLanguage(),
        ]);
    }

    /**
     * Télécharger le PDF premium d'un module
     * Route : GET /mon-espace/formation/module/{slug}/pdf
     */
    public function downloadPdf(Request $request, string $slug)
    {
        $user = Auth::user();

        $enrollment = $this->getActiveEnrollment($user->id);

        if (!$enrollment) {
            return redirect()->route('presence.formation-praticien');
        }

        $track = $this->resolveTrackFromRoute($request);
        $module = FormationModule::where('slug', $slug)
            ->where('track', $track)
            ->firstOrFail();
        $pdfLang = $request->query('lang') === 'en' ? 'en' : 'fr';

        $pdfModule = clone $module;

        if ($pdfLang === 'en') {
            $pdfModule->title = $module->title_en ?: $module->title;
            $pdfModule->description = $module->description_en ?: $module->description;
            $pdfModule->intro_text = $module->intro_text_en ?: $module->intro_text;
            $activities = is_array($module->activities_en)
                ? $module->activities_en
                : json_decode($module->activities_en ?? '[]', true);

            if (empty($activities)) {
                $activities = is_array($module->activities)
                    ? $module->activities
                    : json_decode($module->activities ?? '[]', true);
            }
        } else {
            $activities = is_array($module->activities)
                ? $module->activities
                : json_decode($module->activities ?? '[]', true);
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('frontend.formation.pdf-module', [
            'module'     => $pdfModule,
            'activities' => $activities,
            'user'       => $user,
            'pdfLang'    => $pdfLang,
        ])->setPaper('a4', 'portrait');

        $filename = 'pause-souffle-' . $slug . '-' . $pdfLang . '.pdf';

        return response($pdf->output(), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Cache-Control'       => 'no-store, no-cache, must-revalidate',
            'Pragma'              => 'no-cache',
            'Expires'             => '0',
        ]);
    }

    private function getActiveEnrollment(int $userId): ?FormationEnrollment
    {
        return FormationEnrollment::where('user_id', $userId)
            ->whereIn('status', ['active', 'completed'])
            ->first();
    }

    private function dashboardRouteName(string $track): string
    {
        return $track === self::TRACK_PARCOURS ? 'parcours.dashboard' : 'formation.dashboard';
    }

    private function moduleShowRouteName(string $track): string
    {
        return $track === self::TRACK_PARCOURS ? 'parcours.module.show' : 'formation.module.show';
    }

    private function activityCompleteRouteName(string $track): string
    {
        return $track === self::TRACK_PARCOURS ? 'parcours.activity.complete' : 'formation.activity.complete';
    }

    private function activityNotesRouteName(string $track): string
    {
        return $track === self::TRACK_PARCOURS ? 'parcours.activity.notes' : 'formation.activity.notes';
    }

    private function moduleCompleteRouteName(string $track): string
    {
        return $track === self::TRACK_PARCOURS ? 'parcours.module.complete' : 'formation.module.complete';
    }

    private function modulePdfRouteName(string $track): string
    {
        return $track === self::TRACK_PARCOURS ? 'parcours.module.pdf' : 'formation.module.pdf';
    }

    private function resolveTrackFromRoute(Request $request): string
    {
        $routeName = (string) optional($request->route())->getName();

        return str_starts_with($routeName, 'parcours.')
            ? self::TRACK_PARCOURS
            : self::TRACK_PRATICIEN;
    }

    /**
     * Retourne true si l'utilisateur connecté est le créateur de la plateforme.
     * Il voit TOUS les modules déverrouillés sans avoir à progresser.
     * Configurer via CREATOR_USER_ID dans le fichier .env
     */
    private function isCreatorMode(): bool
    {
        $creatorId = (int) config('app.creator_user_id', 0);
        return $creatorId > 0 && (int) Auth::id() === $creatorId;
    }
}
