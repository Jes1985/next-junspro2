<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Affiliate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'affiliate_code',
        'tier',
        'commission_rate',
        'status',
        'active_conversions',
        'total_earned',
        'pending_payout',
        'paid_out',
        'iban',
        'bic',
        'bank_name',
        'account_holder',
        'custom_slug',
        'notes',
        'activated_at',
    ];

    protected $casts = [
        'commission_rate'  => 'decimal:2',
        'total_earned'     => 'decimal:2',
        'pending_payout'   => 'decimal:2',
        'paid_out'         => 'decimal:2',
        'activated_at'     => 'datetime',
    ];

    // ─── Paliers ──────────────────────────────────────────────
    const TIERS = [
        'ambassador' => ['label' => 'Ambassadeur',     'rate' => 5.00,  'duration_months' => 6,  'min_conversions' => 0],
        'elite'      => ['label' => 'Partenaire Élite', 'rate' => 7.00,  'duration_months' => 12, 'min_conversions' => 3],
        'club'       => ['label' => 'JunsPro Club',    'rate' => 10.00, 'duration_months' => 24, 'min_conversions' => 10],
    ];

    // ─── Relations ────────────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function conversions(): HasMany
    {
        return $this->hasMany(AffiliateConversion::class);
    }

    public function pendingConversions(): HasMany
    {
        return $this->hasMany(AffiliateConversion::class)->where('status', 'pending');
    }

    public function validatedConversions(): HasMany
    {
        return $this->hasMany(AffiliateConversion::class)->where('status', 'validated');
    }

    public function paidConversions(): HasMany
    {
        return $this->hasMany(AffiliateConversion::class)->where('status', 'paid');
    }

    // ─── Accesseurs ───────────────────────────────────────────
    public function getTierLabelAttribute(): string
    {
        return self::TIERS[$this->tier]['label'] ?? ucfirst($this->tier);
    }

    public function getTrackingLinkAttribute(): string
    {
        $slug = $this->custom_slug ?? $this->affiliate_code;
        return route('affiliate.track', ['code' => $slug]);
    }

    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'active';
    }

    public function getNextTierAttribute(): ?string
    {
        if ($this->tier === 'ambassador') return 'elite';
        if ($this->tier === 'elite')      return 'club';
        return null;
    }

    public function getNextTierProgressAttribute(): int
    {
        $next = $this->next_tier;
        if (!$next) return 100;
        $required = self::TIERS[$next]['min_conversions'];
        return $required > 0 ? min(100, (int)(($this->active_conversions / $required) * 100)) : 100;
    }
}
