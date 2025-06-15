<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\FightController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\SendMailingController;
use App\Http\Controllers\EarnCreditsController;
use App\Http\Controllers\AffiliateTrackingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\NewFightController;
use App\Http\Controllers\UpgradeController;
use App\Http\Controllers\AiController;
use App\Livewire\Mailings;



// Route::get('/home', function () {
//     return view('home');
// })->name('home');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/home', [HomeController::class,'index'])->name('home');


    Route::get('/dashboard', function () {
        return redirect('/home');
    })->name('dashboard');    

});



/*
 * Upgrade Processor
 *
 */

Route::get('/upgrade', [UpgradeController::class,'show']);
Route::get('/upgrade/monthly/thankyou', [UpgradeController::class,'monthlyThankYou']);
Route::get('/upgrade/yearly/thankyou', [UpgradeController::class,'YearlyThankYou']);



/*
 * Affiliate Tracking / Affiliate Program
 * http://klickdream.com/aff/username/campaign
 *
 */

Route::get('/', [AffiliateTrackingController::class,'index']);
Route::get('/aff/{username}', [AffiliateTrackingController::class,'aff']);
Route::get('/aff/{username}/{campaign}', [AffiliateTrackingController::class,'affAndCampaign']);
Route::get('/members/aff/stats', [AffiliateTrackingController::class, 'stats']);
// Route::get('members/downline', [GrowYourDownlineController::class, 'downline']);
// Route::get('members/reftools', [GrowYourDownlineController::class, 'reftools']); 
// Route::get('members/downline/level/{lv}', [GrowYourDownlineController::class, 'showDownlineLv']);





/*
 * Handle Fights
 * 
 */

//outside visitos can view fights but can't vote
Route::get('/fights', [FightController::class,'index'])->name('fights');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/fights/vote/{key}/ad/{clickedAdId}',[FightController::class,'vote']);
    Route::get('/frames/already-judged-show-url-top-frame/',[FightController::class,'alreadyJudgedShowUrlTopFrame']);
    Route::get('/fights/show/{fightId}', [FightController::class,'showSpecific']);
    Route::post('/fight/start', [FightController::class,'start']);
    Route::post('/fight/stop', [FightController::class,'stop']);
    Route::post('/fight/reset', [FightController::class,'reset']);
});

//debugging
Route::get('/fights-with-3', [FightController::class,'fightsWith3']);



/*
 * Click for Credits
 *
 */
//no need for sender username, it's all stored in creditClicks table
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('earn/{key}/', [EarnCreditsController::class, 'clickedCreditsMail']);
    Route::get('earn/redeem/{key}',[EarnCreditsController::class, 'afterCountdown']);
    Route::get('frames/earn-credits-top-frame/{key}', [EarnCreditsController::class,"showTopFrameBeforeCountdown"]);
    // Route::get('record/earn/{key}/view', [EarnCreditsController::class,'mailingRecordView']);
    Route::get('earn/{key}/', [EarnCreditsController::class, 'clickedCreditsMail']);
});





/*
 * Handle Mailings
 * Mailing-ads
 */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/send/mailing/{mailingId}', [SendMailingController::class,'index']);
    Route::post('/mailing/store', [SendMailingController::class,'store']);
    Route::post('/mailing/update', [SendMailingController::class,'update']);
    Route::post('/mailing/delete', [SendMailingController::class,'destroy']);
    Route::post('/mailing/queue', [SendMailingController::class,'queue']);
    Route::get('/mailing/history', [SendMailingController::class,'history']);
    Route::get('/mailing/new', [SendMailingController::class,'showNew']);    
});

/*
 * Sends Mailings
 *
 */
Route::get('/process/next-mailing/{from}/{to}/{sort}',[SendMailingController::class, 'processMailing']);





/*
 * Handle Ads
 *
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/ads', [AdsController::class,'index'])->name('ads');
    Route::get('/ads/edit', [AdsController::class,'edit']);
    Route::post('/ads/create', [AdsController::class,'create']);
    Route::post('/ads/delete', [AdsController::class,'delete']);
    Route::post('/ads/random-opponent', [AdsController::class,'setRandomOpponent']);    
});



/*
 * Tracking The League Stats
 *
 */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/league/{period?}', [LeagueController::class,'index'])->name('league');
});

















