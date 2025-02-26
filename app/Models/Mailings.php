<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mailings extends Model

{      

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'team_id',
        'category',
        'subject',
        'body',
        'url',
        'status',
        'spent_credits',
        'recipients'
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
    * Get the newest mailing
    *
    * @param User
    * @return created_at
    */
    public static function getLastMailingDate(User $user)
    {
        return Mailings::where('user_id', $user->id)->where('status', 'sent')->orWhere('status','queued')->get()->sortByDesc('created_at')->pluck('created_at')->first();
    }

    /**
     * Get the next mailing date
     *
     * @return integer
     */
    public static function getNextMailingDate(User $user)
    {
        $mailing = Mailings::getLastMailingDate($user);
        return isset($mailing) ? $mailing->addDays($user->membership()->mailing_freq) : false;
    }


    /**
     * Return the human time left in days of current mailing status
     *
     * @return integer
     */
    public static function getHumanNextMailing(User $user)
    {
        $nextMailing = Mailings::getNextMailingDate($user);
        // dd($nextMailing);
        if (!$nextMailing)
            return "You can send a mailing now!";        

        $now = Carbon::now();
        $timeLeftHuman = $now->diffForHumans($nextMailing, true);
        if ($now > $nextMailing)
            return "You can send a mailing now!";
        else
            return "Your next mailing is ".$timeLeftHuman." from now.";
    }

/**
     * Return the human time of the last mailing
     *
     * @param User
     * @return Carbon
     */
public static function getHumanLastMailing(User $user)
{
        // dd(Mailing::getLastMailingDate($user));
    return is_null(Mailings::getLastMailingDate($user)) ? 'No previous mailings.' : Mailings::getLastMailingDate($user)->toRfc850String();
}



    /**
     * Can the user send mail right now
     *
     * @return integer
     */
    public static function canSendMail(User $user)
    {
     $nextMailing = Mailings::getNextMailingDate($user);
        $now = new Carbon();

        //if no previous mailings 
        //then yes, user can send mail
        if (!($nextMailing))
            return true;

        return $nextMailing < $now ? true : false;
    }






}
