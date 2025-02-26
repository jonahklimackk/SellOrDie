<?php

namespace App\Models;

use DB;
use Carbon\Carbon;
use App\Helpers\SetsStartDate;
use Illuminate\Database\Eloquent\Model;

class FightLog extends Model
{
    protected $fillable = [
        'clicked_ad_id',
        'not_clicked_ad_id',
        'clicked_ad_fight_id',
        'not_clicked_ad_fight_id',
        'clicked_ad_user_id',
        'notClicked_ad_user_id',
    ];



    /**
     * get clicks to a fight in time period
     * 
     * @return integer
     */
    public static function getClicks($ad, $period)
    {
        $dates = SetsStartDate::setDate($period);

        $clicks = DB::table('fight_logs')
        ->where('clicked_ad_id',$ad->id)
        ->whereBetween('updated_at', [$dates['start'],$dates['end'] ])
        ->get();


        return count($clicks);
    }


    /**
     * get clicks to a fight in time period
     * 
     * @return integer
     */
    public static function getOpponentsClicks($ad, $period)
    {


        $dates = SetsStartDate::setDate($period);

        $clicks = DB::table('fight_logs')
        ->where('not_clicked_ad_id',$ad->id)
        ->whereBetween('updated_at', [$dates['start'],$dates['end'] ])
        ->get();


        return count($clicks);

    }    

}
