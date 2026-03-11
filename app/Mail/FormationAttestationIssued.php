<?php

namespace App\Mail;

use App\Models\FormationEnrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormationAttestationIssued extends Mailable
{
    use Queueable, SerializesModels;

    public FormationEnrollment $enrollment;

    public function __construct(FormationEnrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    public function build(): static
    {
        return $this->subject('Félicitations ! Vous êtes désormais Praticien(ne) Pause Souffle ∞+')
                    ->view('emails.formation-attestation-issued')
                    ->with([
                        'enrollment'     => $this->enrollment,
                        'user'           => $this->enrollment->user,
                        'attestationUrl' => route('formation.attestation'),
                    ]);
    }
}
