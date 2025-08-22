<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserGreetingMail extends Mailable
{

    use Queueable, SerializesModels;

    public $mailData;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, $subject)
    {
        $this->mailData = $mailData;
        $this->subject = $subject; // Set the dynamic subject
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject) // Use the dynamic subject here
            ->view('mail.user_greeting_email');
    }
}
