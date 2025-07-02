<?php

namespace App\Services;

use App\Models\AffiliateSale;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class AffiliateService
{
    /**
     * Calculate & persist commission for a given sale.
     *
     * @param  \App\Models\AffiliateSale  $sale
     * @return float  The commission amount earned
     */
    public static function handleCommissionForSale(AffiliateSale $sale): float
    {
        Log::info("AffiliateService::handleCommissionForSale start – sale_id={$sale->id}");

        // 1) Grab the referrer user
        $referrer = $sale->referrer;
        if (! $referrer) {
            Log::warning("AffiliateService::handleCommissionForSale exiting – no referrer for sale_id={$sale->id}");
            return 0;
        }
        Log::info("AffiliateService::handleCommissionForSale found referrer_id={$referrer->id}");

        // 2) Determine rate & compute commission
        $tier       = $referrer->membership_tier;
        $rate       = Config::get("affiliate.tiers.{$tier}.commission", 0);
        $commission = round($sale->amount * $rate, 2);
        Log::info("AffiliateService::handleCommissionForSale computed – tier={$tier}, rate={$rate}, commission={$commission}");

        // 3) Update the sale record
        $sale->update([
            'commission' => $commission,
        ]);
        Log::info("AffiliateService::handleCommissionForSale updated sale_id={$sale->id} with commission={$commission}");

        // 4) (Optional) bump an on‐site balance
        // $referrer->increment('affiliate_balance', $commission);
        // Log::info("AffiliateService::handleCommissionForSale bumped affiliate_balance by {$commission} for user_id={$referrer->id}");

        Log::info("AffiliateService::handleCommissionForSale complete – returning {$commission}");
        return $commission;
    }
}
