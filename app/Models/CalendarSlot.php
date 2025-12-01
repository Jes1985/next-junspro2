<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalendarSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_id',
        'weekday',
        'hour',
        'is_available',
    ];

    protected $casts = [
        'weekday' => 'integer',
        'hour' => 'integer',
        'is_available' => 'boolean',
    ];

    /**
     * Relation avec FreelancerProfile
     */
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(FreelancerProfile::class, 'freelancer_id');
    }
}

