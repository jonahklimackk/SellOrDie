<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\AffiliateSale;

class DownlineController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Grab your tier’s commission rate
        $rate = Config::get("affiliate.tiers.{$user->membership_tier}.commission", 0);

        // Eager-load one level of referrals (you could recurse deeper if you like)
        $referrals = $user->referrals()->with('referrals')->get();

        // Build a simple data structure for the view
        $referralData = $referrals->map(function($referral) use ($user, $rate) {
            // All sales where the current user earned a commission from this referral
            $sales = AffiliateSale::where('referrer_id', $user->id)
                        ->where('buyer_id',    $referral->id)
                        ->get();

            // Total commission from this person
            $totalCommission = $sales->sum(fn($sale) => $sale->amount * $rate);

            return [
                'user'            => $referral,
                'sales'           => $sales,
                'totalCommission' => $totalCommission,
            ];
        });

        return view('downline', compact('referralData'));
    }
}
