<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MentorshipMilestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        'title',
        'objectives_text',
        'order_index',
        'weight_percent',
        'due_date',
        'status',
    ];

    protected $casts = [
        'order_index' => 'integer',
        'weight_percent' => 'integer',
        'due_date' => 'date',
    ];

    public function mission(): BelongsTo
    {
        return $this->belongsTo(MentorshipMission::class, 'mission_id');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(MentorshipSubmission::class, 'milestone_id');
    }
}
