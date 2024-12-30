<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Str;
use Redirect;
use App\Models\User;
use App\Models\Ads;
use App\Models\Fight;
use App\Models\Votes;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\RandomOpponents;
use App\Models\CreditClicks;
use Illuminate\Http\Request;

class FightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // if (rand(0,1)) {
        //     dump('from a random closed fight');
        //     $ads = Ads::fromClosedFights();
        // }
        // else {
        //     dump('from random open fights');
        $ads = Ads::fromOpenFights();
        // }

        // $votes = buildsVotes::build($ads);

        //2 votes with the same key
        //thats how one knows about the otehr
        //so they can only vote once
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



        return view('fight', compact('ads'));
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
     * Display the specified resource.
     */
    public function show(Fight $fight)
    {
        //
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
     * count clicks on ads in fight
     */
    public function vote($key, $adId)
    {
        //make suee it hasn't been vote4d on yet.
        // $votes = Votes::where('key', $key)->get()->all();
        // foreach ($votes as $vote){           
        //     if ($vote->vote)
        //         return "You already voted.";
        // }

        $vote = Votes::where('key', $key)->where('ad_id',$adId)->get()->first();
        $vote->vote = true;
        $vote->save();

        $clickedAd = Ads::where('id', $adId)->get()->first();
        $notClickedAdId = Votes::where('key', $key)->where('ad_id', '!=', $adId)->get()->pluck('ad_id')->first();
        $notClickedAd = Ads::find($notClickedAdId);

        //open fight
        if($clickedAd->fight() !== $notClickedAd->fight())
        {   

            dump('ads not equal');
            dump("clicked ad id".$clickedAd->id);
            dump("not clicked ad id".$notClickedAd->id);
            dump($notClickedAd);
            dump($clickedAd);
            // $clickedAd->clicks++;
            // $clickedAd->save();

            $notClickedAdFight = Team::where('id',$notClickedAd->team_id)->get()->first();
            $clickedAdFight = Team::where('id',$clickedAd->team_id)->get()->first();

            // dump($notClickedAdFight->id);
            // dump($notClickedAdFight->random_opponent_id);

            dump($clickedAdFight->id);
            dump($clickedAdFight->random_opponent_id);

            // dump($losingFight->random_opponent_id);
            $randomOpponent = RandomOpponents::where('id',$clickedAdFight->random_opponent_id)->get()->first();
            $randomOpponent->clicks++;
            $randomOpponent->save();

            dump($randomOpponent);



            //this is what needs to happen
            // $notClickedAd->fight()->random_opponent->clicks++
            //so, fightsk or teams, now have random_opponent_id

            //when the user clicks Random Opponent, one is assigned
            //and the random_opponenet in the table keeps track of al
            //the times the ad isn't clicked - thusk, oponent cclicks

            //so when you grab open fights, they're the one with on ad defined still but also has an randomopponent
            //could be called ghost opponent but whatever

            // dump(count($fight->id));
            // foreach($fight as $item)
            // {
            //     dump($item);
            // }
            // dump($fight->id);
            // $opponentsAd++;


            // $fighterWon = User::where('id',$clickedAd->user_id)->get()->first();
            // $fighterLost = User::where('id',$notClickedAd->user_id)->get()->first();
            // dump($fighterWon);
            // dump($fighterLost);
            //must have a column called random_opponent_clicks
            //you need some sort of ghost ad to fill up the team
            //and keep tyrack of when your ad edidn't get clicked

            //random_opponents is an ad that counts the clickso
            //of when your aed didin't get dclicked


        }
        // else {
        //     $clickedAd->clicks++;
        //     $clickedAd->save();
        // }

        // if ($fighter->belongsToTeam($notClickedAd->fight()))
        //     dump("yes");


        exit;

        // dump($clickedAd->fight());

            //if clickedd ad is not a part of this te4am, then it is an oopen
        //fight wieh random opponent

        //if user not logged in then log them in
        Auth::user()->credits++;
        Auth::user()->save();

        $creditClick = CreditClicks::create([
            'key' => $key,
            'recipient_id' => Auth::user()->id,
            'sender_id' => $clickedAd->user->id,
            'credits' => rand(1,5),
            'earned_credits' => false,
            'ip' => ENV("REMOTE_ADDR"),
        ]);


        return view('frames.earn-credits',compact('creditClick'))->with('url',$clickedAd->url);

        // return Redirect::to($clickedAd->url);



    // return view('frames.earn-credits');

        //delete the votes now?

        // build the credit click url


        
        // $creditClicksUrl = new CreditClicks;
        // $creditClicksUrl->recipient_id = $recipient->id;
        // $creditClicksUrl->sender_id = $sender->id;
        // $creditClicksUrl->mailing_id = $mailing->id;
        // $creditClicksUrl->key = $key;
        // $creditClicksUrl->credits = $credits;
        // $creditClicksUrl->clicks = 0;
        // $creditClicksUrl->earned_credits = false;
        // $creditClicksUrl->save();





        //credit the user for the click
        // if the user is not logged in, then redirect to login
        //     but if not logg3ed in, make a teopoaraoy adcount that accumuatr3es ccredits
        // until they actualoy sign up

        // //now I have to load credit cliocking frame

        // Auth::user()->credits++;
        // Auth::user()->save();

        // and then what about knwoing if this is the first ad they clicked




        // return Redirect::to($somecreiddtclickingframeurl);

    }
}
