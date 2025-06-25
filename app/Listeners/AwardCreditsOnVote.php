<?php

namespace App\Listeners;

use App\Events\AdVoted;
use App\Services\CreditService;

class AwardCreditsOnVote
{
    public function handle(AdVoted $event)
    {
        CreditService::awardBaseAndMatrix(
            $event->user->id,
            'vote',
            "Judged a fight."
        );
    }
}
