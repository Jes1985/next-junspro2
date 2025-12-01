<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rebooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_session_id',
        'old_start_at',
        'new_start_at',
        'requested_by',
        'reason',
        'approved',
    ];

    protected $casts = [
        'old_start_at' => 'datetime',
        'new_start_at' => 'datetime',
        'approved' => 'boolean',
    ];

    /**
     * Relation avec WorkSession
     */
    public function workSession(): BelongsTo
    {
        return $this->belongsTo(WorkSession::class);
    }

    /**
     * Relation avec FreelancerProfile (qui a demandé)
     */
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(FreelancerProfile::class, 'requested_by');
    }
}

