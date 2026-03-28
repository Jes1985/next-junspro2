<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MentorshipMission extends Model
{
    use HasFactory;

    protected $fillable = [
        'pod_id',
        'title',
        'brief',
        'difficulty',
        'estimated_hours',
        'due_date',
        'status',
    ];

    protected $casts = [
        'estimated_hours' => 'integer',
        'due_date' => 'date',
    ];

    public function pod(): BelongsTo
    {
        return $this->belongsTo(MentorshipPod::class, 'pod_id');
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(MentorshipMilestone::class, 'mission_id');
    }
}
