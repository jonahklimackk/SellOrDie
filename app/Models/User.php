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
// use Laravel\Cashier\Billable;
use Spark\Billable;  
use App\Models\MatrixPosition;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Billable;
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
        'status',
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
     * Public entrypoint: build the full binary downline tree.
     *
     * @return array|null
     */
    public function getBinaryTree(): ?array
    {
        $pos = $this->matrixPosition;
        return $pos
        ? $this->buildBinaryNode($pos)
        : null;
    }



    /**
     * Normalize status names if needed:
     */
    public function getMembershipTierAttribute()
    {
        // if your status values differ, map them here
        $map = [
            'free'         => 'amateur',
            'lightweight'  => 'lightweight',
            'heavyweight'  => 'heavyweight',
        ];

        return $map[$this->status] ?? 'amateur';
    }

    
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

        /**
     * The user who referred (sponsored) this user.
     */
        public function referrer()
        {
            return $this->belongsTo(User::class, 'referrer_id');
        }



    /**
     * Users this person has referred.
     */
public function referrals()
{
    return $this->hasMany(User::class, 'referrer_id')->orderBy('id');
}
    /**
     * Affiliate sales where this user is the referrer.
     */
    public function affiliateSales()
    {
        return $this->hasMany(AffiliateSale::class, 'referrer_id');
    }    

/**
 * Get all matrix positions owned by this user.
 */
public function matrixPositions()
{
    return $this->hasMany(MatrixPosition::class, 'user_id');
}

    /**
     * One-to-one to the user's own matrix position.
     */
    public function matrixPosition()
    {
        return $this->hasOne(MatrixPosition::class);
    }

    /**
     * Get the users this user has personally referred (level-1 downline).
     */
    public function personalReferrals()
    {
        return $this->hasMany(self::class, 'referrer_id');
    }

    /**
     * Recursively build one node of the tree.
     *
     * @param  MatrixPosition  $pos
     * @return array
     */
    protected function buildBinaryNode(MatrixPosition $pos): array
    {
        $user     = $pos->user;
        $children = $pos->children()->orderBy('position_index')->get();

        $leftPos  = $children->firstWhere('position_index', 1);
        $rightPos = $children->firstWhere('position_index', 2);

        return [
            'user_id'    => $user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'isPersonal' => $user->referrer_id === auth()->id(),
            'depth'      => $pos->depth,
            'left'       => $leftPos  ? $this->buildBinaryNode($leftPos)  : null,
            'right'      => $rightPos ? $this->buildBinaryNode($rightPos) : null,
        ];
    }    

    public function leftReferral()
    {
        return $this->hasOne(User::class, 'referrer_id')->where('side','left');
    }

    public function rightReferral()
    {
        return $this->hasOne(User::class, 'referrer_id')->where('side','right');
    }    

}
