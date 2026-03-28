<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorshipMembership extends Model
{
    use HasFactory;

    protected $fillable = [
        'pod_id',
        'trainee_user_id',
        'trainee_type',
        'membership_status',
        'start_date',
        'end_date',
        'completion_reason',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
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
