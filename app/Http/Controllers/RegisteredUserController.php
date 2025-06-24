<?php
// app/Http/Controllers/RegisteredUserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Http\Controllers\RegisteredUserController as FortifyController;

class RegisteredUserController extends FortifyController
{
    /**
     * Handle a registration request.
     */
    public function store(Request $request, CreatesNewUsers $creator): RegisterResponse
    {
        // 1) Perform validation & user creation
        $response = parent::store($request, $creator);

        // 2) Grab the newly created & logged-in user
        $user = Auth::user();

        // 3) Fire Registered event so the default listener runs
        // event(new Registered($user));

        // 4) (Optional) Force-send your custom notification
        // $user->sendEmailVerificationNotification();

        return $response;
    }
}
