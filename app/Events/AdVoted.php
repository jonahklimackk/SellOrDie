<?php
// app/Events/AdVoted.php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdVoted
{
    use Dispatchable, SerializesModels;

    public User $voter;
    public int  $adId;

    /**
     * @param  User  $voter  The user who just voted
     * @param  int   $adId   The ID of the ad they voted on
     */
    public function __construct(User $voter, int $adId)
    {
        $this->voter = $voter;
        $this->adId  = $adId;
    }
}