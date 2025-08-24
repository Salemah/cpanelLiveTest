<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{

    use Queueable, SerializesModels;

    public $data;
    public $subject;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $subject, $pdf = null)
    {
        $this->data = $data;
        $this->subject = $subject; // Set the dynamic subject
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $mail = $this->subject($this->subject)
            ->view('mail.invoice_email') // normal Blade for email body
            ->with('data', $this->data);

        // attach PDF if provided
        if ($this->pdf) {
            $mail->attachData($this->pdf->output(), 'invoice.pdf');
        }

        return $mail;
        // return $this->subject($this->subject) // Use the dynamic subject here
        //     ->view('mail.invoice_email');
    }
}
