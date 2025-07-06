<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\FightViewLog;
use App\Models\User;
use App\Models\Fight;
use App\Models\FightLog;
use App\Models\Team;
use App\Models\Ads;
use App\Models\TeamUser;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Events\AdViewed;
use App\Events\AdVoted;

class AdsController extends Controller
{

    public function awardCredits()
    {
        // Your existing logic to record the view...
        
        // 1) Dispatch the event (will trigger CreditService under the hood)
        event(new AdVoted(Auth::user()));

        // 2) Return the ad view
        // return view('ads.show', compact('ad'));
        return 'success!';
    }




	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//get the 2 ads that make up a closed fight
		$ad = Ads::where('user_id', Auth::user()->id)->where('team_id', Auth::user()->currentTeam->id)->get()->first();
		$opponentsAd = Ads::where('team_id', Auth::user()->currentTeam->id)->where('user_id', '!=',Auth::user()->id)->get()->first();		

		//pulldown list
		$categories = Categories::all();

		//get all the dynamic fight pairings results - open fights
		if ($ad) {
			$clicks = FightLog::where('clicked_ad_id', $ad->id)->get()->count();
			$opponentsClicks = FightLog::where('not_clicked_ad_id', $ad->id)->get()->count();
		}       
		else {
			$clicks = 0;
			$opponentsClicks = 0;        
		}

	//get the draws & win loss %
		$fight = Team::where('id', Auth::user()->currentTeam->id)->get()->first();
		$draws = FightViewLog::getViews($fight->id, "all") - ($clicks + $opponentsClicks);


		if ($clicks || $opponentsClicks){  
			$winLoss = ($clicks + (0.5*$draws)) / FightViewLog::getViews($fight->id,'all');
			$winLoss *= 100;
			$winLoss = number_format($winLoss, 2);
		}
		else
			$winLoss = 0;


		$ranking = Fight::getRank($fight->id);

		
		// $showInviteButton = $ad ? true : false;
		if ($ad && $opponentsAd)
		{
			$showInviteButton = false;
			$showRandomButton = false;
		}
		else {

			if (isset($ad) && !$ad->random_opponent)
				$showRandomButton = true;
			else
				$showRandomButton = $opponentsAd ? true : false;
			$showInviteButton = false;
		}


		return view('ads-new', compact('ad','opponentsAd','categories', 'clicks', 'opponentsClicks','draws','winLoss','ranking','fight'))->with([
			'showInviteButton' => $showInviteButton,
			'showRandomButton' => $showRandomButton
		]);
	}



	/**
	 * Show the form for creating a new resource.
	 */
	public function create(request $request)
	{

		$validatedData = $request->validate([
			'headline' => 'required|string|max:200',
			'category' => 'required|string|max:200',
			'body' => 'required|string|max:50000',
			'url' => 'required|url|max:500',
		]);


		// need to prevent the 3 ad per fight problem
		if (! Auth::user()->currentTeam->isFull())            
			$ad = Ads::updateOrCreate([
				'id' => $request->id
			],
			[
				'team_id' => Auth::user()->currentTeam->id,
				'user_id' => Auth::user()->id,
				'headline' => $request->headline,
				'category' => $request->category,
				'body'=> $request->body,
				'url' => $request->url,
				'status' => 'config',
			]);
		else
			return redirect('ads')->with('red_message', "This fight is already full.");




		return redirect('ads')->with('green_message', 'Your Ad Weapon has been configured. You are ready for the fight!');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Ads $ads)
	{
		//
	}

	/**
	 * Display the edit ads form
	 */
	public function edit()
	{
		$ad = Ads::where('user_id', Auth::user()->id)->where('team_id', Auth::user()->currentTeam->id)->get()->first();          
		$opponentsAd = Ads::where('team_id', Auth::user()->currentTeam->id)->where('user_id', '!=',Auth::user()->id)->get()->first();

				//pulldown list
		$categories = Categories::all();

		//get all the dynamic fight pairings results - open fights
		if ($ad) {
			$clicks = FightLog::where('clicked_ad_id', $ad->id)->get()->count();
			$opponentsClicks = FightLog::where('not_clicked_ad_id', $ad->id)->get()->count();
		}       
		else {
			$clicks = 0;
			$opponentsClicks = 0;  
		}
	//get the draws & win loss %
		$fight = Team::where('id', Auth::user()->currentTeam->id)->get()->first();
		$draws = FightViewLog::getViews($fight->id, "all") - ($clicks + $opponentsClicks);


		if ($clicks || $opponentsClicks){
			$winLoss = ($clicks + (0.5*$draws))/FightViewLog::getViews($fight->id,'all');
			$winLoss = number_format($winLoss, 2) * 100;
		}
		else
			$winLoss = 0;

		$showInviteButton = false;
		$showRandomButton = $opponentsAd ? true : false;

		$create = true;

		//note: all the sstats show zero while editing your ad
		return view('ads-new', compact('ad','categories','opponentsAd','clicks', 'opponentsClicks','winLoss','fight'))->with([
			'edit' => true,
			'create' => true,
			'showInviteButton' => $showInviteButton,
			'showRandomButton' => $showRandomButton
		]);
	}






	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Ads $ads)
	{
		//
	}







	/**
	 * Remove the specified resource from storage.
	 */
	public function delete(Request $request)
	{
		$ad = Ads::find($request->id);


		$fight = Team::where('id', $ad->team_id)->get()->first();
		$fight->status = 'config';
		$fight->save();
		FightViewLog::where('fight_id', $fight->id)->delete();

		$ad->delete();


		return redirect('ads')->with('green_message', 'You have succesfully deleted your ad.');

	}





	/**
	 *  set random oppoinetn flag
	 */
	public function setRandomOpponent(Request $request)
	{
		$ad = Ads::find($request->id);
		$ad->random_opponent = true;
		$ad->save();

		return redirect('ads')->with('green_message', 'You will have random opponents to your ad Weapon');
	}   
 
}
