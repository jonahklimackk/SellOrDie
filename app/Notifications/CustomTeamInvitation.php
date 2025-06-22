<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Laravel\Jetstream\Notifications\TeamInvitation as BaseInvitation;

class CustomTeamInvitation extends BaseInvitation
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("You've been challenged to a Fight!")
            ->markdown('vendor.jetstream.mail.team-invitation', [
                'invitation' => $this->invitation,
            ]);
    }
}
