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
    // ─── Catalogue des 6 modules (seed initial) ────────────────
    public const MODULES_SEED = [
        ['slug' => '01-je-me-rencontre',          'title' => 'Je me rencontre',                  'week_label' => 'Semaine 1',   'order' => 1],
        ['slug' => '02-je-reconnais-mes-blessures','title' => 'Je reconnais mes blessures',        'week_label' => 'Semaine 2',   'order' => 2],
        ['slug' => '03-je-decris-mon-bonheur',     'title' => 'Je décris mon bonheur',             'week_label' => 'Semaine 3',   'order' => 3],
        ['slug' => '04-j-ecoute-mon-souffle',      'title' => 'J\'écoute mon souffle intérieur',   'week_label' => 'Semaines 4–5','order' => 4],
        ['slug' => '05-je-decouvre-ma-mission',    'title' => 'Je découvre ma mission unique',     'week_label' => 'Semaine 6',   'order' => 5],
        ['slug' => '06-je-pratique-le-rituel',     'title' => 'Je pratique le Rituel Pause Souffle','week_label' => 'Semaines 7–8','order' => 6],
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
            $currentOrder = $progress->module->order;
            $nextModule = FormationModule::where('order', $currentOrder + 1)
                ->where('is_active', true)
                ->first();

            if ($nextModule) {
                FormationModuleProgress::where('enrollment_id', $enrollment->id)
                    ->where('module_id', $nextModule->id)
                    ->update(['status' => 'available']);
            }

            // Vérifier si tous les modules sont complétés → émettre attestation
            $totalModules  = FormationModule::where('is_active', true)->count();
            $doneModules   = FormationModuleProgress::where('enrollment_id', $enrollment->id)
                ->where('status', 'completed')
                ->count();

            if ($doneModules >= $totalModules) {
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
        return FormationModuleProgress::where('enrollment_id', $enrollment->id)
            ->where('module_id', $moduleId)
            ->first();
    }

    /**
     * Récupérer les stats du tableau de bord praticien
     */
    public function getDashboardData(FormationEnrollment $enrollment): array
    {
        $modules  = FormationModule::active()->get();
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

        return [
            'enrollment'      => $enrollment,
            'modules'         => $modulesWithStatus,
            'global_progress' => $enrollment->global_progress,
            'is_certified'    => $enrollment->isCertified(),
            'attestation_code'=> $enrollment->attestation_code,
        ];
    }

    // ──────────────────────────────────────────────────────────
    // PRIVÉ
    // ──────────────────────────────────────────────────────────

    /**
     * Créer les rows de progression pour chaque module (module 1 = available, reste = locked)
     */
    private function initModuleProgress(FormationEnrollment $enrollment): void
    {
        $modules = FormationModule::active()->get();

        foreach ($modules as $index => $module) {
            FormationModuleProgress::firstOrCreate(
                ['enrollment_id' => $enrollment->id, 'module_id' => $module->id],
                ['status' => $index === 0 ? 'available' : 'locked']
            );
        }
    }
}
