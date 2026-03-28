<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PsAmbassadeur extends Model
{
    protected $table = 'ps_ambassadeurs';

    protected $fillable = [
        'user_id',
        'code',
        'status',
        'tier',
        'total_earned',
        'pending_payout',
        'paid_out',
        'iban',
        'bic',
        'bank_name',
        'account_holder',
        'notes',
        'phone',
        'motivation',
        'activated_at',
    ];

    protected $casts = [
        'total_earned'   => 'decimal:2',
        'pending_payout' => 'decimal:2',
        'paid_out'       => 'decimal:2',
        'activated_at'   => 'datetime',
    ];

    // ─── Configuration des tiers ──────────────────────────────
    const TIERS = [
        'standard'    => ['label' => 'Ambassadeur Standard',   'icon' => '✦',     'min_sales' => 0],
        'partenaire'  => ['label' => 'Ambassadeur Partenaire', 'icon' => '✦✦',   'min_sales' => 5],
        'ambassadeur' => ['label' => 'Ambassadeur',            'icon' => '✦✦✦', 'min_sales' => 15],
    ];

    // ─── Taux de commission par produit PS ────────────────────
    const COMMISSION_RATES = [
        'pause_parcours'  => 25.00,
        'pause_freelance' => 20.00,
        'pause_formateur' => 15.00,
        'pause_retraite'  => 10.00,
    ];

    // ─── Relations ────────────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function conversions(): HasMany
    {
        return $this->hasMany(PsConversion::class, 'ambassadeur_id');
    }

    // ─── Accesseurs ───────────────────────────────────────────
    public function getTierLabelAttribute(): string
    {
        return self::TIERS[$this->tier]['label'] ?? ucfirst($this->tier);
    }

    public function getTierIconAttribute(): string
    {
        return self::TIERS[$this->tier]['icon'] ?? '✦';
    }

    public function getTrackingLinkAttribute(): string
    {
        return url('/ps/' . $this->code);
    }

    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'active';
    }
}
