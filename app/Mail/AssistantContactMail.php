<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssistantContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nouveau message depuis l\'Assistant Junspro - ' . $this->data['subject'])
            ->view('emails.assistant-contact')
            ->with([
                'email' => $this->data['email'],
                'subject' => $this->data['subject'],
                'message' => $this->data['message'],
                'ticket_number' => $this->data['ticket_number'],
                'user_id' => $this->data['user_id'],
                'user_name' => $this->data['user_name'],
            ]);
    }
}


