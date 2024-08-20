<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $dummyPassword;
    public $activationLink;
    public $email ;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $dummyPassword, $activationLink, $email)
    {
        $this->name = $name;
        $this->dummyPassword = $dummyPassword;
        $this->activationLink = $activationLink;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->email ,
            subject: 'Activate Your Account',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(

            view: 'email.activationEmail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
