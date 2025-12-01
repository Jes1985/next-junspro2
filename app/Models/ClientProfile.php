<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'total_spent',
    ];

    protected $casts = [
        'total_spent' => 'decimal:2',
    ];

    /**
     * Relation avec User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Abonnements du client
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'client_id');
    }

    /**
     * Demandes de transfert
     */
    public function transferRequests(): HasMany
    {
        return $this->hasMany(TransferRequest::class, 'client_id');
    }

    /**
     * Récompenses
     */
    public function rewards(): HasMany
    {
        return $this->hasMany(Reward::class, 'client_id');
    }

    /**
     * Services premium
     */
    public function premiumServices(): HasMany
    {
        return $this->hasMany(PremiumService::class, 'owner_id')
            ->where('owner_type', 'client');
    }
}

