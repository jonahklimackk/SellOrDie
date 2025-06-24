<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;
use Cookie;
use App\Models\Membership;
use Illuminate\Contracts\Auth\MustVerifyEmail;   
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Ads;
use App\Models\Fight;
use App\Models\Team;
use App\Models\Mailings;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'sponsor_id',
        'current_team_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    
    /**
     * Make sure we only ever send the email‐verification ONCE per request.
     *
     * @var bool
     */
    // protected $alreadySentEmailVerification = false;

    /**
     * Override the built-in method so that, even if it's called multiple times,
     * only the first call will actually dispatch the notification.
     */
    // public function sendEmailVerificationNotification()
    // {
    //     if ($this->alreadySentEmailVerification) {
    //         return;
    //     }

    //     $this->alreadySentEmailVerification = true;

    //     // call the normal framework behavior
    //     parent::sendEmailVerificationNotification();
    // }    


    /**
     * Override the default email-verification notification.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\CustomVerifyEmail(  /* no $notifiable */ ));
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     /**
     * get ads through user object
     *
     * @return integer
     */
     public function ads()
     {
        return $this->hasMany(Ads::class);
    }


     /**
     * get fights through user object
     *
     * @return integer
     */
     public function fight()
     {
        return $this->hasMany(Fight::class);
    }



     /**
     * get mailing through user object
     *
     * @return integer
     */
     public function mailings()
     {
        return $this->hasMany(Mailings::class);
    }    



     /**
     * get all ads
     *
     * @return integer
     */
     public function allAds()
     {
        return Ads::where('user_id', $this->id)->get()->all();
    }      

     /**
     * get all ads
     *
     * @return integer
     */
     public function allLiveFights()
     {
        return Team::where('user_id', $this->id)->where('status', 'live')->get()->all();
    } 




    /**
     * Eloquent relationship
     *
     * @return
     */
    public function membership()
    {
        return Memberships::where('name',Auth::user()->status)->get()->first();
    }



    /**
     * Eloquent relationship
     *
     * @return
     */
    public function isUpgraded()
    {
        return true;
    }


    /**
     * Figure out who the sponsor is at time of registration 
     *
     * @return boolean
     */
    public static function getSponsor()
    {
        $sponsor = Cookie::get('aff') ? User::where('username', Cookie::get('aff'))->get()->first() : User::find(config('listjoe.admin_id'));

        return isset($sponsor) ? $sponsor : die('no sponsor id contact support immediately');
    }

    /**
     * Get the user's sponsor after they join and they are in the database
     * fixes values of null or 0 or missing user
     * sets them to admin account
     *
     * @return integer
     */
    public static function fetchSponsor($user)    
    {
        //finds all cases of bad sponsor id
        if($user->sponsor_id === 0 || 
            is_null($user->sponsor_id) || 
            is_null(User::where('id', $user->sponsor_id)->get()->first())){
            $user->sponsor_id = config('sellordie.admin_id');            
        }

        return User::where('id',$user->sponsor_id)->get()->first();

    }

}
