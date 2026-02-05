<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceLine extends Model
{
    protected $fillable = [
        'invoice_id',
        'description',
        'hours',
        'base_amount',
        'client_amount',
        'commission_amount',
        'client_fee_amount',
        'freelancer_net_amount',
        'platform_total_amount',
    ];

    protected $casts = [
        'hours' => 'decimal:2',
        'base_amount' => 'decimal:2',
        'client_amount' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'client_fee_amount' => 'decimal:2',
        'freelancer_net_amount' => 'decimal:2',
        'platform_total_amount' => 'decimal:2',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}


