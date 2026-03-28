<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class FormationEnrollment extends Model
{
    protected $fillable = [
        'user_id', 'status', 'stripe_payment_intent',
        'amount_paid', 'enrolled_at', 'completed_at',
        'attestation_code', 'attestation_issued_at',
        'certification_level',
        'attestation_code_lvl1', 'attestation_code_lvl2', 'attestation_code_lvl3',
        'attestation_lvl1_issued_at', 'attestation_lvl2_issued_at', 'attestation_lvl3_issued_at',
    ];

    protected $casts = [
        'enrolled_at'                => 'datetime',
        'completed_at'               => 'datetime',
        'attestation_issued_at'      => 'datetime',
        'attestation_lvl1_issued_at' => 'datetime',
        'attestation_lvl2_issued_at' => 'datetime',
        'attestation_lvl3_issued_at' => 'datetime',
    ];

    // ─── Relations ────────────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function moduleProgress(): HasMany
    {
        return $this->hasMany(FormationModuleProgress::class, 'enrollment_id');
    }

    // ─── Helpers ──────────────────────────────────────────────

    /** Progression globale 0-100 **/
    public function getGlobalProgressAttribute(): int
    {
        $total = FormationModule::where('is_active', true)->count();
        if ($total === 0) return 0;

        $completed = $this->moduleProgress()->where('status', 'completed')->count();
        return (int) round($completed / $total * 100);
    }

    /** L'enrollement est-il certifié (TRACK_PRATICIEN — rétrocompatibilité) ? **/
    public function isCertified(): bool
    {
        return $this->status === 'completed' && $this->attestation_code !== null;
    }

    /** Certifié Niveau 1 — Praticien Pause Souffle · Éveil (Formation 1, parcours ordres 1-9) **/
    public function isLevel1Certified(): bool
    {
        return $this->attestation_code_lvl1 !== null;
    }

    /** Certifié Niveau 2 — Praticien Pause Souffle · Ancrage (Parcours 2 — Se Construire) **/
    public function isLevel2Certified(): bool
    {
        return $this->attestation_code_lvl2 !== null;
    }

    /** Certifié Niveau 3 — Praticien Pause Souffle · Maître (Parcours 3 — S'Ouvrir) **/
    public function isLevel3Certified(): bool
    {
        return $this->attestation_code_lvl3 !== null;
    }

    /** Émettre la certification Niveau 1 **/
    public function issueLevel1Attestation(): void
    {
        if ($this->attestation_code_lvl1) return;

        $this->update([
            'attestation_code_lvl1'      => 'N1-ATT-' . strtoupper(Str::random(10)),
            'attestation_lvl1_issued_at' => now(),
            'certification_level'        => max($this->certification_level ?? 0, 1),
        ]);
    }

    /** Émettre la certification Niveau 2 (présuppose Niveau 1 déjà émis) **/
    public function issueLevel2Attestation(): void
    {
        if ($this->attestation_code_lvl2) return;

        if (!$this->attestation_code_lvl1) {
            $this->issueLevel1Attestation();
        }

        $this->update([
            'attestation_code_lvl2'      => 'N2-ATT-' . strtoupper(Str::random(10)),
            'attestation_lvl2_issued_at' => now(),
            'certification_level'        => max($this->certification_level ?? 0, 2),
        ]);
    }

    /** Émettre la certification Niveau 3 — Parcours complet (présuppose Niveau 2 déjà émis) **/
    public function issueLevel3Attestation(): void
    {
        if ($this->attestation_code_lvl3) return;

        if (!$this->attestation_code_lvl2) {
            $this->issueLevel2Attestation();
        }

        $this->update([
            'attestation_code_lvl3'      => 'N3-ATT-' . strtoupper(Str::random(10)),
            'attestation_lvl3_issued_at' => now(),
            'certification_level'        => 3,
            'status'                     => 'completed',
            'completed_at'               => now(),
        ]);
    }

    /** Générer et sauvegarder le code d'attestation (TRACK_PRATICIEN — rétrocompatibilité) **/
    public function issueAttestation(): void
    {
        if ($this->attestation_code) return;

        $this->update([
            'attestation_code'        => 'ATT-' . strtoupper(Str::random(10)),
            'attestation_issued_at'   => now(),
            'status'                  => 'completed',
            'completed_at'            => now(),
        ]);
    }
}
