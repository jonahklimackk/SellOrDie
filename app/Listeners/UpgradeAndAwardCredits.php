<?php

namespace App\Listeners;

use Spark\Events\SubscriptionCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UpgradeAndAwardCredits
{
    /**
     * Handle the SubscriptionCreated event.
     *
     * @param  \Spark\Events\SubscriptionCreated  $event
     * @return void
     */
    public function handle(SubscriptionCreated $event)
    {
        // 1) Grab the user and their new subscription
        $user         = $event->billable;
        $subscription = $event->subscription;

        // 2) Figure out which Stripe Price ID they just bought
        $priceId = $subscription->stripe_price
            ?? $subscription->stripe_plan
            ?? optional($subscription->asStripeSubscription()
                     ->items
                     ->data[0]
                     ->price)->id;

        if (! $priceId) {
            Log::warning("SubscriptionCreated: No price ID found on subscription");
            return;
        }

        // 3) Load your Spark plans
        $plans = config('spark.billables.user.plans', []);

        // 4) Match that price ID to one of your plans
        $matched = collect($plans)->first(function($plan) use ($priceId) {
            return (
                (isset($plan['monthly_id']) && $plan['monthly_id'] === $priceId)
                || (isset($plan['yearly_id'])  && $plan['yearly_id']  === $priceId)
            );
        });

        if (! $matched) {
            Log::warning("SubscriptionCreated: Unrecognized price ID {$priceId}");
            return;
        }

        // 5) Infer the tier slug from the plan name
        //    e.g. "Lightweight" → "lightweight"
        $tier = Str::slug($matched['name']);

        if (! in_array($tier, ['lightweight', 'heavyweight'], true)) {
            Log::warning("SubscriptionCreated: Could not infer tier from plan name “{$matched['name']}”");
            return;
        }

        // 6) Upgrade the user
        $user->assignStatus($tier);

        // 7) Award purchase credits
        //    Reads config('credits.purchase.lightweight') or ->heavyweight
        $credits = config("credits.purchase.{$tier}", 0);

        if ($credits > 0) {
            // Assumes you have a `credits` column on users
            $user->increment('credits', $credits);
            Log::info("SubscriptionCreated: Awarded {$credits} credits to user {$user->id} for {$tier} purchase");
        }
    }
}
