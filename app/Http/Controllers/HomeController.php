<?php

namespace App\Http\Controllers;

use Auth;
use stdClass;
use App\Models\Fight;
use App\Models\Team;
use App\Models\Ads;
use App\Models\FightLog;
use App\Models\FightViewLog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * Show home page
	 */
	public function index()
	{


		$fights = Team::where('user_id', Auth::user()->id)->get()->all();


		
		foreach ($fights as $fight){

			//get the 2 ads that make up a closed fight
			$data[$fight->id]['ad'] = Ads::where('user_id', Auth::user()->id)->where('team_id', $fight->id)->get()->first();			
			$data[$fight->id]['opponentsAd'] = Ads::where('team_id', $fight->id)->where('user_id', '!=',Auth::user()->id)->get()->first();



			//get all the dynamic fight pairings results - open fights
			if ($data[$fight->id]['ad']) {
				$data[$fight->id]['clicks'] = FightLog::where('clicked_ad_id', $data[$fight->id]['ad']->id)->get()->count();
				$data[$fight->id]['opponentsClicks'] = FightLog::where('not_clicked_ad_id', $data[$fight->id]['ad']->id)->get()->count();
			}       
			else {
				$data[$fight->id]['clicks'] = 0;
				$data[$fight->id]['opponentsClicks'] = 0;        
			}

			//get the draws & win loss %
			$data[$fight->id]['fight'] = Team::where('id', $fight->id)->get()->first();
			$data[$fight->id]['draws'] = FightViewLog::getViews($fight->id,'all') - ($data[$fight->id]['clicks'] + $data[$fight->id]['opponentsClicks']);


			if ($data[$fight->id]['clicks'] || $data[$fight->id]['opponentsClicks']){  
				$data[$fight->id]['winLoss']  = ($data[$fight->id]['clicks'] + (0.5*$data[$fight->id]['draws'])) / FightViewLog::getViews($fight->id,'all');
				$data[$fight->id]['winLoss']  *= 100;
				$data[$fight->id]['winLoss']  = number_format($data[$fight->id]['winLoss'], 2);
			}
			else
				$data[$fight->id]['winLoss'] = 0;


			$data[$fight->id]['ranking'] = Fight::getRank($fight->id);

			$data[$fight->id]['status'] = $fight->status;
		}

		// dd($data);
		$credits = Auth::user()->credits;

		return view('home', compact('data','credits'));




	}
}
