<?php
// config/affiliate.php

return [

    /*
    |--------------------------------------------------------------------------
    | Direct (1st-level) Commission Rate
    |--------------------------------------------------------------------------
    */
    'tiers' => [
        'amateur'      => ['commission' => 0.15],   // 5%
        'lightweight'  => ['commission' => 0.30],   // 10%
        'heavyweight'  => ['commission' => 0.50],   // 20%
    ],



    /*
    |--------------------------------------------------------------------------
    | Matrix Bonus Levels (if you use a spill-over matrix)
    |--------------------------------------------------------------------------
    */
    'matrix_levels' => 5,
    'matrix_bonus'  => [
        1 => 1.00,   // level-1 bonus credits
        2 => 0.50,   // level-2, etc.
        3 => 0.25,
        4 => 0.10,
        5 => 0.05,
    ],

];
