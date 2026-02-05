<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionTopup extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'user_id',
        'qty',
        'unit_price',
        'total_price',
        'status',
        'stripe_payment_intent_id',
        'paid_at',
    ];

    protected $casts = [
        'qty' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    /**
     * Relation avec Subscription
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Relation avec User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour les topups payés
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Scope pour une fenêtre de temps (rolling 28 jours)
     * Utilise created_at pour la fenêtre rolling
     */
    public function scopeInWindow($query, $startDate = null, $endDate = null)
    {
        if (!$startDate) {
            $startDate = now()->subDays(28);
        }
        if (!$endDate) {
            $endDate = now();
        }
        
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
}

