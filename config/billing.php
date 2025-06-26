<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Plan → Stripe Price ID map
    |--------------------------------------------------------------------------
    | Keys here become the “plan” slug you pass around. Values are the
    | corresponding Stripe Price IDs.
    */

    'plans' => [
        'lightweight_monthly' => env('PRICE_LIGHT_MONTHLY', 'price_1Re3QlRka3jwrscG5HhWWcNB'),
        'lightweight_yearly'  => env('PRICE_LIGHT_YEARLY',  'price_1Re3RaRka3jwrscGymQ9cxdE'),
        'heavyweight_monthly' => env('PRICE_HEAVY_MONTHLY', 'price_1Re3SbRka3jwrscG4uYU3Mmz'),
        'heavyweight_yearly'  => env('PRICE_HEAVY_YEARLY',  'price_1Re3TCRka3jwrscGfAlpCy4z'),
    ],

];