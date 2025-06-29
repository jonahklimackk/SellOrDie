<?php

namespace App\Services;

use Log;
use App\Models\Credit;
use App\Models\AffiliateSale;
use App\Models\MatrixPosition;
use Illuminate\Support\Facades\Config;
use App\Models\User;

class AffiliateService
{
    // Width of the binary matrix (2 children per parent)
    private const MATRIX_WIDTH = 5;

    // Max depth (root = 0)
    private const MATRIX_DEPTH = 7;

   /**
    * Assign a user into the first available slot in the forced-binary matrix.
    *
    * @param User $user
    * @return MatrixPosition
    * @throws \Exception
    */
   public static function assignMatrixPosition(User $user)
   {
    logger("AssignMatrixPosition: start for user_id={$user->id}");

    // Load all root positions (those without a parent)
    $queue = MatrixPosition::whereNull('parent_id')->get();
    logger('AssignMatrixPosition: loaded root queue count=' . $queue->count());

    // If no root exists, create the root position for this user
    if ($queue->isEmpty()) {
        logger("AssignMatrixPosition: no root found, creating root for user_id={$user->id}");
        $root = MatrixPosition::create([
            'user_id'        => $user->id,
            'parent_id'      => null,
            'position_index' => 1,
            'depth'          => 0,
        ]);
        logger("AssignMatrixPosition: root created id={$root->id}");
        return $root;
    }

    logger('AssignMatrixPosition: root exists, beginning breadth-first search');

    // Breadth-first search for the first open slot
    $index = 0;
    while (isset($queue[$index])) {
        $pos = $queue[$index];
        logger("AssignMatrixPosition: inspecting position id={$pos->id}, depth={$pos->depth}");

        // Only fill children if we haven't hit max depth
        if ($pos->depth + 1 < self::MATRIX_DEPTH) {
            for ($i = 1; $i <= self::MATRIX_WIDTH; $i++) {
                $exists = MatrixPosition::where('parent_id', $pos->id)
                ->where('position_index', $i)
                ->exists();
                logger("AssignMatrixPosition: checking slot parent_id={$pos->id}, index={$i} – exists=" . ($exists ? 'yes' : 'no'));

                if (! $exists) {
                    logger("AssignMatrixPosition: slot available, creating position for user_id={$user->id} -> parent_id={$pos->id}, index={$i}");
                    $newPos = MatrixPosition::create([
                        'user_id'        => $user->id,
                        'parent_id'      => $pos->id,
                        'position_index' => $i,
                        'depth'          => $pos->depth + 1,
                    ]);
                    logger("AssignMatrixPosition: created position id={$newPos->id}");
                    return $newPos;
                }
            }
        } else {
            logger("AssignMatrixPosition: max depth reached at position id={$pos->id}, depth={$pos->depth}");
        }

        // Enqueue children for further search
        $children = MatrixPosition::where('parent_id', $pos->id)->get();
        logger("AssignMatrixPosition: enqueueing " . $children->count() . " children of pos_id={$pos->id}");
        foreach ($children as $child) {
            $queue->push($child);
        }

        $index++;
    }

    logger('AssignMatrixPosition: no open slot found, matrix full or max depth reached');
    throw new \Exception('Matrix is full or maximum depth reached');
}
    /**
     * Handle a completed sale: record it with commission
     * in affiliate_sales, and optionally bump a user balance.
     *
     * @param  User         $buyer
     * @param  float        $saleAmount
     * @param  string|null  $campaign
     * @param  string|null  $product
     * @return float        The commission amount earned
     */
    public static function handleSale(
        User $buyer,
        float $saleAmount,
        string $campaign = 'default_campaign',
        string $product  = 'default_product'
    ): float {
        Log::info("AffiliateService::handleSale start – buyer_id={$buyer->id}, amount={$saleAmount}");

        // 1) Identify the referrer
        $referrer = $buyer->referrer;
        if (! $referrer) {
            Log::warning("AffiliateService::handleSale exiting – no referrer for buyer_id={$buyer->id}");
            return 0;
        }
        Log::info("AffiliateService::handleSale found referrer_id={$referrer->id}");

        // 2) Lookup rate and calculate
        $tier       = $referrer->membership_tier;
        $rate       = Config::get("affiliate.tiers.{$tier}.commission", 0);
        $commission = round($saleAmount * $rate, 2);
        Log::info("AffiliateService::handleSale computed commission – tier={$tier}, rate={$rate}, commission={$commission}");

        // 3) Record on affiliate_sales
        Log::info("AffiliateService::handleSale creating AffiliateSale record");
        $sale = AffiliateSale::create([
            'referrer_id' => $referrer->id,
            'buyer_id'    => $buyer->id,
            'campaign'    => $campaign,
            'product'     => $product,
            'amount'      => $saleAmount,
            'commission'  => $commission,
        ]);
        Log::info("AffiliateService::handleSale created AffiliateSale id={$sale->id}");

        // 4) (Optional) bump a running balance on the user
        // if you have a column like 'affiliate_balance' on users:
        // $referrer->increment('affiliate_balance', $commission);
        // Log::info("AffiliateService::handleSale bumped affiliate_balance by {$commission} for user_id={$referrer->id}");

        Log::info("AffiliateService::handleSale complete – returning {$commission}");
        return $commission;
    }

}
