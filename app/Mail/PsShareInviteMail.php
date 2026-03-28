<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Email envoyé par un ambassadeur à une personne de son entourage
 * pour l'inviter à découvrir Pause Souffle via son lien personnel.
 */
class PsShareInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $recipientFirstName,
        public readonly string $senderFirstName,
        public readonly string $senderMessage,
        public readonly string $ambassadorLink,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "{$this->senderFirstName} vous a transmis quelque chose",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ps-share-invite',
            with: [
                'recipientFirstName' => $this->recipientFirstName,
                'senderFirstName'    => $this->senderFirstName,
                'senderMessage'      => $this->senderMessage,
                'ambassadorLink'     => $this->ambassadorLink,
            ],
        );
    }
}
