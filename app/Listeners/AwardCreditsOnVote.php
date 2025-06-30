<?php

namespace App\Listeners;

use App\Events\AdVoted;
use App\Services\CreditService;

class AwardCreditsOnVote
{
// e.g. in AwardDownlineVoteCredit listener:

    public function handle(VoteCreated $event)
    {
        /** @var \App\Services\CreditService $credits */
        $credits = resolve(\App\Services\CreditService::class);

    // 1) Award the voter’s own “vote” credits
        $credits->handleAction(
            $event->vote->user,
            'vote',
            ['ad_id' => $event->vote->ad_id]
        );

    // 2) Award uplines their downline-vote credits
        $credits->handleAction(
            $event->vote->user,
            'downline_vote',
            ['ad_id' => $event->vote->ad_id]
        );
    }

}
