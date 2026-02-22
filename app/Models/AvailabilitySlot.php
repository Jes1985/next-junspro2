<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvailabilitySlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_at',
        'end_at',
        'status',
        'timezone',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_UNAVAILABLE = 'unavailable';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function overlaps(Carbon $startUtc, Carbon $endUtc, ?int $ignoreId = null): bool
    {
        $query = static::query()
            ->where('user_id', $this->user_id ?? null)
            ->where(function ($q) use ($startUtc, $endUtc) {
                $q->where('start_at', '<', $endUtc)
                  ->where('end_at', '>', $startUtc);
            });

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}
