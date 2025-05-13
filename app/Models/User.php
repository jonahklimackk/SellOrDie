<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;
use Cookie;
use App\Models\Membership;
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

class User extends Authenticatable
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
     * Figure out who the sponsor is at time of registration or fucking die
     *
     * @return boolean
     */
    public static function getSponsor()
    {
        $sponsor = Cookie::get('aff') ? User::where('username', Cookie::get('aff'))->get()->first() : User::find(config('listjoe.admin_id'));

        return isset($sponsor) ? $sponsor : die('no sponsor id contact support immediately');
    }


}
