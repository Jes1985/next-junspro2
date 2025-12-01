<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FreelancerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hourly_rate',
        'reliability_score',
        'wellness_plan',
        'bio',
        'skills',
        'languages',
        'timezone',
        'is_verified',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'reliability_score' => 'integer',
        'skills' => 'array',
        'languages' => 'array',
        'is_verified' => 'boolean',
    ];

    /**
     * Relation avec User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Abonnements où ce freelance travaille
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'freelancer_id');
    }

    /**
     * Créneaux de calendrier
     */
    public function calendarSlots(): HasMany
    {
        return $this->hasMany(CalendarSlot::class, 'freelancer_id');
    }

    /**
     * Reprogrammations demandées
     */
    public function rebookings(): HasMany
    {
        return $this->hasMany(Rebooking::class, 'requested_by');
    }

    /**
     * Demandes de transfert (ancien freelance)
     */
    public function transferRequestsAsOld(): HasMany
    {
        return $this->hasMany(TransferRequest::class, 'old_freelancer_id');
    }

    /**
     * Demandes de transfert (nouveau freelance)
     */
    public function transferRequestsAsNew(): HasMany
    {
        return $this->hasMany(TransferRequest::class, 'new_freelancer_id');
    }

    /**
     * Services premium
     */
    public function premiumServices(): HasMany
    {
        return $this->hasMany(PremiumService::class, 'owner_id')
            ->where('owner_type', 'freelance');
    }
}

