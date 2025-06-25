<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Events\Verified;
use App\Listeners\AfterEmailVerified;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Ensure this line is here:
        Registered::class => [
            // SendEmailVerificationNotification::class,
        ],
        Verified::class => [
            AfterEmailVerified::class,
        ],

    // Your custom events
    \App\Events\AdVoted::class       => [\App\Listeners\AwardCreditsOnVote::class],
    \App\Events\AdViewed::class      => [\App\Listeners\AwardCreditsOnViewed::class],

    // Laravel’s built-in auth events
    \Illuminate\Auth\Events\Registered::class => [
        \App\Listeners\AwardCreditsOnReferral::class,
    ],
    \Illuminate\Auth\Events\Login::class      => [
        \App\Listeners\AwardCreditsOnLogin::class,
    ],


                
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
