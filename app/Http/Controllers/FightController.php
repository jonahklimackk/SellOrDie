<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Str;
use Redirect;
use App\Models\FightViewLog;
use App\Models\User;
use App\Models\Mailings;
use App\Models\Ads;
use App\Models\Fight;
use App\Models\FightLog;
use App\Models\Votes;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\RandomOpponents;
use App\Models\CreditClicks;
use Illuminate\Http\Request;

class FightController extends Controller
{
	/**
	 * Show an open or closed
	 */
	public function index()
	{

		if (rand(0,1)) {
			// dump('from a random closed fight');
			$ads = Ads::fromClosedFights();
		}
		else {
			// dump('from a random open fight');
			$ads = Ads::fromOpenFights();
		}

		//get random fighters' affiliate link
		$referralLink = $this->getReferralLink($ads);				

		//create votes too
		$ads = $this->makeKey($ads);


		return view('fight', compact('ads','referralLink'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//
	}







	/**
	 * show a closed fight given id
	 */
	public function showSpecific($fightId)
	{
		$fight = Team::find($fightId);

		FightViewLog::logView($fight->id);

		if(is_null($fight))
			return "error: no fight exists here";

		$ads = Ads::where('team_id', $fight->id)->get()->all();

		if (count($ads) > 2)
			return "error: fight is full";
		//1 ad? show a specific open fight
		else if (count($ads) < 2 ) {

			// dump("open fight");
			//prevents ads from same person against itself
			do{
				//need anothere ad from an open fight
				//fetch 2 random open ads and pick of those
				$twoRandomOpenAds = Ads::fromOpenFights();
				$rand = rand(0,1);

				// $ads[0] is already set
				$ads[1] = $twoRandomOpenAds[$rand];				

			} while ($ads[0] == $ads[1]);
		}
		//else then it's a closed fight with 2 ads already set

		//get random fighters' affiliate link
		$referralLink = $this->getReferralLink($ads);				


		$ads = $this->makeKey($ads);



		return view('fight', compact('ads','referralLink'));
	}


	/**
	 * insert a vote to be checked
	 * 
	 */
	public function makeKey($ads)
	{
		$key = Str::random(100);
		foreach ($ads as $ad){
			$ad->key = $key;
			Votes::create([
				'team_id' => $ad->team_id,
				'user_id' => $ad->user_id,
				'ad_id' => $ad->id,
				'key' => $key,
			]);   
		}
		return $ads;

	}

	/**
	 * Get the random Rerral link
	 */
	public function getReferralLink($ads)
	{
		if (rand(0,1)) {
			$fighter = User::where('id', $ads[0]->user->id)->get()->first();
			$referralLink = ENV('APP_URL')."/aff/".$fighter->username."/fights";
		}
		else {
			$fighter = User::where('id', $ads[1]->user->id)->get()->first();
			$referralLink = ENV('APP_URL')."/aff/".$fighter->username."/fights";
		}		
		return $referralLink;
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Fight $fight)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Fight $fight)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Fight $fight)
	{
		//
	}






	/**
	 * Make the fight live
	 */
	public function start(Request $request)
	{
		$fight = Team::find($request->fight_id);
		$fight->status = 'live';
		$fight->save();


		return redirect("/ads")->with('message', 'Your fight is now live!');
	}



	/**
	 * stop the fijght
	 */
	public function stop(Request $request)
	{
		$fight = Team::find($request->fight_id);
		$fight->status = 'config';
		$fight->save();


		return redirect("/ads")->with('message', 'Your fight is now back in config');
	}






	/**
	 * reset th stats
	 */
	public function reset(Request $request)
	{

		FightViewLog::where('fight_id', $request->fight_id)->delete();

		$fightLog = FightLog::where('clicked_ad_fight_id', $request->fight_id)->delete();
		$fightLog = FightLog::where('not_clicked_ad_fight_id', $request->fight_id)->delete();


		return redirect("/ads")->with('message', 'You have reset your stats.');
	}
















	/**
	 * Show an open or closed
	 */
	public function fightsWith3 ()
	{
		$fighters = User::all();
		// $fighters = User::where('credits', '>=',1)->get()->all();

		foreach($fighters as $fighter){
			$fights = $fighter->allTeams();

			foreach ($fights as $fight){  

				dump($fight->isFull());
				dump(count($fight->allAds()));
				// foreach ($fight->allAds() as $ad){
				//     $ad->delete();
			}
		}

		return view('fight-with-3', compact('data'));
	}










	/**
	 * count clicks on ads in fight
	 */
	public function vote($key, $clickedAdId)
	{
		//keep them from choosing one opponent
		//and then backing up and clicking on the other ad 
		$votes = Votes::where('key', $key)->get()->all();
		foreach ($votes as $vote){     
			if ($vote->vote){
				$clickedAd = Ads::find($clickedAdId);
				return view('frames.already-judged-show-url')->with('url',$clickedAd->url);
			}
		}
		$vote = Votes::where('key', $key)->where('ad_id', $clickedAdId)->get()->first();
		$vote->vote = true;
		$vote->save();


		//this log is the only way to kee;p track of open fights
		//random pairings - this way you can keep track of ghost opponents
		// i might only need clicked_ad_id and not_clicked_ad_id

		$clickedAd = Ads::find($clickedAdId);
		$notClickedAd = Ads::find(Votes::where('key', $key)->where('ad_id', '!=', $clickedAdId)->get()->pluck('ad_id')->first());
		$fightLog = FightLog::create([
			'clicked_ad_id' => $clickedAd->id,
			'not_clicked_ad_id' => $notClickedAd->id,
			'clicked_ad_fight_id' => $clickedAd->team_id,
			'not_clicked_ad_fight_id' => $notClickedAd->team_id,
			'clicked_ad_user_id' => $clickedAd->user_id,
			'notClicked_ad_user_id' => $notClickedAd->user_id,
		]);

		//credit the user for the click
		// if the user is not logged in, then redirect to login
		// but if not logg3ed in, make a teopoaraoy adcount that accumuatr3es ccredits
		// until they actualoy sign up
		if (Auth::user()) {
			Auth::user()->credits++;
			Auth::user()->save();
		}
		else{
			//BIG TODO ITEM HERE
			//persist the earning of crdits in cookei utnil
			// user actuaoly signs up
			dump('not loggedd in , or poential new users who clicked ads');
		}

		//same system as listjoe
		$creditClick = CreditClicks::create([
			'key' => $key,
			'recipient_id' => Auth::user()->id,
			'sender_id' => $clickedAd->user->id,
			'credits' => rand(1,5),
			'earned_credits' => false,
			'ip' => ENV("REMOTE_ADDR"),
		]);


		return view('frames.earn-credits',compact('creditClick'))->with('url',$clickedAd->url);

	}



	/**
	 *show the ad even though they already vogted
	 * that way peop;le can get hits on already votes
	 */
	public function alreadyJudgedShowUrlTopFrame()
	{


		return view('frames.already-judged-show-url-top-frame');
	}


}
