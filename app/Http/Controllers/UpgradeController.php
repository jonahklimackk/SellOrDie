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
     * thank you page for lightweight monthly
     */
    public function lightweightMonthly()
    {
        //give credits, change membership in usrs table

        // $this->somecommonthing($var)

        return "thank you monthly";

    }



    /**
     * thank you page for lightweight yearly
     */
    public function lightweightYearly()
    {

        return "thank you yearly";

    }


    /**
     * thank you page for heavyweioght monthly
     */
    public function heavyweightMonthly()
    {
        //give credits, change membership in usrs table

        return "thank you monthly";

    }



    /**
     * thank you page for heavyweight yearly
     */
    public function heavyweightYearly()
    {

        return "thank you yearly";

    }    
}
