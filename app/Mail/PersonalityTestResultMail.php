<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PersonalityTestResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $personalityTest;

    /**
     * Create a new message instance.
     */
    public function __construct($candidate, $personalityTest)
    {
        $this->candidate = $candidate;
        $this->personalityTest = $personalityTest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Personality Test Result is Ready + Exclusive 90% OFF Offer Inside!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.successfulEmailRegistration',
        );
    }
}