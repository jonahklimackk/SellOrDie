<?php

namespace App\Actions\Jetstream;

use Auth;
use App\Models\Team;
use App\Models\User;
use App\Models\Ads;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\RemovesTeamMembers;
use Laravel\Jetstream\Events\TeamMemberRemoved;

class RemoveTeamMember implements RemovesTeamMembers
{
    /**
     * Remove the team member from the given team.
     */
    public function remove(User $user, Team $team, User $teamMember): void
    {
        $ad = Ads::where('user_id',$user->id,)->where('team_id', $team->id)->get()->first();
         if($ad)
            $ad->delete();
        $opponentsAd = Ads::where('team_id', $team->id)->where('user_id',$teamMember->id )->get()->first();
        if($opponentsAd)
            $opponentsAd->delete();
        $team->status = "config";
        $team->save();

        $this->authorize($user, $team, $teamMember);

        // $this->ensureUserDoesNotOwnTeam($teamMember, $team);

        $team->removeUser($teamMember);


        TeamMemberRemoved::dispatch($team, $teamMember);
    }

    /**
     * Authorize that the user can remove the team member.
     */
    protected function authorize(User $user, Team $team, User $teamMember): void
    {
        if (! Gate::forUser($user)->check('removeTeamMember', $team) &&
            $user->id !== $teamMember->id) {
            throw new AuthorizationException;
        }
    }

    /**
     * Ensure that the currently authenticated user does not own the team.
     */
    protected function ensureUserDoesNotOwnTeam(User $teamMember, Team $team): void
    {
        if ($teamMember->id === $team->owner->id) {
            throw ValidationException::withMessages([
                'team' => [__('You may not leave a fight that you created.')],
            ])->errorBag('removeTeamMember');
        }
    }
}
