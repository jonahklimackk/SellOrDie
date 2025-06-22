<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class TeamInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;
    public $affiliateLink;
    public $acceptUrl;

    public function __construct($invitation, $affiliateLink)
    {
        $this->invitation    = $invitation;
        $this->affiliateLink = $affiliateLink;

        // replicate Jetstream’s default signed accept-invitation URL
        $this->acceptUrl = URL::temporarySignedRoute(
            // the route Jetstream registers for “Accept Invitation”
            'team-invitations.accept',  
            // by default 7 days, adjust if you’ve overridden Jetstream’s expiration
            Carbon::now()->addDays(7),  
            // the route parameter name => invitation ID
            ['invitation' => $invitation->id]  
        );
        // :contentReference[oaicite:0]{index=0}

        \Log::info('TeamInvitation ctor', [
            'inv'  => $this->invitation->id,
            'link' => $this->affiliateLink,
            'url'  => $this->acceptUrl,
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You\'ve been challenged to a Fight!',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.team-invitation',
            with: [
                'invitation'    => $this->invitation,
                'affiliateLink' => $this->affiliateLink,
                'acceptUrl'     => $this->acceptUrl,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
