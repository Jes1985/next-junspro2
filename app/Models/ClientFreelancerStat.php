<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientFreelancerStat extends Model
{
    protected $fillable = [
        'client_id',
        'freelancer_id',
        'total_base_amount',
        'total_client_amount',
        'current_commission_rate',
    ];

    protected $casts = [
        'total_base_amount' => 'decimal:2',
        'total_client_amount' => 'decimal:2',
        'current_commission_rate' => 'decimal:4',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(FreelancerProfile::class, 'freelancer_id');
    }
}


