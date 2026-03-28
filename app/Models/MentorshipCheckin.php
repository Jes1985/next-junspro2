<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorshipCheckin extends Model
{
    use HasFactory;

    protected $fillable = [
        'pod_id',
        'trainee_user_id',
        'week_start',
        'progress_percent',
        'blockers_text',
        'next_actions_text',
        'mentor_feedback_text',
        'confidence_level',
        'risk_flag',
    ];

    protected $casts = [
        'week_start' => 'date',
        'progress_percent' => 'integer',
        'confidence_level' => 'integer',
    ];

    public function pod(): BelongsTo
    {
        return $this->belongsTo(MentorshipPod::class, 'pod_id');
    }

    public function trainee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainee_user_id');
    }
}
