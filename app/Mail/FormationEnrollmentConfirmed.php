<?php

namespace App\Mail;

use App\Models\FormationEnrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormationEnrollmentConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public FormationEnrollment $enrollment;
    public float $amountPaid;
    public string $paymentType; // 'full' | 'installment'

    public function __construct(FormationEnrollment $enrollment, float $amountPaid, string $paymentType = 'full')
    {
        $this->enrollment  = $enrollment;
        $this->amountPaid  = $amountPaid;
        $this->paymentType = $paymentType;
    }

    public function build(): static
    {
        $subject = $this->paymentType === 'installment'
            ? 'Votre 1ère mensualité est confirmée — Formation Praticien Pause Souffle'
            : 'Votre inscription est confirmée — Formation Praticien Pause Souffle';

        return $this->subject($subject)
                    ->view('emails.formation-enrollment-confirmed')
                    ->with([
                        'enrollment'  => $this->enrollment,
                        'amountPaid'  => $this->amountPaid,
                        'paymentType' => $this->paymentType,
                        'dashboardUrl' => route('formation.dashboard'),
                    ]);
    }
}
