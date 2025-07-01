<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SplashPageController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function show($pageNum)
    {

        return view('splash.splash'.$pageNum);

    }
}
