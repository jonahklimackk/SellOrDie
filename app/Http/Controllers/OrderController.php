<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\AffiliateSale;
use App\Services\AffiliateService;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Str;
use Laravel\Cashier\Subscription; // <-- if you need to refer to Cashier models

class OrderController extends Controller
{
    /**
     * Record both the Or AffiliateSale (if applicable).
     */
    protected function recordSale(Request $request, string $product)
    {
        $sessionId = $request->query('checkout_session_id')
        ?? abort(400, 'Missing checkout_session_id');

        // If we’ve already processed this session, just reload success
        if (Order::where('stripe_session_id', $sessionId)->exists()) {
            return $this->showAlreadyProcessed($sessionId, $product);
        }


        Stripe::setApiKey(config('services.stripe.secret'));
        $session = StripeSession::retrieve($sessionId);

        $buyer = Auth::user() 
        ?? abort(403, 'You must be logged in to complete this purchase.');

        $amount = $session->amount_total / 100;

        // 1) Persist the order
        Order::create([
            'buyer_id'          => $buyer->id,
            'stripe_session_id' => $sessionId,
            'product'           => $product,
            'amount'            => $amount,
        ]);

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

        return view('orders.success', compact('session', 'product'));
    }

    public function lightweightMonthly(Request $r)   { return $this->recordSale($r, 'Lightweight Monthly'); }
    public function lightweightYearly(Request $r)    { return $this->recordSale($r, 'Lightweight Yearly'); }
    public function heavyweightMonthly(Request $r)   { return $this->recordSale($r, 'Heavyweight Monthly'); }
    public function heavyweightYearly(Request $r)    { return $this->recordSale($r, 'Heavyweight Yearly'); }

    /**
     * Show the authenticated user their own orders.
     */
    public function myOrders()
    {
        $orders = Order::where('buyer_id', Auth::id())
        ->latest()
        ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the affiliate all sales they’ve referred.
     */
    public function affiliateSales()
    {
        $sales = AffiliateSale::with('buyer')
        ->where('referrer_id', Auth::id())
        ->latest()
        ->get();

        return view('affiliate.sales', compact('sales'));
    }


    /**
     * Kick off a Stripe Checkout Session for a subscription.
     */
    public function subscribe(Request $request, string $planKey)
    {
        $plans = config('billing.plans');

        if (! array_key_exists($planKey, $plans)) {
            abort(404, "Unknown plan “{$planKey}.”");
        }

        // Create a subscription Checkout Session
        return $request->user()
        ->newSubscription('default', $plans[$planKey])
        ->checkout([
            'success_url' => route('subscriptions.success', ['planKey' => $planKey])
            . '?checkout_session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('subscriptions.cancel'),
        ]);
    }

    /**
     * Handle the redirect back from Stripe on success.
     */
    public function subscriptionSuccess(Request $request, string $planKey)
    {
        // Turn planKey into a human-friendly product name:
        $productName = Str::title(str_replace('_', ' ', $planKey));

        // Re-use your recordSale flow:
        return $this->recordSale($request, $productName);
    }

    /**
     * Handle the redirect back from Stripe on cancel.
     */
    public function subscriptionCancel()
    {
        // You can show a “sorry you cancelled” page or redirect:
        return view('orders.cancel');
    }    




    /**
 * Show the success page when a refresh hits an already-processed session.
 */
    protected function showAlreadyProcessed(string $sessionId, string $product)
    {
    // You could re-fetch the session if you like, or pass null
        return view('orders.success', [
            'session' => null,
            'product' => $product,
            'alreadyProcessed' => true,
        ]);
    }
}

