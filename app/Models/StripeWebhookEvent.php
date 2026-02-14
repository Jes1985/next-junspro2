<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Enregistrement des événements Stripe déjà traités pour garantir l'idempotence des webhooks.
 * Un même event_id ne doit jamais créer deux écritures ou deux validations.
 */
class StripeWebhookEvent extends Model
{
    protected $fillable = ['event_id', 'processed_at'];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    /**
     * Enregistre l'événement et retourne true si c'est la première fois (à traiter).
     * Retourne false si l'événement a déjà été traité (idempotence).
     */
    public static function markProcessed(string $eventId): bool
    {
        $record = self::firstOrCreate(
            ['event_id' => $eventId],
            ['processed_at' => now()]
        );

        return $record->wasRecentlyCreated;
    }

    /**
     * Vérifie si un événement a déjà été traité.
     */
    public static function alreadyProcessed(string $eventId): bool
    {
        return self::where('event_id', $eventId)->exists();
    }
}
