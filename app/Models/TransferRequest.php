<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransferRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'old_freelancer_id',
        'new_freelancer_id',
        'subscription_id',
        'hours_transferred',
        'reason',
        'status',
    ];

    protected $casts = [
        'hours_transferred' => 'float',
    ];

    /**
     * Relation avec ClientProfile
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    /**
     * Relation avec FreelancerProfile (ancien)
     */
    public function oldFreelancer(): BelongsTo
    {
        return $this->belongsTo(FreelancerProfile::class, 'old_freelancer_id');
    }

    /**
     * Relation avec FreelancerProfile (nouveau)
     */
    public function newFreelancer(): BelongsTo
    {
        return $this->belongsTo(FreelancerProfile::class, 'new_freelancer_id');
    }

    /**
     * Relation avec Subscription
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}

