<?php

namespace App\Services;

use App\Models\Credit;
use App\Models\MatrixPosition;
use Illuminate\Support\Facades\Config;
use App\Models\User;

class AffiliateService
{
    // Width of the binary matrix (2 children per parent)
    private const MATRIX_WIDTH = 2;

    // Max depth (root = 0)
    private const MATRIX_DEPTH = 5;

    /**
     * Assign a user into the first available slot in the forced-binary matrix.
     *
     * @param User $user
     * @return MatrixPosition
     * @throws \Exception
     */
    public static function assignMatrixPosition(User $user)
    {
        $queue = MatrixPosition::whereNull('parent_id')->get();

        // If no root exists, create the root position for this user
        if ($queue->isEmpty()) {
            return MatrixPosition::create([
                'user_id'        => $user->id,
                'parent_id'      => null,
                'position_index' => 1,
                'depth'          => 0,
            ]);
        }

        // Breadth-first search for the first open slot
        $index = 0;
        while (isset($queue[$index])) {
            $pos = $queue[$index];

            // Only fill children if we haven't hit max depth
            if ($pos->depth + 1 < self::MATRIX_DEPTH) {
                for ($i = 1; $i <= self::MATRIX_WIDTH; $i++) {
                    $exists = MatrixPosition::where('parent_id', $pos->id)
                                             ->where('position_index', $i)
                                             ->exists();
                    if (! $exists) {
                        return MatrixPosition::create([
                            'user_id'        => $user->id,
                            'parent_id'      => $pos->id,
                            'position_index' => $i,
                            'depth'          => $pos->depth + 1,
                        ]);
                    }
                }
            }

            // Enqueue children for further search
            $children = MatrixPosition::where('parent_id', $pos->id)->get();
            foreach ($children as $child) {
                $queue->push($child);
            }

            $index++;
        }

        throw new \Exception('Matrix is full or maximum depth reached');
    }

    /**
     * Handle a completed sale: credits direct commission based on the referrer's tier.
     *
     * @param User  $buyer      The purchasing user
     * @param float $saleAmount The sale amount in dollars
     * @return void
     */
    public static function handleSale(User $buyer, float $saleAmount): void
    {
        // Identify the referrer from your referrals table
        $referrer = $buyer->referral?->referrer;
        if (! $referrer) {
            return;
        }

        // Determine the referrer's membership tier (amateur, lightweight, heavyweight)
        $tier = $referrer->membership_tier;

        // Look up the commission rate for that tier
        $rate = Config::get("affiliate.tiers.{$tier}.commission", 0);

        // Calculate commission
        $commission = $saleAmount * $rate;

        // Record the credit
        Credit::create([
            'user_id'     => $referrer->id,
            'type'        => 'direct_commission',
            'amount'      => $commission,
            'description' => ucfirst($tier)
                             . " commission ({$rate * 100}% )"
                             . " from sale by {$buyer->email}",
        ]);
    }
}
