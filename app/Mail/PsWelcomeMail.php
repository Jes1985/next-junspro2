<?php

namespace App\Mail;

use App\Models\PsAmbassadeur;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PsWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public PsAmbassadeur $ambassadeur;
    public string $trackingLink;
    public string $ressourcesUrl;

    public function __construct(User $user, PsAmbassadeur $ambassadeur)
    {
        $this->user          = $user;
        $this->ambassadeur   = $ambassadeur;
        $this->trackingLink  = url('/ps/' . $ambassadeur->code);
        $this->ressourcesUrl = route('ps.ressources');
    }

    public function build(): static
    {
        $firstName = $this->user->first_name ?? explode(' ', $this->user->name ?? 'Ambassadeur')[0];

        return $this->subject('✦ Bienvenue dans le Réseau des Ambassadeurs Pause Souffle')
                    ->view('emails.ps-welcome')
                    ->with([
                        'firstName'     => $firstName,
                        'trackingLink'  => $this->trackingLink,
                        'ressourcesUrl' => $this->ressourcesUrl,
                        'code'          => $this->ambassadeur->code,
                    ]);
    }
}
