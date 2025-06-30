<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Referral;
use App\Models\AffiliateSale;
use App\Models\AffiliateClick;

class AffiliateController extends Controller
{
    /**
     * Track a click on /aff/{username}/{campaign?}
     */
    public function track(Request $request, string $username, string $campaign = null)
    {
        // try to find a user with that username
        $referrer = User::where('username', $username)->first();

        // if no such user, send them to your /aff landing page (or home)
        if (! $referrer) {
            return redirect()->route('affiliate.landing');
        }

        // same cookie + click logic as before
        $visitorToken = $request->cookie('visitor_token') ?? Str::uuid()->toString();

        cookie()->queue('referrer_id',        $referrer->id,  60*24*30);
        cookie()->queue('affiliate_campaign', $campaign,      60*24*30);
        cookie()->queue('visitor_token',      $visitorToken,  60*24*30);

        AffiliateClick::create([
            'referrer_id'   => $referrer->id,
            'visitor_token' => $visitorToken,
            'campaign'      => $campaign,
            'ip'            => $request->ip(),
        ]);

        return redirect()->route('home');
    }

    /**
     * Landing page for /aff
     */
    public function landing()
    {
        // could also return a view('affiliate.landing')
        return redirect()->route('home');
    }

    /**
     * Affiliate Dashboard or Welcome page
     */
    public function dashboard()
    {
        return view('affiliate.dashboard');

    }


    /**
     * 
     */
    public function campaigns()
    {
        $referrerId = auth()->id();

        // 1) Clicks per campaign
        $clicks = AffiliateClick::where('referrer_id', $referrerId)
        ->selectRaw('COALESCE(campaign, "") as campaign, COUNT(*) as total')
        ->groupBy('campaign')
        ->get();

        // 2) Joins (referrals) per campaign
        $joins = Referral::where('referrer_id', $referrerId)
        ->selectRaw('COALESCE(campaign, "") as campaign, COUNT(*) as total')
        ->groupBy('campaign')
        ->get();

        // 3) Sales per campaign (+ revenue)
        $sales = AffiliateSale::where('referrer_id', $referrerId)
        ->selectRaw('
            COALESCE(campaign, "") as campaign,
            COUNT(*) as total,
            SUM(amount) as revenue
            ')
        ->groupBy('campaign')
        ->get();

        // 4) Collect all unique campaigns
        $allCampaigns = $clicks->pluck('campaign')
        ->merge($joins->pluck('campaign'))
        ->merge($sales->pluck('campaign'))
        ->unique();

        // 5) Build a unified metrics array
        $metrics = $allCampaigns->map(function($campaign) use ($clicks, $joins, $sales) {
            return (object) [
                'campaign' => $campaign === '' ? null : $campaign,
                'clicks'   => ($clicks->firstWhere('campaign', $campaign)->total ?? 0),
                'joins'    => ($joins->firstWhere('campaign', $campaign)->total ?? 0),
                'sales'    => ($sales->firstWhere('campaign', $campaign)->total ?? 0),
                'revenue'  => ($sales->firstWhere('campaign', $campaign)->revenue ?? 0),
            ];
        });

        return view('affiliate.campaigns', compact('metrics'));
    }



    /**
     * 
     */
    public function marketingTools()
    {
        return view('affiliate.marketing-tools');

    }
}

