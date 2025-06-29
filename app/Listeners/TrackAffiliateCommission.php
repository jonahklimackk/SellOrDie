<?php

namespace App\Listeners;

use Spark\Events\SubscriptionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\AffiliateService;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Log;

class TrackAffiliateCommission implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \Spark\Events\SubscriptionCreated  $event
     * @return void
     */
    public function handle(SubscriptionCreated $event)
    {
        $buyer        = $event->billable;
        $subscription = $event->subscription;

        Log::info('TrackAffiliateCommission fired for user_id=' . $buyer->id);

        // Read persisted affiliate info
        $referrerId        = $buyer->referrer_id;
        $affiliateCampaign = $buyer->affiliate_campaign;

        Log::info("Referrer ID on user: {$referrerId}");
        Log::info("Affiliate campaign on user: {$affiliateCampaign}");

        if (! $referrerId) {
            Log::info('No referrer_id set on user, skipping affiliate commission.');
            return;
        }

        // Derive Stripe price ID from subscription record
        $priceId = $subscription->stripe_price;
        if (! $priceId) {
            Log::warning("No stripe_price on subscription_id={$subscription->id}, skipping commission.");
            return;
        }

        // Fetch the Price object from Stripe
        try {
            $stripe = new StripeClient(config('services.stripe.secret'));
            $price  = $stripe->prices->retrieve($priceId);
        } catch (\Throwable $e) {
            Log::error("Failed to retrieve Stripe Price {$priceId}: ".$e->getMessage());
            return;
        }

        // Convert unit_amount (in cents) to dollars
        $amount  = ($price->unit_amount ?? 0) / 100;
        // Use nickname if set, otherwise the product ID
        $product = $price->nickname ?: $price->product;

        Log::info("Derived sale amount \${$amount} from Stripe Price {$priceId}");

        // Delegate to AffiliateService (records sale + commission)
        $commission = AffiliateService::handleSale(
            $buyer,
            $amount,
            $affiliateCampaign,
            $product
        );

        Log::info("Recorded affiliate commission of \${$commission} for referrer_id={$referrerId}");
        Log::info('TrackAffiliateCommission complete.');
    }
}
