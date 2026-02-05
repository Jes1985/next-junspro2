<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',
        'referred_id',
        'client_profile_id',
        'status',
        'reward_amount',
        'benefit_amount',
        'first_booking_at',
        'first_service_confirmed_at',
        'reward_credited_at',
        'notes',
    ];

    protected $casts = [
        'reward_amount' => 'decimal:2',
        'benefit_amount' => 'decimal:2',
        'first_booking_at' => 'datetime',
        'first_service_confirmed_at' => 'datetime',
        'reward_credited_at' => 'datetime',
    ];

    /**
     * Relation avec le parrain (User)
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    /**
     * Relation avec le filleul (User)
     */
    public function referred(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_id');
    }

    /**
     * Relation avec le profil client du filleul
     */
    public function clientProfile(): BelongsTo
    {
        return $this->belongsTo(ClientProfile::class);
    }
}

