<?php

namespace App\Services;

use App\Models\Credit;
use App\Models\MatrixPosition;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class CreditService
{
    public static function awardBaseAndMatrix(int $userId, string $type, string $description = ''): int
    {
        $user = User::find($userId);
        if (! $user) {
            Log::error("CreditService: user {$userId} not found");
            return 0;
        }

        $tier         = $user->membership_tier;
        $actionConfig = Config::get("credits.actions.{$type}");

        // Determine base credits
        $base = 0;
        if (is_array($actionConfig)) {
            $cfg  = $actionConfig[$tier] ?? $actionConfig['amateur'] ?? 0;
            if (is_array($cfg) && isset($cfg['min'], $cfg['max'])) {
                $base = random_int($cfg['min'], $cfg['max']);
            } else {
                $base = (int) $cfg;
            }
        } elseif (is_numeric($actionConfig)) {
            $base = (int) $actionConfig;
        }

        Log::info("CreditService: action={$type}, tier={$tier}, base={$base}");

        // Create base credit
        if ($base > 0) {
            $credit = Credit::create([
                'user_id'     => $userId,
                'type'        => $type,
                'amount'      => $base,
                'description' => $description,
            ]);
            Log::info("CreditService: created credit #{$credit->id}");
        }

        // Matrix spillover
        $pos    = MatrixPosition::where('user_id', $userId)->first();
        $levels = Config::get('credits.matrix_levels', 0);

        for ($level = 1; $pos && $pos->parent && $level <= $levels; $level++) {
            $pos   = $pos->parent;
            $bonus = Config::get("credits.matrix_bonus.{$level}", 0);

            if ($bonus > 0) {
                $spill = "{$type}_spillover";
                $credit = Credit::create([
                    'user_id'     => $pos->user_id,
                    'type'        => $spill,
                    'amount'      => $bonus,
                    'description' => "Level-{$level} bonus for {$type} by user #{$userId}",
                ]);
                Log::info("CreditService: spillover credit #{$credit->id} to user {$pos->user_id}");
            }
        }

        return $base;
    }
}
