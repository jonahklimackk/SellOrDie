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

class OrderController extends Controller
{
    /**
     * Record both the Order and the AffiliateSale (if applicable).
     */
    protected function recordSale(Request $request, string $product)
    {
        $sessionId = $request->query('checkout_session_id')
                   ?? abort(400, 'Missing checkout_session_id');

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
}

