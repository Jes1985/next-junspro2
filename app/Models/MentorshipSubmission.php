<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorshipSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'milestone_id',
        'trainee_user_id',
        'submission_url',
        'notes',
        'submitted_at',
        'review_status',
        'score_technical',
        'score_communication',
        'score_autonomy',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'score_technical' => 'integer',
        'score_communication' => 'integer',
        'score_autonomy' => 'integer',
    ];

    public function milestone(): BelongsTo
    {
        return $this->belongsTo(MentorshipMilestone::class, 'milestone_id');
    }

    public function trainee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainee_user_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
