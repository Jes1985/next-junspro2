<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'start_at',
        'end_at',
        'duration_minutes',
        'is_meeting',
        'delivery_speed',
        'deadline_at',
        'report_text',
        'report_files',
        'rebook_count',
        'rectification_count',
        'status',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'deadline_at' => 'datetime',
        'duration_minutes' => 'integer',
        'is_meeting' => 'boolean',
        'report_files' => 'array',
        'rebook_count' => 'integer',
        'rectification_count' => 'integer',
    ];

    /**
     * Relation avec Subscription
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Visio associée (si is_meeting = true)
     */
    public function meeting(): HasOne
    {
        return $this->hasOne(Meeting::class);
    }

    /**
     * Reprogrammation associée
     */
    public function rebooking(): HasOne
    {
        return $this->hasOne(Rebooking::class);
    }

    /**
     * Plaintes liées à cette session
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * Vérifier si la session est complétée
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed' && !empty($this->report_text);
    }

    /**
     * Vérifier si la session est en retard
     */
    public function isLate(): bool
    {
        if ($this->delivery_speed === 'standard') {
            return false;
        }

        return $this->status === 'late' || 
               ($this->deadline_at && $this->deadline_at->isPast() && $this->status !== 'completed');
    }

    /**
     * Accéder au client via la subscription
     */
    public function getClientAttribute()
    {
        return $this->subscription->client ?? null;
    }

    /**
     * Accéder au freelance via la subscription
     */
    public function getFreelancerAttribute()
    {
        return $this->subscription->freelancer ?? null;
    }
}

