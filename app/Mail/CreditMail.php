<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class CreditMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $recipient;
    public $mailing;
    public $topEmailAd;
    public $creditsUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailing, $sender, $recipient, $creditsUrl, $topEmailAd= null)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->mailing = $mailing;
        $this->creditsUrl = $creditsUrl;
        $this->topEmailAd = $topEmailAd;
    }


        /**
     * Get the message envelope.
     */
        public function envelope(): Envelope
        {
            return new Envelope(
                subject: $this->mailing->subject,
            );
        }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.credit-mail',
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

