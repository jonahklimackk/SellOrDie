<?php

namespace App\Http\Controllers;


use DB;
use Auth;
use Carbon\Carbon;
use App\Models\FightViewLog;
use App\Models\User;
use App\Models\Team;
use App\Models\Membership;
use App\Models\Ads;
use App\Models\FightLog;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
	/**
	 * Show league stats.
	 */
	public function index($period)
	{

		$fights = LeagueController::getLeagueStats($period);

		if ($period == "thisweek")
			$humanPeriod = "This Week";
		else if ($period == "lastweek")
			$humanPeriod = "Last Week";
		else if ($period == "thismonth")
			$humanPeriod = "This Month";
		else if ($period == "lastmonth")
			$humanPeriod = "Last Month";		
		else 
			$humanPeriod = ucfirst($period);



		return view('league', compact('fights','humanPeriod'));
	}



	/**
	 * Get the league rankings
	 */

	public static function getLeagueStats($period)
	{


		//get all live fights
		$fights = Team::where('status','live')->get()->all();

		//build the array
		foreach($fights as $fight){
			$fight->views = FightViewLog::getViews($fight->id, $period);

			$ads = $fight->allAds();

			if (count($ads) == 2) {


				//arbitrarily set these first
				$fighter1 = User::where('id',$ads[0]->user_id)->get()->first();
				$fighter2 = User::where('id',$ads[1]->user_id)->get()->first();


				//the fightOwner is the one in the TEAM table
				//the opponent is the one in the userMemberships table
				//so if found in here, then it's opponent and so logically
				//the only other possiblity, considdering that it's 2 ads pet team
				//is in the if statemente here
				if (Membership::where('team_id', $fight->id)->where('user_id', $fighter1->id)->get()->first()) {
					$fight->opponent = $fighter1;
					$fight->fightOwner = $fighter2;
				}
				else {
					$fight->opponent = $fighter2;
					$fight->fightOwner = $fighter1;
				}

				// dump("fight Owner is ".$fight->fightOwner);
				// dump("fight opponent is ".$fight->opponent);


				if($ads[0]->user_id = $fight->id){
					$fight->fightOwnerAd = $ads[0];
					$fight->opponentsAd = $ads[1];
				}
				else {
					$fight->fightOwnerAd = $ads[1];
					$fight->opponentsAd = $ads[0];
				}
				$fight->type = "closed";

			}
			else if (count($ads) == 1) {
				//if there's only one ad then this is ok
				$fight->fightOwner = User::where('id',$ads[0]->user_id)->get()->first();
				$fight->ad = $ads[0];
				$fight->type = "open";
			}
			else if (!count($ads) && count($ads) > 2) //this shouldn't happen
			dump("warning this fight has 3 or more ads");

			//get all the dynamic fight pairings results - open fights
			if ($fight->ad) {

				$fight->clicks = FightLog::getClicks($fight->ad,$period);  
				$fight->opponentsClicks = FightLog::getOpponentsClicks($fight->ad,$period);
			}       
			else {
				$fight->clicks = 0;
				$fight->opponentsClicks = 0;  
			}


			//calculate win loss percentage
			if ($fight->clicks || $fight->opponentsClicks){
				$fight->views = FightViewLog::getViews($fight->id, $period);				
				$ties = $fight->views - ($fight->clicks + $fight->opponentsClicks);
				if ($ties < 0 )
					dump($ties);
				$fight->winLoss = ($fight->clicks + (0.5*$ties)) / $fight->views;
			}

		}

		//sort by winLoss desc
		usort($fights, function($a, $b) {
			return $b->winLoss <=> $a->winLoss;
		});


		//keep only 10 of them
		//this is gotta be ineefficient - like everhtnig up above might prpove sloow if lots otf trafidc
		$fights = array_slice($fights,1,10);


		return $fights;


	}

}
