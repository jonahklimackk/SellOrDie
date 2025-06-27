<?php namespace App\Listeners;

use Spark\Events\SubscriptionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrackAffiliateCommission implements ShouldQueue
{
    public function handle(SubscriptionCreated $event)
    {
        $user         = $event->billable;
        $subscription = $event->subscription;

        logger('TrackAffiliateCommission');

        // 2) Credit the affiliate
        $referrerId = Cookie::get('referrer_id');
        $campaign   = Cookie::get('affiliate_campaign');

        if ($referrerId) {
            AffiliateSale::create([
                'referrer_id' => $referrerId,
                'buyer_id'    => $buyer->id,
                'campaign'    => $campaign,
                'product'     => $product,
                'amount'      => $amount,
            ]);

            AffiliateService::handleSale($buyer, $amount);
        }        


        

        // 1) Look up who referred $user (your affiliate table)
        // 2) Calculate commission based on $subscription->plan->price
        // 3) Credit the affiliate
        // 4) Fire any further events/notifications


    }
}
