<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\DeletesTeams;

class DeleteTeam implements DeletesTeams
{
    public function delete(Team $team): void
    {
        $user = Auth::user();

        // find any other team (owned or member)
        $allTeams = $user->ownedTeams()->get()
                         ->merge($user->teams()->get());

        $fallback = $allTeams->first(fn(Team $t) => $t->id !== $team->id);

        if (! $fallback) {
            throw ValidationException::withMessages([
                'team' => 'You must have at least one team. Create another team before deleting this one.',
            ]);
        }

        // **only** check if *this* is the current team
        if ($user->current_team_id === $team->id) {
            $user->forceFill([
                'current_team_id' => $fallback->id,
            ])->save();
        }

        // finally, purge the team
        $team->purge();
    }
}
