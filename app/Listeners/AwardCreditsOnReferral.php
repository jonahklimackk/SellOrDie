<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Services\CreditService;

class AwardCreditsOnReferral
{
    public function handle(Registered $event)
    {
        // only award if there's a referrer
        if ($refId = $event->user->referral?->referrer_id) {
            CreditService::awardBaseAndMatrix(
                $refId,
                'referral',
                "Referred user #{$event->user->id}"
            );
        }
    }
}
