<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    /**
     * Kick off a new Stripe Checkout Session for the given plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $planKey
     */
    public function checkout(Request $request, string $planKey)
    {
        $plans = config('billing.plans');

        // ❌ remove this—it only checks request input, not the route parameter
        // $request->validate([
        //     'planKey' => ['required', Rule::in(array_keys($plans))],
        // ]);

        // ✔️ manually ensure the route‐param is one of your keys
        if (! array_key_exists($planKey, $plans)) {
            abort(404);
        }

        $priceId = $plans[$planKey];

        return $request->user()
            ->newSubscription('default', $priceId)
            ->checkout([
                'success_url' => route('subscriptions.success'),
                'cancel_url'  => route('subscriptions.cancel'),
            ]);
    }    

    /**
     * Show a “Thank you” page after successful subscription.
     */
    public function success()
    {
        return view('subscriptions.success');
    }

    /**
     * Show a “You cancelled” page if they back out.
     */
    public function cancel()
    {
        return view('subscriptions.cancel');
    }

    /**
     * Redirect to Stripe’s Customer Portal for self-service.
     */
    public function portal(Request $request)
    {
        return $request->user()
                       ->redirectToBillingPortal(route('dashboard'));
    }
}
