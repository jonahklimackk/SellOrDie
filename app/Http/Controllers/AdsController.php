<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\User;
use App\Models\Team;
use App\Models\Ads;
use App\Models\TeamUser;
use App\Models\RandomOpponents;
use App\Models\Categories;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ad = Ads::where('user_id', Auth::user()->id)->where('team_id', Auth::user()->currentTeam->id)->get()->first();
        $categories = Categories::all();

        //for a closed fight
        $opponentsAd = Ads::where('team_id', Auth::user()->currentTeam->id)->where('user_id', '!=',Auth::user()->id)->get()->first();

        //for open fights
        if (isset($ads))
            $randomOpponents = RandomOpponents::where('team_id', $ad->team_id)->get()->first();
        else
            $randomOpponents = '';

        return view('ads', compact('ad','categories', 'opponentsAd','randomOpponents'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {

        $validatedData = $request->validate([
            'headline' => 'required|string|max:200',
            'category' => 'required|string|max:200',
            'body' => 'required|string|max:50000',
            'url' => 'required|url|max:500',
        ]);




        $ad = Ads::updateOrCreate([
            'id' => $request->id
        ],
        [
            'team_id' => Auth::user()->currentTeam->id,
            'user_id' => Auth::user()->id,
            'headline' => $request->headline,
            'category' => $request->category,
            'body'=> $request->body,
            'url' => $request->url,
            'status' => 'queued',
        ]);

        return redirect('/ads')->with('message', 'You have succesfully entered the ring. You how nave your ad. Fight!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function edit()
    {
        $ad = Ads::where('user_id', Auth::user()->id)->get()->first();
        $categories = Categories::all();                
        $opponentsAd = Ads::where('team_id', Auth::user()->currentTeam->id)->where('user_id', '!=',Auth::user()->id)->get()->first();
        return view('ads', compact('ad','categories','opponentsAd'))->with('edit', true);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ads $ads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ads $ads)
    {
        //
    }
}
