<?php
// config/credits.php

return [

    /*
    |--------------------------------------------------------------------------
    | Credit ranges per action and membership tier
    |--------------------------------------------------------------------------
    | For each action type, you can define:
    |  • a fixed numeric value
    |  • or an array of membership tiers, each with a min/max range
    */
    'actions' => [

        // Voting: same for everyone
        'ad_view' => 1,

        // Login: same for everyone
        'login' => 2,

        // Referral: same for everyone
        'referral' => 10,

        // Ad view: varies by tier
        'vote' => [
            'amateur'     => ['min' => 20,  'max' => 60],
            'lightweight' => ['min' => 40,  'max' => 80],
            'heavyweight' => ['min' => 60,  'max' => 120],
        ],

        // You can add more actions here…
    ],

    /*
    |--------------------------------------------------------------------------
    | Matrix spill‐over bonus per level (unchanged)
    |--------------------------------------------------------------------------
    */
    'matrix_levels' => 3,
    'matrix_bonus'  => [
        1 => 5,
        2 => 3,
        3 => 1,
    ],

];
