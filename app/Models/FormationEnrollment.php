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
    ];

    protected $casts = [
        'enrolled_at'           => 'datetime',
        'completed_at'          => 'datetime',
        'attestation_issued_at' => 'datetime',
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

    /** L'enrollement est-il certifié ? **/
    public function isCertified(): bool
    {
        return $this->status === 'completed' && $this->attestation_code !== null;
    }

    /** Générer et sauvegarder le code d'attestation **/
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
