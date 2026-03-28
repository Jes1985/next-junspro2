<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Email envoyé automatiquement à un participant à la fin de son cycle Pause Souffle
 * pour l'inviter, en douceur, à rejoindre le réseau des Ambassadeurs.
 */
class PsAmbassadorInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly User    $user,
        public readonly string  $context = 'cycle',  // 'cycle' ou 'formation'
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "✦ Votre expérience mérite d'être partagée",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ps-ambassador-invitation',
            with: [
                'user'         => $this->user,
                'context'      => $this->context,
                'landingUrl'   => route('presence.ambassadeurs'),
                'firstName'    => $this->user->first_name
                                    ?? explode(' ', $this->user->name ?? '')[0]
                                    ?? 'vous',
            ],
        );
    }
}
