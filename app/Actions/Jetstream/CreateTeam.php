<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Events\AddingTeam;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\ValidationException;

class CreateTeam implements CreatesTeams
{
    /**
     * Validate and create a new team for the given user.
     *
     * @param  array<string, string>  $input
     */
public function create(User $user, array $input): Team
{
    Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

    // Count existing owned teams & lookup tier limit
    $ownedCount = $user->ownedTeams()->count();
    $limits     = config('fights.owned_limits', []);
    $tier       = $user->membership_tier;
    $maxAllowed = $limits[$tier] ?? null;

    Validator::make($input, [
        'name' => [
            'required',
            'string',
            'max:100',
            // custom inline rule to enforce per-tier cap
            function ($attribute, $value, $fail) use ($ownedCount, $maxAllowed, $tier) {
                if (is_null($maxAllowed)) {
                    // guard against missing config entry
                    $fail("Membership tier “{$tier}” is not configured for team limits.");
                } elseif ($ownedCount >= $maxAllowed) {
                    $fail("As a “{$tier}” member you may only create up to {$maxAllowed} teams.");
                }
            },
        ],
    ])->validateWithBag('createTeam');

    AddingTeam::dispatch($user);

    $team = $user->ownedTeams()->create([
        'name'          => $input['name'],
        'personal_team' => false,
    ]);

    $user->switchTeam($team);

    return $team;
}
}
