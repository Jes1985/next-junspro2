<?php

namespace App\Mail;

use App\Models\PsAmbassadeur;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Email mensuel envoyé le 1er de chaque mois à tous les ambassadeurs actifs.
 * Contient : clics, ventes, commissions du mois, comparaison M-1, message d'encouragement.
 * Planifié via : php artisan ps:send-monthly-stats
 */
class PsMonthlyStatsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly User          $user,
        public readonly PsAmbassadeur $ambassadeur,
        public readonly array         $monthlyStats,
        public readonly string        $monthLabel
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "✦ Votre bilan Pause Souffle — {$this->monthLabel}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ps-monthly-stats',
        );
    }
}
