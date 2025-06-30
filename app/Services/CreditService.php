<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class CreditService
{
    /**
     * Award credits for an action to the actor—and, if configured,
     * automatically climb and credit uplines.
     *
     * @param  User   $actor     The user who performed the action.
     * @param  string $action    The action key, e.g. 'vote', 'login', etc.
     * @param  array  $metadata  Any extra data (like ['ad_id'=>123]).
     * @return int               The number of credits awarded to the actor.
     */
    public static function handleAction(User $actor, string $action, array $metadata = []): int
    {
        Log::debug('[CreditService] handleAction start', compact('actor', 'action', 'metadata'));

        $actionsConfig = config('credits.actions', []);

        // 1) Actor’s own credits
        $amount = static::resolveActionAmount($actor, $action, $actionsConfig);
        Log::debug('[CreditService] resolved actor amount', compact('amount'));

        if ($amount > 0) {
            $actor->credits()->create([
                'amount'   => $amount,
                'type'     => $action,
                'metadata' => $metadata,
            ]);
            Log::debug('[CreditService] actor credit created', compact('amount'));
        } else {
            Log::debug('[CreditService] no actor credit to create (zero amount)');
        }

        // 2) Upline credits if downline config exists
        $downlineKey = "downline_{$action}";
        $levelsCfg   = config("credits.{$downlineKey}_levels", []);

        \Log::debug('[CreditService] downline levels for signup', [
            'key'      => "credits.downline_signup_levels",
            'levelsCfg'=> config('credits.downline_signup_levels'),
            ]);

            if (! empty($levelsCfg)) {
                $baseAmount = config("credits.{$downlineKey}", 0);
                $current    = $actor;

                foreach (range(1, count($levelsCfg)) as $level) {
                    $referrer = $current->referrer;
                    if (! $referrer) {
                        Log::debug("[CreditService] no referrer at level {$level}, stopping uplines loop");
                        break;
                    }

                    $points = Arr::get($levelsCfg, $level, $baseAmount);
                    if ($points > 0) {
                        $referrer->credits()->create([
                            'amount'   => $points,
                            'type'     => $downlineKey,
                            'metadata' => array_merge($metadata, ['level' => $level]),
                        ]);
                        Log::debug("[CreditService] upline credit created", compact('level', 'points'));
                    } else {
                        Log::debug("[CreditService] skipping upline level {$level} (zero points)");
                    }

                    $current = $referrer;
                }
            }

            Log::debug('[CreditService] handleAction end, actor awarded', compact('amount'));

            return $amount;
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
            $tier    = strtolower($user->membership_tier);
            $tierCfg = Arr::get($cfg, $tier, []);
            if (isset($tierCfg['min'], $tierCfg['max'])) {
                $rand = rand($tierCfg['min'], $tierCfg['max']);
                Log::debug('[CreditService] randomized tiered amount', compact('rand'));
                return $rand;
            }
        }

        return 0;
    }
}
