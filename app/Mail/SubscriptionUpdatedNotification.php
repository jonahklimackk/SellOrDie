<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class SubscriptionUpdatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $oldPrice;
    public $newPrice;
    public $oldPlanName;
    public $newPlanName;

    /**
     * @param  \App\Models\User  $user
     * @param  string|null       $oldPrice
     * @param  string|null       $newPrice
     * @param  string            $oldPlanName
     * @param  string            $newPlanName
     */
    public function __construct($user, $oldPrice, $newPrice, $oldPlanName, $newPlanName)
    {
        $this->user        = $user;
        $this->oldPrice    = $oldPrice;
        $this->newPrice    = $newPrice;
        $this->oldPlanName = $oldPlanName;
        $this->newPlanName = $newPlanName;
    }

    public function build()
    {
        return $this
            ->to('jonahklimackk@gmail.com')
            ->subject("🔔 Subscription Updated for User #{$this->user->id}")
            ->view('emails.subscription-updated');
    }
}
