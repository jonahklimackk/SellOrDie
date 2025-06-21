<?php

namespace App\Models;

use DB;
use Auth;
use App\Models\User;
use App\Models\FightViewLog;
use App\Models\RandomOpponents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    /** @use HasFactory<\Database\Factories\AdsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'headline', 'body','url','status','category','team_id'
    ];


     /**
     * get user through mailing object
     *
     * @return integer
     */
     public function user()
     {
        return $this->belongsTo(User::class);
    }

     /**
     * get user through mailing object - alias
     *
     * @return integer
     */
     public function fighter()
     {
        return $this->belongsTo(User::class);
    }    

     /**
     * get user through team model
     * @return integer
     */
     public function team()
     {
        return $this->belongsTo(Team::class);
    }    



     /**
     * gets 2 ads from fights with no opponent
     * so random opponent
     *
     * @return integer
     */
     public static function fromOpenFights()
     {

        //this prevents someone from seeing their own ad,
        //however there must  be a logged in user to see the fight - I think
        //and ads from the same person are shown against eeach other 
        //that sounds like af eatgure, ad vs ad is ok cuz you can ssee which did better
   
        $fighters = User::where('credits', '>=', config('sellordie.cost_display_ad'))->where('id','!=',Auth::user()->id)->get()->all();


        $possibleAds = [];
        foreach($fighters as $fighter){
            $fights = $fighter->allLiveFights();  
            // dd($fights);     
            foreach ($fights as $fight){   
                $adsCount = count($fight->allAds());                
                if ($adsCount === 2) {     
                    // dump('fight with 2 ads');
                }
                else if ($adsCount === 1) {
                    //1 ad means open fight, grab ads from
                    //pool of other open fights
                    $possibleAds[$fight->id] = $fight->ad;
                }
                else if (! $adsCount) {
                    // dump("this is a fight with 0 ads");

                }
                else
                    dump("this is a fight that has ".$adsCount." ads");
            }

        }


        $randomFightIds = array_rand($possibleAds,2);
        foreach ($randomFightIds as $randomFightId){
            $randomFight = Team::find($randomFightId);
            // $randomFight->logview();
            // $randomFight->views++;
            // $randomFight->save();
            FightViewLog::logView($randomFight->id);
            //i don't even use this stat
            $randomFight->ad->views++;
            $randomFight->ad->save();
            $ads[] = $possibleAds[$randomFightId];
        }


        return $ads;

    }






    /**
     * gets the ads of a random filled up fight
     *
     * @return integer
     */
    public static function fromClosedFights()
    {

        $fighters = User::where('credits', '>=',1)->where('id','!=',Auth::user()->id)->get()->all();

        $possibleAds = [];
        foreach($fighters as $fighter){
            $fights = $fighter->allLiveFights();

            foreach ($fights as $fight){   
                $adsCount = count($fight->allAds()); 

                if ($adsCount === 2) {     
                    // dump('ads count is 2');
                    $possibleAds[$fight->id] = $fight->allAds();
                }
                else if ($adsCount === 1) {
                    // dump("this is an open fight");
                    // dump($fight->name);
                }
                else if (! $adsCount) {
                    dump("this is a fight with no ads");

                }
                else 
                    dump("this is a fight that has ".$adsCount." ads");
            }
        }

        // dump($possibleAds);

        $randomFight = Team::where('id',array_rand($possibleAds))->get()->first();
        FightViewLog::logView($randomFight->id);

        //need to review this i don't use these stats edo i ?
        //for teams/fights i grab the views
        //for dclicdks in an open fight i use fightlog
        foreach($possibleAds[$randomFight->id] as $ad){
            $ad->views++;
            $ad->save();
            $ad->user->credits -= 1;
            $ad->user->save();
        }

        return $possibleAds[$randomFight->id];
    }

     /**
     * each team has only one ad
     *
     * @return integer
     */
     public function fight()
     {
        return $this->hasOne(Team::class);
    }





}