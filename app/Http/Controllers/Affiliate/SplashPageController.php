<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SplashPageController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function show($pageNum, $username, $campaign = '')
    {


        return view('splash.splash'.$pageNum, compact('username', 'campaign'));

    }
}
