<?php

namespace App\Http\Controllers;

use Auth;
use Cookie;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use App\Models\FightViewLog;
use App\Models\Ads;	
use App\Models\Team;
use App\Models\Mailings;
use App\Models\Membership;
use App\Models\FightLog;
use App\Models\User;
use App\Helpers\BuildsCreditsUrl;
use Illuminate\Http\Request;

class TestController extends Controller
{

	/**
	* showing league stats for a time period
	*  
	*
	* @return void
	*/
	public function showLeagueStatsInPeriod()
	{
// $en = CarbonImmutable::now()->locale('en_US');

		$period = New Carbon('today');		

		$stats = FightViewLog::all();

		$hits=0;
		foreach ($stats as $stat)
		{
			// dump($stat->updated_at->day);
			// dump($period->day);
			if ($stat->updated_at->day == $period->day && $stat->updated_at->month == $period->month && $stat->updated_at->year == $period->year)
				$hits++;

		}


		dd($hits);

		$fights = Team::where('status','live')->get()->all();


	}

	/**
	* Simulate Sending  A mailing to one person
	*  
	*
	* @return void
	*/
	public function showCreditMail()
	{

		$sender = Auth::user();

		// $topEmailAd = TopEmailAd::where('user_id', '!=', Auth::user()->id)->get()->random(1)->all();

		$mailing = Mailings::where('user_id', Auth::user()->id)->get()->first();

		$recipient = User::get()->random(1)->first();
		// $recipientLogin = Logins::where('user_id', $recipient->id)->get()->sortByDesc('updated_at')->first();

		//create the credits url
		$creditsUrl = BuildsCreditsUrl::build($sender,$recipient,$mailing);

		return View('emails.credit-mail',compact('sender', 'mailing', 'creditsUrl'));        

	}


   /**
	*
	*
	* @return void
	*/
	public function showAffCookies()
	{
		dump('aff cookie: '.Cookie::get('aff'));
		dump('campaign cookie: '.Cookie::get('campaign'));
		dump(Cookie::get('user'));
		dump(Auth::user());
	}




   /**
	*
	*
	* @return void
	*/
	public function testLeague()
	{

	//get all live fights
		$fights = Team::where('status','live')->get()->all();

	//accumulate the data
		foreach($fights as $fight){

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
				$fight->clicks = FightLog::where('clicked_ad_id', $fight->ad->id)->get()->count();
				$fight->opponentsClicks = FightLog::where('not_clicked_ad_id', $fight->ad->id)->get()->count();    
			}       
			else {
				$fight->clicks = 0;
				$fight->opponentsClicks = 0;  
			}

			//calculate win loss percentage
			if ($fight->clicks || $fight->opponentsClicks){
				$ties = $fight->views - ($fight->clicks + $fight->opponentsClicks);
				$fight->winLoss = ($fight->clicks + (0.5*$ties))/$fight->views;
			}

		}

		//sort by winLoss desc
		usort($fights, function($a, $b) {
			return $b->winLoss <=> $a->winLoss;
		});


		return view('league', compact('fights'));

	}



 /**
	*
	*
	* @return void
	*/
	public function fixDivisionByZero()
	{

		//some fights/ads get views counted, some don't
		//I haven';t notices till now

		$ads = Ads::all();
		foreach ($ads as $ad)
			dump($ad->views);

	}





}
