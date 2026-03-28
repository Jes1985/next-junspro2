<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorshipSubscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_key',
        'stripe_subscription_id',
        'stripe_checkout_session_id',
        'status',
        'current_cycle_start',
        'current_cycle_end',
        'next_billing_at',
        'price_paid',
        'paid_at',
        'cancelled_at',
    ];

    protected $casts = [
        'current_cycle_start' => 'date',
        'current_cycle_end'   => 'date',
        'next_billing_at'     => 'datetime',
        'price_paid'          => 'decimal:2',
        'paid_at'             => 'datetime',
        'cancelled_at'        => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function planLabel(): string
    {
        return config("mentorship.plan_names.{$this->plan_key}", $this->plan_key);
    }

    public function planPrice(): int
    {
        return config("mentorship.plan_prices.{$this->plan_key}", 0);
    }

    public function cycleCount(): int
    {
        return (int) str_replace('cycle_', '', $this->plan_key);
    }
}
