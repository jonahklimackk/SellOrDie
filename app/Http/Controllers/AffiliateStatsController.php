<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\AffiliateSale;

class AffiliateStatsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Commission rate for current user tier
        $rate = Config::get("affiliate.tiers.{$user->membership_tier}.commission", 0);

        // Fetch all direct‐referral sales with their buyers
        $sales = AffiliateSale::with('buyer')
                    ->where('referrer_id', $user->id)
                    ->get();

        // Group by buyer and calculate stats including commissions and details
        $stats = $sales
            ->groupBy('buyer_id')
            ->map(function($sales) use ($rate) {
                $buyer           = $sales->first()->buyer;
                $totalCount      = $sales->count();
                $totalAmount     = $sales->sum('amount');
                $totalCommission = $sales->sum(fn($sale) => $sale->amount * $rate);

                // Prepare sale details for display
                $details = $sales->map(fn($sale) => sprintf(
                    '$%s on %s: Commission $%s',
                    number_format($sale->amount, 2),
                    $sale->created_at->format('M j, Y'),
                    number_format($sale->amount * $rate, 2)
                ))->toArray();

                return (object)[
                    'buyer'           => $buyer,
                    'count'           => $totalCount,
                    'totalAmount'     => $totalAmount,
                    'totalCommission' => $totalCommission,
                    'details'         => $details,
                ];
            })
            ->values();

        return view('affiliate-stats.index', compact('stats'));
    }
}
