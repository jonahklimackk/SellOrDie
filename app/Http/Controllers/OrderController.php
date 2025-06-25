<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\AffiliateSale;
use App\Services\AffiliateService;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class OrderController extends Controller
{
    /**
     * Central logic for recording an affiliate-credited sale.
     */
    protected function recordSale(Request $request, string $product)
    {
        // 1) Grab the session ID that Stripe appended
        $sessionId = $request->query('checkout_session_id');
        if (! $sessionId) {
            abort(400, 'Missing checkout_session_id');
        }

        // 2) Verify session with Stripe
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $session = StripeSession::retrieve($sessionId);
        } catch (\Exception $e) {
            abort(400, 'Invalid Stripe session');
        }

        // 3) Identify the buyer
        $buyer = Auth::user();
        if (! $buyer) {
            abort(403, 'You must be logged in to complete this purchase.');
        }

        // 4) Pull affiliate cookies
        $referrerId = Cookie::get('referrer_id');
        $campaign   = Cookie::get('affiliate_campaign');

        // 5) Record the sale & credit the affiliate if present
        if ($referrerId) {
            AffiliateSale::create([
                'referrer_id' => $referrerId,
                'buyer_id'    => $buyer->id,
                'campaign'    => $campaign,
                'amount'      => $session->amount_total / 100,
            ]);

            // optional: handle your direct-payout logic
            AffiliateService::handleSale($buyer, $session->amount_total / 100);
        }

        // 6) Show a thank-you page
        return view('orders.success', [
            'session' => $session,
            'product' => $product,
        ]);
    }

    public function lightweightMonthly(Request $request)
    {
        return $this->recordSale($request, 'Lightweight Monthly');
    }

    public function lightweightYearly(Request $request)
    {
        return $this->recordSale($request, 'Lightweight Yearly');
    }

    public function heavyweightMonthly(Request $request)
    {
        return $this->recordSale($request, 'Heavyweight Monthly');
    }

    public function heavyweightYearly(Request $request)
    {
        return $this->recordSale($request, 'Heavyweight Yearly');
    }
}
