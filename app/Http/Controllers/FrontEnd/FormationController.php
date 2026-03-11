<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Models\FormationActivityProgress;
use App\Models\FormationEnrollment;
use App\Models\FormationModule;
use App\Mail\FormationAttestationIssued;
use App\Services\Junspro\FormationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FormationController extends Controller
{
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
     * Tableau de bord de l'espace praticien
     * Route : GET /mon-espace/formation
     */
    public function dashboard()
    {
        $user = Auth::user();
        $misc = $this->miscController;

        $enrollment = FormationEnrollment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->first();

        if (!$enrollment) {
            return redirect()->route('presence.formation-praticien')
                ->with('info', 'Vous n\'êtes pas encore inscrit à la formation.');
        }

        $dashboardData = $this->formationService->getDashboardData($enrollment);

        return view('frontend.formation.dashboard', array_merge($dashboardData, [
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

        $enrollment = FormationEnrollment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->firstOrFail();

        $this->formationService->startModule($enrollment, $moduleId);

        $module = \App\Models\FormationModule::findOrFail($moduleId);
        return redirect()->route('formation.module.show', $module->slug)
            ->with('success', 'Module démarré. Bonne progression !');
    }

    /**
     * Marquer un module comme complété
     * Route : POST /mon-espace/formation/module/{moduleId}/complete
     */
    public function completeModule(Request $request, int $moduleId)
    {
        $user = Auth::user();

        $enrollment = FormationEnrollment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->firstOrFail();

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

        return redirect()->route('formation.dashboard')->with('success', $message);
    }

    /**
     * Page immersive d'un module
     * Route : GET /mon-espace/formation/module/{slug}
     */
    public function showModule(string $slug)
    {
        $user = Auth::user();
        $misc = $this->miscController;

        $enrollment = FormationEnrollment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->first();

        if (!$enrollment) {
            return redirect()->route('presence.formation-praticien')
                ->with('info', 'Vous n\'êtes pas encore inscrit à la formation.');
        }

        $module = FormationModule::where('slug', $slug)->firstOrFail();

        // Vérifier que le module est accessible (pas locked)
        $progress = $this->formationService->getModuleProgress($enrollment, $module->id);
        if ($progress?->status === 'locked') {
            return redirect()->route('formation.dashboard')
                ->with('info', 'Ce module se débloque après avoir complété le précédent.');
        }

        // Charger la progression des activités
        $activityProgress = FormationActivityProgress::where('enrollment_id', $enrollment->id)
            ->where('module_id', $module->id)
            ->get()
            ->keyBy('activity_index');

        $activities = is_array($module->activities)
            ? $module->activities
            : json_decode($module->activities ?? '[]', true);

        $completedCount = $activityProgress->where('completed_at', '!=', null)->count();
        $totalCount     = count($activities);

        // Modules prev/next
        $allModules = FormationModule::orderBy('order')->get();
        $allSlugs   = $allModules->pluck('slug')->values();
        $currentIdx = $allSlugs->search($slug);
        $prevSlug   = $currentIdx > 0 ? $allSlugs[$currentIdx - 1] : null;
        $nextSlug   = $currentIdx < $allSlugs->count() - 1 ? $allSlugs[$currentIdx + 1] : null;

        // Statut du module
        $moduleStatus = $progress?->status ?? 'available';

        return view('frontend.formation.module', [
            'module'           => $module,
            'enrollment'       => $enrollment,
            'activityProgress' => $activityProgress,
            'activities'       => $activities,
            'completedCount'   => $completedCount,
            'totalCount'       => $totalCount,
            'moduleStatus'     => $moduleStatus,
            'prevSlug'         => $prevSlug,
            'nextSlug'         => $nextSlug,
            'breadcrumb'       => $misc->getBreadcrumb(),
            'language'         => $misc->getLanguage(),
        ]);
    }

    /**
     * Valider / sauvegarder une activité
     * Route : POST /mon-espace/formation/module/{slug}/activity/{idx}
     */
    public function completeActivity(Request $request, string $slug, int $idx)
    {
        $user = Auth::user();

        $enrollment = FormationEnrollment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->firstOrFail();

        $module = FormationModule::where('slug', $slug)->firstOrFail();

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

        return redirect()->route('formation.module.show', $slug)
            ->with('success', 'Activité validée !');
    }

    /**
     * Sauvegarder les notes d'une activité (autosave, sans marquer terminé)
     * Route : POST /mon-espace/formation/module/{slug}/activity/{idx}/notes
     */
    public function saveActivityNotes(Request $request, string $slug, int $idx)
    {
        $user = Auth::user();

        $enrollment = FormationEnrollment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->firstOrFail();

        $module = FormationModule::where('slug', $slug)->firstOrFail();

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
     * Page attestation
     * Route : GET /mon-espace/formation/attestation
     */
    public function showAttestation()
    {
        $user = Auth::user();
        $misc = $this->miscController;

        $enrollment = FormationEnrollment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->first();

        if (!$enrollment) {
            return redirect()->route('presence.formation-praticien')
                ->with('error', 'Vous devez être inscrit à la formation pour accéder à cette page.');
        }

        return view('frontend.formation.attestation', [
            'user'       => $user,
            'enrollment' => $enrollment,
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $misc->getLanguage(),
        ]);
    }
}
