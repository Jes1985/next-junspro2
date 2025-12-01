<?php

namespace App\Mail;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MiseEnRelationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $mission;

    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre mise en relation Junspro')
                    ->view('emails.mise-en-relation-confirmation')
                    ->with([
                        'mission' => $this->mission,
                    ]);
    }
}


