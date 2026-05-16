<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class RTCATUpgradeOffer extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $offerDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($candidate, $offerDetails = null)
    {
        $this->candidate = $candidate;
        $this->offerDetails = $offerDetails ?? [
            'discount_percentage' => 90,
            'discounted_price' => 'Rs. 499',
            'original_price' => 'Rs. 4,990',
            'coupon_code' => 'PERTEST',
            'valid_until' => now()->addDays(7)->format('F j, Y'),
        ];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Unlock RTCAT at 90% OFF – Your Exclusive Coupon Inside!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rtcat_upgrade_offer',
        );
    }
    
    public function attachments(): array
{
    return [
        Attachment::fromPath(public_path('assets/pdf/Step_by_Step_Guide_to_Attempt_RTCAT.pdf'))
            ->as('Step_by_Step_Guide_to_Attempt_RTCAT.pdf')
            ->withMime('application/pdf'),
    ];
}
}