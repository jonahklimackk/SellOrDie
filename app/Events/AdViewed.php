<?php

namespace App\Events;

use App\Models\User;
use App\Models\Ad;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdViewed
{
    use Dispatchable, SerializesModels;

    /** @var \App\Models\User */
    public User $user;

    /** @var \App\Models\Ad */
    // public Ad $ad;

    /**
     * Create a new event instance.
     *
     * @param  User  $user  The user who viewed the ad
     * @param  Ad    $ad    The ad that was viewed
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        // $this->ad   = $ad;
    }
}
