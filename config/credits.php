<?php
// config/credits.php

return [

    // … your existing actions …
    'actions' => [
        'ad_view'  => 1,
        'login'    => 2,
        'referral' => 10,
        'vote'     => [
            'amateur'     => ['min' => 20,  'max' => 60],
            'lightweight' => ['min' => 40,  'max' => 80],
            'heavyweight' => ['min' => 60,  'max' => 120],
        ],

        // ← add your signup action here:
        'signup'   => 500, // fixed 50-credit bonus on signup

        'display_ad' => 50,

        'admin_adjust' => null,
    ],

    // … your existing downline_vote config …
    'downline_vote'        => 1,
    'downline_vote_levels' => [
        1 => 10,
        2 => 7,
        3 => 5,
        4 => 3,
        5 => 4,
        6 => 2,
        7 => 1,
    ],

    // ← now add the downline_signup config:
    'downline_signup'        => 10,  // base if no per-level
    'downline_signup_levels' => [
        1 => 500, // direct parent of new signup gets 20
        2 => 300,
        3 => 200,
        4 => 150,
        5 => 100,
        6 => 50,
        7 => 25,
    ],

    'purchase' => [
        'lightweight' => 100000,
        'heavyweight' => 250000
    ]  

    // … rest of your config …
];
