<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class TestOrderController extends Controller
{
    public function createSession(Request $request)
    {
        // 1) Set your secret key
        Stripe::setApiKey(config('services.stripe.secret'));
        
        // 2) Create a one-time payment session
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'usd',
                    'product_data' => [
                        'name' => 'Test Product',
                        'description' => 'This is a $1.00 test charge',
                    ],
                    'unit_amount'  => 100, // $1.00 in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('test.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('test.cancel'),
        ]);

        // 3) Redirect user to Stripe Checkout
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');
        // You can retrieve the session to inspect it:
        Stripe::setApiKey(config('services.stripe.secret'));
        $session = StripeSession::retrieve($sessionId);

        // dd($session); // inspect in local
        return view('test.success', ['session' => $session]);
    }

    public function cancel()
    {
        return view('test.cancel');
    }
}
