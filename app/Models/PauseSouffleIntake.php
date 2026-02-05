<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PauseSouffleIntake extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_id',
        'email',
        'first_name',
        'last_name',
        'energy',
        'clarity',
        'tension',
        'situation',
        'rythme',
        'protect',
        'preference',
        'plan_key',
        'stripe_price_id',
        'status',
        'stripe_checkout_session_id',
        'stripe_payment_intent_id',
        'paid_at',
        'metadata',
    ];

    protected $casts = [
        'situation' => 'array',
        'protect' => 'array',
        'metadata' => 'array',
        'paid_at' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec Subscription
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Mapper le rythme vers plan_key
     */
    public static function mapRythmeToPlanKey(string $rythme): string
    {
        return match($rythme) {
            '1-session' => 'trial',
            '4-semaines' => 'cycle_4w',
            '3-mois' => 'cycle_3m',
            default => 'trial',
        };
    }

    /**
     * Obtenir le libellé du plan
     */
    public function getPlanLabelAttribute(): string
    {
        return match($this->plan_key) {
            'trial' => 'Rituel d\'essai (1 session)',
            'cycle_4w' => 'Cycle 4 semaines',
            'cycle_3m' => 'Accompagnement 3 mois',
            default => 'Non défini',
        };
    }
}
