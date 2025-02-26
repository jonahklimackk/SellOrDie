<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Ads;
use App\Models\User;
use App\Models\Mailings;
use App\Models\MailingAds;
use App\Models\Categories;
use App\Helpers\SendsAMailingWithoutJobs;
use Illuminate\Http\Request;

class SendMailingController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index($mailingId)
    {
        //use this teams ad as a placeholder or just so they dcould jhave an ad loaded
        $ad = Ads::where('user_id',Auth::user()->id)->where('team_id', Auth::user()->currentTeam->id)->get()->first();

        $mailings = Mailings::where('user_id', Auth::user()->id)->where('status','!=','queued')->get()->all();

         //pulldown list
        $categories = Categories::all();


        if ($mailingId) {
            $option = $mailingId;
            $selectedMailing = Mailings::where('user_id', Auth::user()->id)->where('id',$mailingId)->get()->first();
            return view('send-mailing',compact('ad','mailings','categories','option','selectedMailing'));
        }
        else {

            $option=0;
            return view('send-mailing',compact('ad','mailings','categories','option'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

     $validatedData = $request->validate([
        'subject' => 'required|string|max:200',
        'category' => 'required|string|max:200',
        'body' => 'required|string|max:50000',
        'url' => 'required|url|max:500',
    ]);


     $newMailing = Mailings::create([

        'user_id' => Auth::user()->id,
        'team_id' => Auth::user()->currentTeam->id,
        'subject' => $request->subject,
        'category' => $request->category,
        'body'=> $request->body,
        'url' => $request->url,
        'status' => 'saved',
        'spent_credits' => 0,
        'status' => 'saved'
    ]);


     return redirect('send/mailing/'.$newMailing->id)->with('success_message', 'You have succesfully entered a new Mailing ad.');




 }

    /**
     * Display the specified resource.
    public function show(Ads $ads)
    //  */
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

     $validatedData = $request->validate([
        'subject' => 'required|string|max:200',
        'category' => 'required|string|max:200',
        'body' => 'required|string|max:50000',
        'url' => 'required|url|max:500',
    ]);

     $mailing = Mailings::find($request->id);

     if(! $mailing) {
         $newMailing = Mailings::create([       
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->currentTeam->id,
            'subject' => $request->subject,
            'category' => $request->category,
            'body'=> $request->body,
            'url' => $request->url,
            'spent_credits' => 0,
            'status' => 'saved'
        ]);
         return redirect('send/mailing/'.$newMailing->id);
     }
     else{
         $mailing->update([       
            'id', $request->id,
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->currentTeam->id,
            'subject' => $request->subject,
            'category' => $request->category,
            'body'=> $request->body,
            'url' => $request->url,
            'status' => 'saved'
        ]);
           // $mailing->save();       
         return redirect('send/mailing/'.$mailing->id);     

     }




     return redirect('send/mailing/'.$mailingAd->id);
 }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        Mailings::find($request->id)->delete();

        return redirect('send/mailing/0')->with('success_message','You have deleted your mailing');
        
    }    




        /**
     * Queue a maliing up
     */
        public function queue(request $request)
        {

            if (! $request->id)
               return redirect('/send/mailing/0')->with('message','Please enter a mailing by clicking Edit Ad or New Ad below.');

           if (! Mailings::canSendMail(Auth::user()))
               return redirect('/send/mailing/'.$request->id)->with('message','It is still not time for you to send a mailing');

           $validatedData = $request->validate([
            'subject' => 'required|string|max:200',
            'category' => 'required|string|max:200',
            'body' => 'required|string|max:50000',
            'url' => 'required|url|max:500',
        ]);


           if ($request->credits_spent > Auth::user()->credits)
            return redirect('/send/mailing/'.$request->id)->with('message',"You don't have enough credits");


        //calculate recipients
        $recipients = $request->number_people_downline + $request->mailing_bonus_credits + $request->credits_spent;

        if (! $recipients)
            return redirect('/send/mailing/'.$request->id)->with('message','You have no recipients. Please enter some credits');

        $totalUsers = User::all()->count();
        if ($recipients > $totalUsers)
            $recipients = $totalUsers;

        $newMailing = Mailings::create([       
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->currentTeam->id,
            'subject' => $request->subject,
            'category' => $request->category,
            'body'=> $request->body,
            'url' => $request->url,
            'recipients' => $recipients,
            'status' => 'queued',
            'spent_credits' => $request->credits_spent,
            'save_message' => 1,
            'send_to_downline' => 0
        ]);

        return redirect('/send/mailing/'.$newMailing->id)->with('success_message',"You have succesfully queued a mailing. It will be sent out soon.");

    }






    /**
     * show past history, stats etc
     */
    public function history()
    {

        $mailings=Mailings::where('user_id', Auth::user()->id)->where('status','!=','saved')->get()->all();

        return view('mailing-history', compact('mailings'));

    }






    /**
     * Showw the create pagwe
     */
    public function showNew(Request $request)
    {
         //pulldown list
        $categories = Categories::all();

        return view('mailing-new', compact('categories'));
        
    }   








    /**
     * Showw the create pagwe
     */
    public function processMailing($from,$to,$sort)
    {

        SendsAMailingWithoutJobs::chooseMailing($from, $to, $sort);
    } 

}



