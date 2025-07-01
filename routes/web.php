<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
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
use App\Http\Controllers\TeamInvitationController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestOrderController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\DownlineController;
use App\Http\Controllers\MatrixController;
use App\Http\Controllers\AffiliateStatsController;
use App\Http\Controllers\Affiliate\SalesController;
use App\Http\Controllers\Affiliate\CommissionController;
use App\Http\Controllers\Affiliate\SplashPageController;




// override the “accept invitation” route
Route::get('/teams/invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])
->middleware(['web','auth'])
->name('invitations.accept');



/*
 * Downline
 *
 */

Route::middleware('auth')->get('/downline/tree', [DownlineController::class, 'showTree']);

Route::get('/downline', [App\Http\Controllers\DownlineController::class, 'index'])
->middleware('auth')
->name('downline.index');

Route::get('/downline/{level}', [DownlineController::class, 'showLevel'])
->middleware('auth')
->where('level', '[1-7]')
->name('downline.showLevel');



Route::middleware(['auth:sanctum', 'verified'])
->get('/my-referrals', function () {
        // eager-load if you like: ->with('personalReferrals')
    $referrals = auth()->user()->personalReferrals()->get();
    return view('personal-referrals', compact('referrals'));
})
->name('my.referrals');    



/*
 * Home stuff im not sure of 
 *
 */
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

// https://sellordie.online/upgrade/lightweight/monthly/{CHECKOUT_SESSION_ID}
// https://sellordie.online/upgrade/lightweight/yearly/{CHECKOUT_SESSION_ID}
// https://sellordie.online/upgrade/heavyweight/monthly/{CHECKOUT_SESSION_ID}
// https://sellordie.online/upgrade/heavyweight/yearly/{CHECKOUT_SESSION_ID}

// Route::get('/upgrade', [UpgradeController::class,'show']);
// Route::get('/upgrade/monthly/thankyou', [UpgradeController::class,'monthlyThankYou']);
// Route::get('/upgrade/yearly/thankyou', [UpgradeController::class,'YearlyThankYou']);

Route::get('/checkout/lightweight-monthly/success', [OrderController::class, 'lightweightMonthly'])
->name('checkout.success.lightweight_monthly');

Route::get('/checkout/lightweight-yearly/success', [OrderController::class, 'lightweightYearly'])
->name('checkout.success.lightweight_yearly');

Route::get('/checkout/heavyweight-monthly/success', [OrderController::class, 'heavyweightMonthly'])
->name('checkout.success.heavyweight_monthly');

Route::get('/checkout/heavyweight-yearly/success', [OrderController::class, 'heavyweightYearly'])
->name('checkout.success.heavyweight_yearly');


Route::get('/upgrade', function () {
    $plans = config('spark.billables.user.plans');

    return view('/upgrade.index', compact('plans'));
});


Route::get('/test-checkout', [TestOrderController::class, 'createSession']);

Route::get('/test/success',  [TestOrderController::class, 'success'])->name('test.success');
Route::get('/test/cancel',   [TestOrderController::class, 'cancel'])->name('test.cancel');








/*
 * Affiliate Tracking / Affiliate Program
 * chatgpt version
 *
 */

// your existing home
Route::get('/', [LandingPageController::class, 'index']);

// affiliate landing
Route::get('aff', [AffiliateController::class, 'landing'])
->name('affiliate.landing');

// the tracker
Route::get('aff/{username}/{campaign?}', [AffiliateController::class, 'track'])
->where('username', '[A-Za-z0-9_\-]+')
->name('affiliate.track');

Route::get('/affiliate/dashboard', [AffiliateController::class, 'dashboard'])
->middleware('auth')
->name('affiliate.dashboard');

Route::get('/affiliate/campaigns', [AffiliateController::class, 'campaigns'])
->middleware('auth')
->name('affiliate.campaigns');

Route::middleware(['auth'])
->get('/affiliate-stats', [AffiliateStatsController::class, 'index'])
->name('affiliate.stats');

Route::middleware(['auth'])
->get('/affiliate/tools', [AffiliateController::class, 'marketingTools'])
->name('affiliate.tools');

//this grouping makes it so the endpoints are actually affiliate/sales prefix
Route::middleware('auth')
->prefix('affiliate')
->name('affiliate.')
->group(function () {
         // Other affiliate routes…

         // 1️⃣ Sales view (with month filter)
   Route::get('sales', [SalesController::class, 'index'])
   ->name('sales');

   Route::get('commission', [CommissionController::class, 'index'])
   ->name('commission');
});

    

// spark handles this - it just lists products puurchased but it users the old system so propbably delete this
Route::middleware('auth')->group(function () {
    // user’s own orders
    Route::get('/orders', [OrderController::class, 'myOrders'])
    ->name('orders.index');

    // affiliate’s referral sales
    // Route::get('/affiliate/sales', [OrderController::class, 'affiliateSales'])
    // ->name('affiliate.sales');
});



/*
 * Credits
 *
 */

Route::middleware('auth')->get('/credits', [App\Http\Controllers\CreditController::class, 'overview'])
->name('credits.overview');

Route::get('/credit-adview', [AdsController::class, 'awardCredits']);


Route::get('/matrix', [MatrixController::class, 'index'])
->name('matrix')
->middleware('auth');



use App\Services\CreditService;
Route::get('/vote-fight', function () {

    $user = Auth::user();

    CreditService::handleAction(
        $user,
        'vote',
        ['ad_id' =>'']
    );
});



/*
 * Splash Pages
 * 
 *
 */

Route::get('/splash/{pageNum}', [SplashPageController::class, 'show']);




/*
 * Cashier Billing Subscriptions
 * Spark handles this, 
 *
 */


// // Subscription checkout starter
// Route::get('/subscribe/{planKey}',    [OrderController::class, 'subscribe'])
// ->name('subscriptions.checkout');

// // Subscription success / cancel callbacks
// Route::get('/subscribe/{planKey}/success', [OrderController::class, 'subscriptionSuccess'])
// ->name('subscriptions.success');
// Route::get('/subscribe/cancel', [OrderController::class, 'subscriptionCancel'])
// ->name('subscriptions.cancel');


// Route::get('/test-subscription', function () {
//     return view('test.test-subscribe');

// });


// Route::middleware(['auth'])->group(function () {

//     Route::get('subscribe/success', [SubscriptionController::class, 'success'])
//          ->name('subscriptions.success');

//     Route::get('subscribe/cancel', [SubscriptionController::class, 'cancel'])
//          ->name('subscriptions.cancel');

//     // Replace {planKey} with one of your four config keys:
//     // lightweight_monthly, lightweight_yearly, heavyweight_monthly, heavyweight_yearly
//     Route::get('subscribe/{planKey}', [SubscriptionController::class, 'checkout'])
//          ->name('subscriptions.checkout');

//     Route::post('billing/portal', [SubscriptionController::class, 'portal'])
//          ->name('billing.portal');
//      });


/*
 * Affiliate Tracking / Affiliate Program
 * http://klickdream.com/aff/username/campaign
 *
 */

// Route::get('/', [AffiliateTrackingController::class,'index']);
// Route::get('/aff/{username}', [AffiliateTrackingController::class,'aff']);
// Route::get('/aff/{username}/{campaign}', [AffiliateTrackingController::class,'affAndCampaign']);
// Route::get('/members/aff/stats', [AffiliateTrackingController::class, 'stats']);
// Route::get('members/downline', [GrowYourDownlineController::class, 'downline']);
// Route::get('members/reftools', [GrowYourDownlineController::class, 'reftools']); 
// Route::get('members/downline/level/{lv}', [GrowYourDownlineController::class, 'showDownlineLv']);



/*
 * The New Fight Redesign
 *
 */


// New Fight with frames testing

Route::get('/fights', [NewFightController::class,'fights'])->name('fights');
Route::get('/new-fight-top-frame', [NewFightController::class,'newFightTopFrame']);
Route::get('/new-fight-bottom-frame', [NewFightController::class,'newFightBottomFrame']);


//handling votes and earning credits
Route::get('/new-fight/vote/{key}/ad/{clickedAdId}',[NewFightController::class,'vote']);
Route::get('new-fight/earn-credits-top-frame/{key}', [NewFightController::class,"showTopFrameBeforeCountdown"]);
Route::get('/new-fight/already-judged-show-url-top-frame/',[NewFightController::class,'alreadyJudgedShowUrlTopFrame']);
Route::get('/new-fight/earn/redeem/{key}',[NewFightController::class, 'afterCountdown']);
Route::get('/new-fight/challenge/{key}/{icon}', [NewFightController::class,'challengeTest']);

//starting/stopping a fight
Route::post('/fight/start', [NewFightController::class,'start']);
Route::post('/fight/stop', [NewFightController::class,'stop']);
Route::post('/fight/reset', [NewFightController::class,'reset']);


//show a specific fight
Route::get('/new-fight/show/{fightId}', [NewFightController::class,'newFightSpecific']);
Route::get('/new-fight-specific-bottom-frame/{fightId}', [NewFightController::class,'newFightSpecificBottomFrame']);








/*
 * Handle Mailings
 * Mailing-ads
 */

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/send/mailing/{mailingId}', [SendMailingController::class,'index']);
//     Route::post('/mailing/store', [SendMailingController::class,'store']);
//     Route::post('/mailing/update', [SendMailingController::class,'update']);
//     Route::post('/mailing/delete', [SendMailingController::class,'destroy']);
//     Route::post('/mailing/queue', [SendMailingController::class,'queue']);
//     Route::get('/mailing/history', [SendMailingController::class,'history']);
//     Route::get('/mailing/new', [SendMailingController::class,'showNew']);    
// });

// /*
//  * Sends Mailings
//  *
//  */
// Route::get('/process/next-mailing/{from}/{to}/{sort}',[SendMailingController::class, 'processMailing']);





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

Route::get('/ai/oto', function () {
    return view('ai-output.one-time-offer');
});



Route::get('/test-verify', function() {
    // Log in as user #1 (or whichever ID exists)
    auth()->loginUsingId(1);

    // Fire off the notification
    auth()->user()->sendEmailVerificationNotification();

    return 'Dispatched—check storage/logs/laravel.log';
});


Route::get('/test-listener', function() {

    // assume your Billable is User and you have a subscription
    $user         = App\Models\User::first();
    $subscription = $user->subscriptions()->first();

    // dispatch the event (this will invoke your listener directly)
    event(new \Spark\Events\SubscriptionCreated($user, $subscription));

});