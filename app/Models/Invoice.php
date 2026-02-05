<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'client_id',
        'freelancer_id',
        'subscription_id',
        'payment_intent_id',
        'currency',
        'amount_base_total',
        'amount_client_total',
        'platform_commission_total',
        'platform_client_fee_total',
        'freelancer_net_total',
        'commission_rate_used',
        'meta',
    ];

    protected $casts = [
        'amount_base_total' => 'decimal:2',
        'amount_client_total' => 'decimal:2',
        'platform_commission_total' => 'decimal:2',
        'platform_client_fee_total' => 'decimal:2',
        'freelancer_net_total' => 'decimal:2',
        'commission_rate_used' => 'decimal:4',
        'meta' => 'array',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(FreelancerProfile::class, 'freelancer_id');
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function lines(): HasMany
    {
        return $this->hasMany(InvoiceLine::class);
    }
}
