<?php

namespace App\Services;

use App\Models\Credit;
use App\Models\MatrixPosition;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class MatrixService
{
    /**
     * Award “ad‐view” credits to the viewer AND spill over credits up the matrix.
     *
     * @param  User  $viewer
     * @param  int   $credits    Number of credits the viewer earned
     * @return void
     */
    public static function processAdView(User $viewer, int $credits): void
    {
        // 1) Ensure viewer has a matrix position
        $position = MatrixPosition::firstOrCreate(
            ['user_id' => $viewer->id],
            ['parent_id' => null, 'position_index' => 1, 'depth' => 0]
        );

        // 2) Give viewer their own credits
        Credit::create([
            'user_id'     => $viewer->id,
            'type'        => 'ad_view',
            'amount'      => $credits,
            'description' => "Earned {$credits} credits for viewing an ad",
        ]);

        // 3) Load spillover rate from config (defaults to 10%)
        $rate = Config::get('matrix.spillover_rate', 0.10);
        $spillCredits = (int) floor($credits * $rate);

        // 4) Spillover up the upline
        $currentPos = $position;
        while ($currentPos->parent_id && $spillCredits > 0) {
            $currentPos = $currentPos->parent()->first();

            if ($currentPos) {
                Credit::create([
                    'user_id'     => $currentPos->user_id,
                    'type'        => 'matrix_earn',
                    'amount'      => $spillCredits,
                    'description' => "Spillover {$spillCredits} credits from downline {$viewer->email}",
                ]);
            }
        }
    }
}
