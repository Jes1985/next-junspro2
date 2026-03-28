<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PsConversion extends Model
{
    protected $table = 'ps_conversions';

    protected $fillable = [
        'ambassadeur_id',
        'referred_user_id',
        'product_type',
        'stripe_payment_intent',
        'sale_amount',
        'commission_rate',
        'commission_amount',
        'status',
        'validated_at',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'sale_amount'       => 'decimal:2',
        'commission_rate'   => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'validated_at'      => 'datetime',
        'paid_at'           => 'datetime',
    ];

    const STATUS_LABELS = [
        'pending'   => ['label' => 'En attente',  'color' => '#f59e0b'],
        'validated' => ['label' => 'Validée',      'color' => '#8b5cf6'],
        'paid'      => ['label' => 'Payée',         'color' => '#10b981'],
        'cancelled' => ['label' => 'Annulée',       'color' => '#ef4444'],
    ];

    const PRODUCT_LABELS = [
        'pause_parcours'  => 'Parcours Pause Souffle',
        'pause_freelance' => 'Freelance Pause Souffle',
        'pause_formateur' => 'Formation Formateur PS',
        'pause_retraite'  => 'Retraite Pause Souffle',
    ];

    // ─── Relations ────────────────────────────────────────────
    public function ambassadeur(): BelongsTo
    {
        return $this->belongsTo(PsAmbassadeur::class, 'ambassadeur_id');
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

    public function getProductLabelAttribute(): string
    {
        return self::PRODUCT_LABELS[$this->product_type] ?? ucfirst($this->product_type ?? 'Autre');
    }
}
