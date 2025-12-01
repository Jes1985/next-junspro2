<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_session_id',
        'provider',
        'url',
        'duration_minutes',
    ];

    protected $casts = [
        'duration_minutes' => 'integer',
    ];

    /**
     * Relation avec WorkSession
     */
    public function workSession(): BelongsTo
    {
        return $this->belongsTo(WorkSession::class);
    }
}

