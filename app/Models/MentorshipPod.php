<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MentorshipPod extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_user_id',
        'title',
        'sector',
        'description',
        'max_trainees',
        'active_trainees_count',
        'visibility',
        'status',
        'premium_label',
    ];

    protected $casts = [
        'max_trainees' => 'integer',
        'active_trainees_count' => 'integer',
    ];

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_user_id');
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(MentorshipMembership::class, 'pod_id');
    }

    public function missions(): HasMany
    {
        return $this->hasMany(MentorshipMission::class, 'pod_id');
    }

    public function checkins(): HasMany
    {
        return $this->hasMany(MentorshipCheckin::class, 'pod_id');
    }
}
