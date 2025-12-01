<?php

namespace App\Mail;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccompagnementConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $mission;

    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre accompagnement Junspro')
                    ->view('emails.accompagnement-confirmation')
                    ->with([
                        'mission' => $this->mission,
                    ]);
    }
}


