<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $payment;
    public $enrollment;

    public function __construct($candidate, $payment, $enrollment)
    {
        $this->candidate  = $candidate;
        $this->payment    = $payment;
        $this->enrollment = $enrollment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Confirmation – Personality Assessment Test',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment_receipt',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
