<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AffiliateClick;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        // 1) Grab the affiliate cookie(s)
        $referrerId = $request->cookie('referrer_id');
        $campaign   = $request->cookie('affiliate_campaign');
        $visitorToken = $request->cookie('visitor_token');

        // 2) If this visitor is “tainted,” you can:
        //   • pass the data into the view
        //   • record a page‐view click for deeper analytics
        if ($referrerId) {
            $referrer = User::find($referrerId);

            // optional: log each hit to home as a pageview
            AffiliateClick::create([
                'referrer_id'   => $referrerId,
                'visitor_token' => $visitorToken,
                'campaign'      => $campaign,
                'ip'            => $request->ip(),
                'type'          => 'pageview',
            ]);

            // send into the blade so you can show a “Welcome, you came from X” banner,
            // or prefill the sign‐up, etc.
            return view('sales.index', compact('referrer', 'campaign'));
        }

        // 3) no affiliate cookie? just show the normal home page
        return view('sales.index');
    }
}
