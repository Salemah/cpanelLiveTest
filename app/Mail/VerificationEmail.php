<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{

    use Queueable, SerializesModels;

    public $data;
    public $subject;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $subject, $token)
    {
        $this->data = $data;
        $this->subject = $subject; // Set the dynamic subject
        $this->token = $token; // Set the dynamic subject
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject) // Use the dynamic subject here
            ->view('mail.emailVerificationEmail');
    }
}
