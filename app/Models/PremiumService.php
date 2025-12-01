<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumService extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_type',
        'owner_id',
        'type',
        'price',
        'start_at',
        'end_at',
        'metadata',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'metadata' => 'array',
    ];

    /**
     * Relation polymorphique avec owner (client ou freelance)
     */
    public function owner()
    {
        return $this->morphTo();
    }
}

