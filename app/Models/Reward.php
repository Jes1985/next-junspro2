<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'threshold_reached',
        'sessions_count',
        'status',
        'calendly_link',
    ];

    protected $casts = [
        'sessions_count' => 'integer',
    ];

    /**
     * Relation avec ClientProfile
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }
}

