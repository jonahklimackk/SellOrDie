<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\FightController;
use App\Http\Controllers\SendMailingController;
use App\Http\Controllers\EarnCreditsController;
use App\Livewire\Mailings;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upgrade', function () {
    return view('upgrade.show')->name('upgrade');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


//check this person's stats
Route::get('/stats', function () {
    return view('stats');
})->name('stats');


//check stats on all ds and fighters
Route::get('/league', function () {
    return view('league');
})->name('league');



/*
 * Click for Credits
 *
 */
//listjoe.com/earn/6f431a093bc22dc8bd1e687b9e428e57/jonahslistbuilders
//no need for sender username, it's all stored in creditClicks table
Route::get('earn/{key}/', [EarnCreditsController::class, 'clickedCreditsMail']);
Route::get('earn/redeem/{key}',[EarnCreditsController::class, 'afterCountdown']);
Route::get('frames/earn-credits-top-frame/{key}', [EarnCreditsController::class,"showTopFrameBeforeCountdown"]);
// Route::get('record/earn/{key}/view', [EarnCreditsController::class,'mailingRecordView']);




Route::get('/fight', [FightController::class,'index'])->name('fight');
Route::get('/fights/vote/{key}/ad/{adId}',[FightController::class,'vote']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/mailing', [SendMailingController::class,'index'])->name('mailing');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/ads', [AdsController::class,'index'])->name('ads');
    Route::get('/ads/edit', [AdsController::class,'edit']);
    Route::post('/ads/create', [AdsController::class,'create']);
});

// Route::get('/ads', [App\Livewire\Ads::class,'render'])->name('ads');



Route::get('/tailwind', function () {
    return view('tailwind');

});

Route::get('/assign-credits', function () {
    $users = App\Models\User::all();
    foreach($users as $user)
    {
        $user->credits = rand(100,1000);
        $user->save();
    }
});

