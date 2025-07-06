<?php

namespace App\Listeners;

use Spark\Events\SubscriptionUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\AffiliateSale;
use App\Mail\SubscriptionUpdatedNotification;
use Illuminate\Support\Facades\Mail;

class RefundAffiliateOnSubscriptionChange
{
    /**
     * Handle a plan change (upgrade/downgrade).
     *
     * @param  \Spark\Events\SubscriptionUpdated  $event
     * @return void
     */
    public function handle(SubscriptionUpdated $event)
    {
        $user         = $event->billable;
        $subscription = $event->subscription;

        Mail::to('jonahklimackk@gmail.com')
        ->send(new \App\Mail\SubscriptionUpdatedNotification(
          $user,
          $subscription->getOriginal('stripe_price'),
          $subscription->stripe_price,
              // you can fill in plan names here if you like, or pass null
          null,
          null
      ));        

        Log::info('RefundListener: start handling SubscriptionUpdated for user ' . $user->id);

        // 0) Skip the automatic “activation” write (when neither stripe_price nor stripe_plan was set before)
        $origPrice = $subscription->getOriginal('stripe_price');
        $origPlan  = $subscription->getOriginal('stripe_plan');
        if (is_null($origPrice) && is_null($origPlan)) {
            Log::info('RefundListener: skipping initial activation (no original price or plan)');
            return;
        }
        Log::info("RefundListener: passed initial check (origPrice={$origPrice}, origPlan={$origPlan})");

        // 1) Grab old vs. new Stripe price IDs
        $oldPrice = $origPrice
        ?? $subscription->getOriginal('stripe_plan');
        $newPrice = $subscription->stripe_price
        ?? $subscription->stripe_plan;
        Log::info("RefundListener: Old price ID = {$oldPrice}, New price ID = {$newPrice}");

        // If nothing changed, bail out
        if ($oldPrice === $newPrice) {
            Log::info('RefundListener: price IDs identical, no action taken');
            return;
        }

        // 2) Load and map your Spark plans (monthly_id/yearly_id → plan name)
        $plans = config('spark.billables.user.plans', []);
        Log::info('RefundListener: loaded ' . count($plans) . ' plans from config');

        $priceMap = collect($plans)
        ->flatMap(function($plan) {
            return [
                ($plan['monthly_id'] ?? null) => $plan['name'],
                ($plan['yearly_id']  ?? null) => $plan['name'],
            ];
        })
        ->filter();
        Log::info('RefundListener: built priceMap with ' . count($priceMap) . ' entries');

        if (! isset($priceMap[$oldPrice], $priceMap[$newPrice])) {
            Log::warning("RefundListener: unknown prices [old: {$oldPrice}] [new: {$newPrice}], aborting");
            return;
        }

        $oldPlanName = $priceMap[$oldPrice];
        $newPlanName = $priceMap[$newPrice];
        Log::info("RefundListener: matched old plan '{$oldPlanName}', new plan '{$newPlanName}'");

        // 3) Infer tiers from the plan names (lightweight vs. heavyweight)
        $oldTier = Str::contains(Str::slug($oldPlanName), 'lightweight') ? 'lightweight' : 'heavyweight';
        $newTier = Str::contains(Str::slug($newPlanName), 'lightweight') ? 'lightweight' : 'heavyweight';
        Log::info("RefundListener: inferred old tier '{$oldTier}', new tier '{$newTier}'");

        // 4) If this is a downgrade from heavyweight → lightweight, refund commission
        if ($oldTier === 'heavyweight' && $newTier === 'lightweight') {
            Log::info("RefundListener: detected downgrade for user {$user->id}");

            $sale = AffiliateSale::where('buyer_id', $user->id)
            ->where('refunded', false)
            ->latest()
            ->first();

            if (! $sale) {
                Log::warning("RefundListener: no AffiliateSale found for user {$user->id} to refund");
                return;
            }

            Log::info("RefundListener: found AffiliateSale #{$sale->id}, marking refunded");

            $sale->refunded      = true;
            $sale->refund_amount = $sale->amount; // full refund; adjust logic here if needed
            $sale->refunded_at   = now();
            $sale->save();

            Log::info("RefundListener: AffiliateSale #{$sale->id} marked refunded (\${$sale->refund_amount})");
        } else {
            Log::info("RefundListener: no downgrade detected, no refund processed");
        }
    }


}
