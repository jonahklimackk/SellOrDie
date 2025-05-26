<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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


class NewFightController extends Controller
{




    /**
     * fight page with frames
     */
        public function newFight()
        {
            return view('new-fight.new-fight-frame');
        }


    /**
     * fight page top frame
     */
        public function newFightTopFrame()
        {
            return view('new-fight.new-fight-top-frame');

        }   


        /**
     * fight page bottom frame
     */
        public function newFightBottomFrame()
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


            return view('new-fight.new-fight-bottom-frame', compact('ads','referralLink'));

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


        return view('new-fight.earn-credits',compact('creditClick'))->with('url',$clickedAd->url);
        // return redirect($clickedAd->url);

    }



/**
    * Show the credits frame to earn credits
    * javscript timer countdown
    *
    * @return View    */
    public function showTopFrameBeforeCountdown(string $key)

    { 
        $now = New Carbon();
        $setTimer = false;

        $creditClick = CreditClicks::where('key', $key)->get()->first();
        $sender = User::where('id',$creditClick->sender_id)->get()->first();


        if (is_null($creditClick)) {
            $message = "We can't find this credit link.";
        }
        else if ($now->timestamp - $creditClick->created_at->timestamp >= 1209600) {
            $message = 'Your credit click link has expired';
            $creditClick->clicks++;
            $creditClick->save(); 
        }

        else if ($creditClick->earned_credits == true){
            $message = 'You already earned '.$creditClick->credits.' credits for this credit link';      
            $creditClick->clicks++;
            $creditClick->save();  
        }
        else{
            $setTimer = true;
            $message = "Wait for the timer to count down and you'll earn ".$creditClick->credits. " credits";
        }


        return View('new-fight.top-frame',compact('creditClick','message','setTimer','sender'));
    }

}
