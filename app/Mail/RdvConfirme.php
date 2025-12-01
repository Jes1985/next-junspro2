<?php

namespace App\Mail;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RdvConfirme extends Mailable
{
    use Queueable, SerializesModels;

    public $mission;

    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    public function build()
    {
        return $this->subject('Votre rendez-vous est confirmé - Junspro')
                    ->view('emails.rdv-confirme')
                    ->with([
                        'mission' => $this->mission,
                    ]);
    }
}


