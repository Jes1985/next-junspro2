<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormationActivityProgress extends Model
{
    protected $table = 'formation_activity_progress';

    protected $fillable = [
        'enrollment_id',
        'module_id',
        'activity_index',
        'notes',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(FormationEnrollment::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(FormationModule::class);
    }

    public function isCompleted(): bool
    {
        return $this->completed_at !== null;
    }
}