/*
 * TESTING AND DEBugging
 *
 */

Route::get('/league-period',[TestController::class,'showLeagueStatsInPeriod']);
Route::get('/show/creditmail',[TestController::class,'showCreditMail']);
Route::get('/test/aff', [TestController::class, 'showAffCookies']);
// Route::get('/test/league', [TestController::class, 'testLeague']);
Route::get('/fix/division-by-zero', [TestController::class, 'fixDivisionByZero']);


Route::get('/get/rank/{fightId}', function ($fightId) {
    $ranking = App\Models\Fight::getRank($fightId);

    dd($ranking);

});


Route::get('/tailwind', function () {
    return view('tailwind');

});

Route::get('/show-hide', function () {
    return view('show-hide');

});


Route::get('/assign-credits', function () {
    $users = App\Models\User::all();
    foreach($users as $user)
    {
        $user->credits = rand(100,1000);
        $user->save();
    }
});

Route::get('/get-fight-views-log/{fightId}', function ($fightId) {
    $clicks = App\Models\FightViewLog::where('fight_id', $fightId)->get()->count();
    dump($clicks);


});




Route::get('/populate-fightviewlog', function () {

    $fights = App\Models\Team::all();
    foreach ($fights as $fight){
        App\Models\FightViewLog::logView($fight->id); 
    }

});



Route::get('/ai', function () {
    return view('ai');
});

Route::get('/ckeditor', function () {
    return view('ckeditor');
});

Route::get('/froala', function () {
    return view('froala');
});

Route::get('/tiny', function () {
    return view('tiny');
});


Route::get('/hover', function () {
    return view('hover');
});

Route::get('/time', function () {
    // return date("Y/m/d")
    date_default_timezone_set('America/New_York');
    echo "Today is " . date("Y/m/d") . "<br>";
    echo "The time is " . date("h:i:sa");;
});



Route::get('/new-fight/show/{fightId}', [NewFightController::class,'newFightSpecific']);
Route::get('/new-fight-specific-bottom-frame/{fightId}', [NewFightController::class,'newFightSpecificBottomFrame']);

// New Fight with frames testing
Route::get('/new-fight', [NewFightController::class,'newFight'])->name('new-fight');
Route::get('/new-fight-top-frame', [NewFightController::class,'newFightTopFrame']);
Route::get('/new-fight-bottom-frame', [NewFightController::class,'newFightBottomFrame']);
Route::get('/new-fight/vote/{key}/ad/{clickedAdId}',[NewFightController::class,'vote']);
Route::get('new-fight/earn-credits-top-frame/{key}', [NewFightController::class,"showTopFrameBeforeCountdown"]);
Route::get('/new-fight/already-judged-show-url-top-frame/',[NewFightController::class,'alreadyJudgedShowUrlTopFrame']);
Route::get('/new-fight/earn/redeem/{key}',[NewFightController::class, 'afterCountdown']);


Route::get('/new-fight-redesign', [NewFightController::class,'newFightRedesign']);
Route::get('/new-fight-redesign-bottom-frame', [NewFightController::class,'newFightBottomFrameRedesign']);

Route::get('/new-fight-redesign2', [NewFightController::class,'newFightRedesign2']);
Route::get('/new-fight-redesign-bottom-frame2', [NewFightController::class,'newFightBottomFrameRedesign2']);



Route::get('/new-fight/challenge/{key}/{icon}', [NewFightController::class,'challengeTest']);








// 
// ai testeing stuff
// 


Route::get('/ai/newfight', function () {
    return view('ai-output.fight-redesign');
});

Route::get('/ai/icons', function () {
    return view('ai-output.challenge-icons');
});


Route::get('/ai/timer', function () {
    return view('ai-output.timer');
});
Route::get('/ai/timer3', function () {
    return view('ai-output.timer3');
});
