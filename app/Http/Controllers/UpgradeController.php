<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpgradeController extends Controller
{
    /**
     * Show upgrade page
     */
    public function show()
    {

        return view('upgrade.dark');

    }



    /**
     * thank you page for monthly
     */
    public function monthlyThankYou()
    {
        //give credits, change membership in usrs table

        return "thank you monthly";

    }



    /**
     * thank you page for yearly
     */
    public function yearlyThankYou()
    {

        return "thank you yearly";

    }
}
