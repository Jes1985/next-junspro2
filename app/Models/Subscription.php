<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'freelancer_id',
        'hours_per_week',
        'hours_total_month',
        'hours_remaining',
        'price_base',
        'delivery_mode',
        'status',
        'stripe_subscription_id',
        'next_billing_at',
        'starts_at',
        'ends_at',
        'has_express_24h',
        'has_express_48h',
        'has_express_72h',
        'max_rectifications_per_delivery',
        'kickoff_done',
        'can_transfer',
    ];

    protected $casts = [
        'hours_per_week' => 'integer',
        'hours_total_month' => 'float',
        'hours_remaining' => 'float',
        'price_base' => 'decimal:2',
        'next_billing_at' => 'datetime',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'has_express_24h' => 'boolean',
        'has_express_48h' => 'boolean',
        'has_express_72h' => 'boolean',
        'kickoff_done' => 'boolean',
        'can_transfer' => 'boolean',
    ];

    /**
     * Relation avec ClientProfile
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    /**
     * Relation avec FreelancerProfile
     */
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(FreelancerProfile::class, 'freelancer_id');
    }

    /**
     * Sessions de travail
     */
    public function workSessions(): HasMany
    {
        return $this->hasMany(WorkSession::class);
    }

    /**
     * Plaintes associées à cet abonnement
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * Messages de chat associés à cet abonnement
     */
    public function chatMessages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    /**
     * Calculer le prix final avec Express
     */
    public function getFinalPriceAttribute(): float
    {
        $multiplier = match($this->delivery_mode) {
            'express_24h' => 1.30,
            'express_48h' => 1.20,
            'express_72h' => 1.10,
            default => 1.0,
        };

        return $this->price_base * $multiplier;
    }

    /**
     * Vérifier si l'abonnement est actif
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}

