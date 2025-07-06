<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CreditService
{
    /**
     * Award credits for an action to the actor—and, if configured,
     * automatically climb and credit uplines.
     */
    public static function handleAction(User $actor, string $action, array $metadata = []): int
    {
        Log::debug('[CreditService] handleAction start', compact('actor','action','metadata'));

        return DB::transaction(function() use ($actor, $action, $metadata) {
            $actionsConfig = config('credits.actions', []);

            // 1) Actor’s own credits
            $amount = static::resolveActionAmount($actor, $action, $actionsConfig);
            Log::debug('[CreditService] resolved actor amount', ['amount'=>$amount]);

            if ($amount > 0) {
                $actor->credits()->create([
                    'amount'   => $amount,
                    'type'     => $action,
                    'metadata' => $metadata,
                ]);

                // update running-balance if you have that column
                if (isset($actor->credits_balance)) {
                    $actor->increment('credits_balance', $amount);
                }

                Log::debug('[CreditService] actor credit created & balance updated', ['amount'=>$amount]);
            }

            // 2) Upline credits
            $downlineKey = "downline_{$action}";
            $levelsCfg   = config("credits.{$downlineKey}_levels", []);

            if (! empty($levelsCfg)) {
                $base = config("credits.{$downlineKey}", 0);
                $current = $actor;

                foreach (range(1, count($levelsCfg)) as $level) {
                    $referrer = $current->referrer;
                    if (! $referrer) break;

                    $points = Arr::get($levelsCfg, $level, $base);
                    if ($points > 0) {
                        $referrer->credits()->create([
                            'amount'   => $points,
                            'type'     => $downlineKey,
                            'metadata' => array_merge($metadata, ['level'=>$level]),
                        ]);
                        if (isset($referrer->credits_balance)) {
                            $referrer->increment('credits_balance', $points);
                        }
                        Log::debug("[CreditService] upline level {$level} credited & balance updated", ['points'=>$points]);
                    }

                    $current = $referrer;
                }
            }

            Log::debug('[CreditService] handleAction complete', ['action'=>$action,'amount'=>$amount]);
            return $amount;
        });
    }

    /**
     * Subtract (charge) a flat amount of credits from a user.
     */
    public static function subtractCredits(User $user, int $amount, string $type = 'display_ad', array $metadata = []): int
    {
        $deduction = -abs($amount);

        return DB::transaction(function() use ($user, $deduction, $type, $metadata) {
            $user->credits()->create([
                'amount'   => $deduction,
                'type'     => $type,
                'metadata' => $metadata,
            ]);

            if (isset($user->credits_balance)) {
                $user->decrement('credits_balance', abs($deduction));
            }

            Log::debug('[CreditService] subtractCredits applied', compact('deduction','type'));
            return $deduction;
        });
    }

    /**
     * Resolve how many credits an action is worth.
     */
    protected static function resolveActionAmount(User $user, string $action, array $actionsConfig): int
    {
        $cfg = Arr::get($actionsConfig, $action);

        if (is_int($cfg)) {
            return $cfg;
        }

        if (is_array($cfg)) {
            $tierCfg = Arr::get($cfg, strtolower($user->membership_tier), []);
            if (isset($tierCfg['min'], $tierCfg['max'])) {
                $rand = rand($tierCfg['min'], $tierCfg['max']);
                Log::debug('[CreditService] randomized tiered amount', ['rand'=>$rand]);
                return $rand;
            }
        }

        return 0;
    }

    /**
     * Get the user’s current credit balance.
     * Falls back to summing the log if no `credits_balance` column exists.
     */
    public static function getCurrentBalance(User $user): int
    {
        if (isset($user->credits_balance)) {
            return $user->credits_balance;
        }

        return (int) $user->credits()->sum('amount');
    }


    /**
 * Recompute and sync a single user’s running balance
 * by summing their entries in the credits table.
 *
 * @param  \App\Models\User  $user
 * @return int               The new balance
 */
    public static function syncUserBalance(User $user): int
    {
        // 1) Sum all credit log entries
        $balance = (int) $user->credits()->sum('amount');

        // 2) Update the running‐balance column
        $user->update(['credits_balance' => $balance]);
        return $balance;
    }


    /**
 * Manually set a user’s credit balance to an absolute value,
 * logging the difference as an admin adjustment.
 *
 * @param  User    $user
 * @param  int     $newBalance   The target balance you want the user to have.
 * @param  string  $description  (optional) e.g. 'Refunded mistaken charge'
 * @return int                  The delta applied (newBalance – oldBalance)
 */
    public static function adminAdjust(User $user, int $newBalance, string $description = null): int
    {
        return DB::transaction(function() use ($user, $newBalance, $description) {
        // 1) figure out current
            $current = static::getCurrentBalance($user);

        // 2) compute delta
            $delta = $newBalance - $current;
            if ($delta === 0) {
            return 0; // no change needed
        }

        // 3) log the adjustment
        $user->credits()->create([
            'amount'      => $delta,
            'type'        => 'admin_adjust',
            'description' => $description,
        ]);

        // 4) update running balance if present
        if (isset($user->credits_balance)) {
            // for positive delta, increment; for negative, decrement
            if ($delta > 0) {
                $user->increment('credits_balance', $delta);
            } else {
                $user->decrement('credits_balance', abs($delta));
            }
        }

        return $delta;
    });
    }


    /**
     * Get the total credits earned by $user *today*.
     */
    public static function getTodaysCredits(User $user): int
    {
        return (int) $user->credits()
        ->whereDate('created_at', Carbon::today())
        ->sum('amount');
    }

/**
 * Get the number of “vote” actions credited to $user *today*.
 */
public static function getTodaysVotes(User $user): int
{
    return $user->credits()
    ->where('type', 'vote')
    ->whereDate('created_at', Carbon::today())
    ->count();
}
    /**
     * Combined helper: returns both in one array.
     */
    public static function getTodayStats(User $user): array
    {
        return [
            'credits' => static::getTodaysCredits($user),
            'votes'   => static::getTodaysVotes($user),
        ];
    }    

}
