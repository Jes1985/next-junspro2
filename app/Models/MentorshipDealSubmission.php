<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\Mentorship\DifficultyScoringService;

class MentorshipDealSubmission extends Model
{
    protected $table = 'mentorship_deal_submissions';

    protected $fillable = [
        'user_id',
        'profile_type',
        'contact_name',
        'contact_email',
        'contact_company',
        'sector',
        'how_found',
        'mission_title',
        'mission_description',
        'budget_estimate',
        'timeline',
        'technologies',
        'deliverables',
        'status',
        'mentor_notes',
        'validated_by',
        'validated_at',
        'bonus_applied',
    ];

    protected $casts = [
        'validated_at' => 'datetime',
        'budget_estimate' => 'integer',
    ];

    /* ── Relations ──────────────────────────────────────── */

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function validatedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'validated_by');
    }

    /* ── Helpers ────────────────────────────────────────── */

    /** Retourne le taux bonus correspondant au profil (sans niveau connu encore) */
    public function bonusRates(): array
    {
        $intern = DifficultyScoringService::DEAL_BRINGER_INTERN_RATES;
        $junior = DifficultyScoringService::DEAL_BRINGER_JUNIOR_RATES;

        return $this->profile_type === 'junior' ? $junior : $intern;
    }

    /** Label du statut en français */
    public function statusLabel(): string
    {
        return match ($this->status) {
            'pending'   => '⏳ En attente de validation',
            'validated' => '✅ Validé — bonus actif',
            'rejected'  => '❌ Refusé',
            default     => $this->status,
        };
    }

    /** Badge couleur Bootstrap/Tailwind */
    public function statusColor(): string
    {
        return match ($this->status) {
            'pending'   => '#f59e0b',
            'validated' => '#10b981',
            'rejected'  => '#ef4444',
            default     => '#94a3b8',
        };
    }
}
