<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Listeners\AfterEmailVerified;
use App\Listeners\AwardCreditsOnReferral;
use App\Listeners\AwardCreditsOnLogin;
use App\Listeners\AwardCreditsOnVote;
use App\Listeners\AwardCreditsOnViewed;

use App\Events\AdVoted;
use App\Events\AdViewed;

class EventServiceProvider extends ServiceProvider
{


    /**
     * If you’re auto-discovering, list classes to skip here.
     *
     * @var array<class-string>
     */
    // protected $dontDiscover = [
    //     \App\Listeners\HandleStripeRefund::class,
    // ];
     protected static $shouldDiscoverEvents = false;
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Referral credits when a user registers
        Registered::class => [
            AwardCreditsOnReferral::class,
        ],

        // Credits on login
        Login::class => [
            AwardCreditsOnLogin::class,
        ],

        // After email is verified
        Verified::class => [
            AfterEmailVerified::class,
        ],

        // Custom application events for votes and views
        AdVoted::class => [
            AwardCreditsOnVote::class,
        ],
        AdViewed::class => [
            AwardCreditsOnViewed::class,
        ],

        // **Note:** Stripe webhook handling is now managed
        // in your StripeWebhookController. Remove Cashier event listeners
        // for InvoicePaymentSucceeded and WebhookReceived.
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();

        // You can register additional, closure-based listeners here if needed:
        // \Illuminate\Support\Facades\Event::listen(...);
    }
}
