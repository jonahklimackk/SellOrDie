<?php

namespace App\Models;

use DB;
use App\Helpers\SetsStartDate;
use App\Models\FightViewLog;

use Illuminate\Database\Eloquent\Model;

class FightViewLog extends Model
{

    protected $table = 'fight_view_log';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fight_id',
    ];




    /**
     * records a fight viewing
     * 
     * @return integer
     */
    public static function logView($fightId)
    {

        FightViewLog::create([
            'fight_id' => $fightId,            
        ]);

    }  


    /**
     * get clicks to a fight using fight view log
     * 
     * @return integer
     */
    public static function getViews($fightId, $period)
    {

        $dates = SetsStartDate::setDate($period);

        // dd($dates);

        $clicks = DB::table('fight_view_log')
        ->where('fight_id',$fightId)
        ->whereBetween('created_at', [$dates['start'],$dates['end'] ])
        ->get();


        return count($clicks);
    }






}
