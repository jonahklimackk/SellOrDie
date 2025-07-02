<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Laravel\Cashier\Events\InvoicePaymentSucceeded;
use Laravel\Cashier\Events\WebhookReceived;

use App\Listeners\AfterEmailVerified;
use App\Listeners\AwardCreditsOnReferral;
use App\Listeners\AwardCreditsOnLogin;
use App\Listeners\AwardCreditsOnVote;
use App\Listeners\AwardCreditsOnViewed;
use App\Listeners\HandleInvoicePaid;
use App\Listeners\HandleStripeRefund;

use App\Events\AdVoted;
use App\Events\AdViewed;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Only map Registered once, here to award referral credits:
        Registered::class => [
            AwardCreditsOnReferral::class,
        ],

        // Login event
        Login::class => [
            AwardCreditsOnLogin::class,
        ],

        // Email-verified
        Verified::class => [
            AfterEmailVerified::class,
        ],

        // Your custom vote/view events
        AdVoted::class => [
            AwardCreditsOnVote::class,
        ],
        AdViewed::class => [
            AwardCreditsOnViewed::class,
        ],

        // 1) After Stripe invoice is paid, fire your HandleInvoicePaid
        InvoicePaymentSucceeded::class => [
            HandleInvoicePaid::class,
        ],

        // 2) On any webhook Cashier accepts, catch refund events
        WebhookReceived::class => [
            HandleStripeRefund::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
