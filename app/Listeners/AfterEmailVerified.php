<?php

namespace App\Listeners;

use Cookie;
use App\Models\User;
use App\Models\Campaigns;
use App\Helpers\AffiliateTracker;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;

class AfterEmailVerified implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(Verified $event)
    {
        $user = $event->user;
        $sponsor = User::fetchSponsor($user);
        $campaignName=Cookie::get('campaign');
        $campaign = Campaigns::where('affiliate_id', $sponsor->id)->where('value',$campaignName)->get()->first();        
        if ($campaign)
            AffiliateTracker::recordConfirm($campaign->id);     

        logger('email was verified');        
        logger(Cookie::get('campaign'));


    }
}