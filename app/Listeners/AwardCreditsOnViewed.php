<?php

namespace App\Listeners;

use App\Events\AdViewed;
use App\Services\CreditService;

class AwardCreditsOnViewed
{
    public function handle(AdViewed $event)
    {
        CreditService::awardBaseAndMatrix(
            $event->user->id,
            'ad_view',
            "Viewed ad"
        );
    }
}
