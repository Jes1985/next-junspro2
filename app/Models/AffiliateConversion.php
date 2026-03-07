<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffiliateConversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'affiliate_id',
        'referred_user_id',
        'source_type',
        'source_id',
        'stripe_payment_intent',
        'transaction_amount',
        'commission_rate',
        'commission_amount',
        'status',
        'commission_month',
        'validated_at',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'transaction_amount' => 'decimal:2',
        'commission_rate'    => 'decimal:2',
        'commission_amount'  => 'decimal:2',
        'validated_at'       => 'datetime',
        'paid_at'            => 'datetime',
    ];

    // Labels lisibles pour l'affichage
    const STATUS_LABELS = [
        'pending'   => ['label' => 'En attente',  'color' => '#f59e0b'],
        'validated' => ['label' => 'Validée',      'color' => '#8b5cf6'],
        'paid'      => ['label' => 'Payée',         'color' => '#10b981'],
        'cancelled' => ['label' => 'Annulée',       'color' => '#ef4444'],
    ];

    const SOURCE_LABELS = [
        'mission'      => 'Mission',
        'homeswap'     => 'HomeSwap',
        'subscription' => 'Abonnement',
        'other'        => 'Autre',
    ];

    // ─── Relations ────────────────────────────────────────────
    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function referredUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }

    // ─── Accesseurs ───────────────────────────────────────────
    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status]['label'] ?? ucfirst($this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_LABELS[$this->status]['color'] ?? '#6b7280';
    }

    public function getSourceLabelAttribute(): string
    {
        return self::SOURCE_LABELS[$this->source_type] ?? ucfirst($this->source_type ?? 'Autre');
    }
}
