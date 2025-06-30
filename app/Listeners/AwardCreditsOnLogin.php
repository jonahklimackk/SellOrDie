<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Services\CreditService;

class AwardCreditsOnLogin
{
    public function handle(Login $event)
    {
        // award once per login
        CreditService::handleAction(
            $event->user,
            'login'
        );
    }
}
