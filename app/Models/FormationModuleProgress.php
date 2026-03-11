<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormationModuleProgress extends Model
{
    protected $table = 'formation_module_progress';

    protected $fillable = [
        'enrollment_id', 'module_id', 'status',
        'completion_pct', 'started_at', 'completed_at', 'activity_checks',
    ];

    protected $casts = [
        'started_at'      => 'datetime',
        'completed_at'    => 'datetime',
        'activity_checks' => 'array',
    ];

    // ─── Relations ────────────────────────────────────────────
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(FormationEnrollment::class, 'enrollment_id');
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(FormationModule::class, 'module_id');
    }

    // ─── Helpers ──────────────────────────────────────────────
    public function markCompleted(): void
    {
        $this->update([
            'status'         => 'completed',
            'completion_pct' => 100,
            'completed_at'   => now(),
        ]);
    }

    public function markStarted(): void
    {
        if ($this->status === 'locked' || $this->status === 'available') {
            $this->update([
                'status'     => 'in_progress',
                'started_at' => $this->started_at ?? now(),
            ]);
        }
    }
}
