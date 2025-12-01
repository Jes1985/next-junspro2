<?php

namespace App\Mail;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BonusBienEtre extends Mailable
{
    use Queueable, SerializesModels;

    public $mission;

    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    public function build()
    {
        $bonusLabels = [
            'Vitalite' => 'Vitalité',
            'Serenite' => 'Sérénité',
            'Equilibre' => 'Équilibre',
        ];

        $bonusLabel = $bonusLabels[$this->mission->bonus] ?? $this->mission->bonus;

        return $this->subject('Félicitations ! Bonus bien-être Junspro')
                    ->view('emails.bonus-bien-etre')
                    ->with([
                        'mission' => $this->mission,
                        'bonusLabel' => $bonusLabel,
                    ]);
    }
}


