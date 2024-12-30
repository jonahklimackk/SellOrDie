<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ad_id',
        'name',
        'user_id',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_team' => 'boolean',
        ];
    }


     /**
     * each team has .. one user?? 
     * or two uesers    
     *
     * @return integer
     */
     public function user()
     {
        return $this->hasOne(User::class);
    }


     /**
     * alias for user
     *
     * @return integer
     */
     public function fighter()
     {
        return $this->hasMany(User::class);
    }


     /**
     * each team has only one ad
     *
     * @return integer
     */
     public function ad()
     {
        return $this->hasOne(Ads::class);
    }

    /**
     * each team has only one ad
     *
     * @return integer
     */
     public function allAds()
     {
        return Ads::where('team_id', $this->id)->get()->all();
    }






}
