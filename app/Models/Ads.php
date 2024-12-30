<?php

namespace App\Models;

use DB;
use App\Models\User;
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
        $fighters = User::where('credits', '>=',1)->get()->all();

        $possibleAds = [];
        foreach($fighters as $fighter){
            $fights = $fighter->allTeams();       
            foreach ($fights as $fight){   
                $adsCount = count($fight->allAds());                
                if ($adsCount === 2) {     
                    // dump('fight with 2 ads');
                    // dump($fight->name);
                    // $closedFights[] = $fight->allAds();
                }
                else if ($adsCount === 1) {
                    // dump("this is an open fight");
                    // dump($fight->name);
                    // $openFights[] = $fight->ad;
                    $possibleAds[$fight->id] = $fight->ad;

                }
                else if (! $adsCount) {
                    // dump("this is a fight with no ads");

                }
                else {
                    dump("just chec king");
                    // dump("this is a fight that has ".$adsCount." ads");
                        // foreach ($fight->allAds() as $ad){
                        // $ad->delete();
                }

            }
        }

        //the only problem witiht his is it someitmes has 2 ads from the same person

        $randomFightIds = array_rand($possibleAds,2);
        foreach ($randomFightIds as $randomFightId){
            $randomFight = Team::find($randomFightId);
            $randomFight->views++;
            $randomFight->save();
            $randomFight->ad->views++;
            $randomFight->ad->save();
            $ads[] = $possibleAds[$randomFightId];
        }


        //this is onlly done through testing
        //normallyl the random ooppoine would bget 
        //pupt on the team as part of ad setup
        foreach ($randomFightIds as $randomFightId){
            $randomFight = Team::find($randomFightId);
            // dd($randomFight->user_id);
            // dd($randomFight->ad->id);
            $randomOpponent = RandomOpponents::create([
                'ad_id' => $randomFight->ad->id,
                'team_id' => $randomFight->id,
                'fighter_id' => $randomFight->user_id,
                'clicks' => 0
            ]);
            $randomFight->random_opponent_id = $randomOpponent->id;
            $randomFight->save();
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

        $fighters = User::where('credits', '>=',1)->get()->all();

        $possibleAds = [];
        foreach($fighters as $fighter){
            $fights = $fighter->allTeams();
       
            foreach ($fights as $fight){   
                $adsCount = count($fight->allAds());                
                if ($adsCount === 2) {     
                    $possibleAds[$fight->id] = $fight->allAds();
                }
                // else if ($adsCount === 1) {
                //     // dump("this is an open fight");
                //     // dump($fight->name);
                // }
                // else if (! $adsCount) {
                //     // dump("this is a fight with no ads");

                // }
                // else {
                //     // dump("this is a fight that has ".$adsCount." ads");
                //         // foreach ($fight->allAds() as $ad){
                //         // $ad->delete();
                // }

            }
        }
        $randomFight = Team::where('id',array_rand($possibleAds))->get()->first();
        $randomFight->views++;
        $randomFight->save();

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