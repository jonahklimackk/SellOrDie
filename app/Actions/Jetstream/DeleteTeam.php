<?php

namespace App\Actions\Jetstream;

use Auth;
use App\Models\Team;
use Laravel\Jetstream\Contracts\DeletesTeams;

class DeleteTeam implements DeletesTeams
{
    /**
     * Delete the given team.
     */
    public function delete(Team $team)
    {

        //make sure there's a team left

        if (Auth::user()->allTeams()->count() > 1)
        {

            $team->purge();


            //switch to a diffferent team
            $availableTeam = Team::where('user_id',Auth::user()->id)->where('id','!=',$team->id)->get()->first();
            Auth::user()->current_team_id = $availableTeam->id;
            Auth::user()->save();

        }
        else
        {
            dd("you must have at least one team");
            // return redirect('/teams/42')->with('You must leave at least one team');
        }


        

    }
}
