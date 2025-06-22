<?php

namespace App\Actions\Jetstream;

use Auth;
use App\Models\Ads;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesTeams;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Create a new action instance.
     */
    public function __construct(protected DeletesTeams $deletesTeams)
    {
    }

    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->deleteTeams($user);
            $user->deleteProfilePhoto();
            $user->tokens->each->delete();
            $user->delete();
        });

        //delete the ads attached to these teams
        //or just delete all the ads
        $ads = Ads::where('user_id', Auth::user()->id)->get()->all();
        foreach ($ads as $ad){
            dump('hi');
            $ad->delete();
        }

    }

    /**
     * Delete the teams and team associations attached to the user.
     */
    protected function deleteTeams(User $user): void
    {
        // detach pivot memberships
        $user->teams()->detach();

        // unconditionally purge every team the user owns
        $user->ownedTeams->each(function (Team $team) {
            $team->purge();
        });
    }
}
