<?php

namespace App\Services;

use App\Models\Credit;
use App\Models\MatrixPosition;
use Illuminate\Support\Facades\Config;
use App\Models\User;

class CreditService
{
    /**
     * Award base credits (random between min/max or fixed) and propagate matrix bonuses.
     *
     * @param int    $userId      ID of the user performing the action
     * @param string $type        Action type (key in config('credits.actions'))
     * @param string $description Optional description
     * @return int The base credits awarded to the user
     */
    public static function awardBaseAndMatrix(int $userId, string $type, string $description = ''): int
    {
        // 1) Resolve user and tier
        $user = User::find($userId);
        $tier = $user->membership_tier;

        // 2) Pull action config
        $actionConfig = Config::get("credits.actions.{$type}", 0);

        // 3) Determine the base amount
        if (is_array($actionConfig)) {
            // tier-specific range or fixed
            $cfg = $actionConfig[$tier] ?? ($actionConfig['amateur'] ?? 0);
            if (is_array($cfg) && isset($cfg['min'], $cfg['max'])) {
                $base = random_int($cfg['min'], $cfg['max']);
            } else {
                $base = (int) $cfg;
            }
        } elseif (is_numeric($actionConfig)) {
            // single fixed number
            $base = (int) $actionConfig;
        } else {
            $base = 0;
        }

        // 4) Create base credit if any
        if ($base > 0) {
            Credit::create([
                'user_id'     => $userId,
                'type'        => $type,
                'amount'      => $base,
                'description' => $description,
            ]);
        }

        // 5) Propagate spill-over up the binary matrix
        $pos = MatrixPosition::where('user_id', $userId)->first();
        for ($level = 1; $pos && $pos->parent && $level <= Config::get('credits.matrix_levels', 0); $level++) {
            $pos = $pos->parent;
            $bonus = Config::get("credits.matrix_bonus.{$level}", 0);
            if ($bonus > 0) {
                Credit::create([
                    'user_id'     => $pos->user_id,
                    'type'        => "{$type}_spillover",
                    'amount'      => $bonus,
                    'description' => "Level-{$level} bonus for {$type} by user #{$userId}",
                ]);
            }
        }

        // 6) Return base credits awarded
        return $base;
    }
}
