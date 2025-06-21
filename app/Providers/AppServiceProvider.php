<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController as Vendor;
use App\Http\Controllers\TeamInvitationController as Custom;
use Laravel\Fortify\Http\Controllers\RegisteredUserController as FortifyReg;
use App\Http\Controllers\RegisteredUserController as MyReg;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Vendor::class, Custom::class);
        $this->app->bind(FortifyReg::class, MyReg::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
