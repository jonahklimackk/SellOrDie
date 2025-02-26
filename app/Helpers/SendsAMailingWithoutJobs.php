<?php

namespace app\Helpers;

use Mail;
use Auth;
use App\Mail\CreditMail;
use App\Models\User;
use App\Models\Mailings;
use App\Models\TopEmailAd;
use App\Mail\TestMail;
use App\Jobs\SendsMail;
use App\Helpers\Downline;
use App\Models\Membership;
use App\Mail\MailingCompleted;
use App\Helpers\BuildsCreditsUrl;

class SendsAMailingWithoutJobs
{

	/**
	* Do what the cron job would do
	*
	* @return int
	*/
	public static function chooseMailing($from, $to, $sort)
	{

		$queuedMailings = Mailings::where('status', 'queued')->orderBy('created_at', 'asc')->get()->all();

		if (!$queuedMailings){
			dd('no queeud mailinfgs');
			exit;
		}


		//find first paid user in DB with mailing queued
		foreach ($queuedMailings as $queuedMailing)
		{
			$sender = User::where('id', $queuedMailing->user_id)->get()->first();
			if ($sender->isUpgraded())
			{
				$nextMailing = $queuedMailing;
				$nextSender = $sender;
				break;
			}
		}
		//no paid users, get next in line user
		if (!isset($nextSender) && !isset($nextMailing))
		{
			$nextMailing = $queuedMailings[0];
			$nextSender = User::where('id', $queuedMailings[0]->user_id)->get()->first();
		}

		//send it off to the job queue for sending
		// dispatch(new SendsMail($nextSender, $nextMailing));
		SendsAMailingWithoutJobs::mailRecipients($nextSender, $nextMailing,$from,$to, $sort);
	}


  /**
     * Execute the job.
     *
     * @return void
     */
  public  static function mailRecipients($sender, $mailing,$from,$to,$sort)
  {

  	// RANDOM RECIPIENTS ALL
  	// $recipients = User::get()->random($mailing->recipients)->all();  	

  	// GET ALL SORTED
  	// $recipients = User::orderBy('id', 'asc')->get()->all();


  	// QUERY PARAMS


  	/// GRABBVING USEFRS IN ORDERED ID 1 TO LAST FOR SPECIFIC NUMRCWECIPINTS
  	//grab users sorted so that if it fail can continue on from there

  	if ($sort == 'asc')
  		$recipients = User::where('id','>=',$from)->where('id','<=', $to)->orderBy('id', 'asc')->take($mailing->recipients)->get();
  	else if ($sort == 'desc')
  		$recipients = User::where('id','<=',$from)->where('id','>=', $to)->orderBy('id', 'desc')->take($mailing->recipients)->get();



  	//STARTING FROM AN ID > NUMBER
	// $recipients = User::where('id', '>', '555')->orderBy('id', 'asc')->take($Mailing->recipients)->get();


  	foreach ($recipients as $recipient)
  	{

            //create the credits url and store it in db
  		$creditsUrl = BuildsCreditsUrl::build($sender,$recipient,$mailing);


            //enable personalization
  		$mailing->subject = str_replace("[FIRST_NAME]", $recipient->name , $mailing->subject);
  		$mailing->body = str_replace("[FIRST_NAME]", $recipient->name , $mailing->body);


            //top Email Ad in free members' email
  		if ($sender->memberships == 'free'){

                // dump('for free uesr');
  			$topEmailAd = TopEmailAd::get()->random(1)->first();
  			Mail::to($recipient)->send(new CreditMail($mailing, $sender, $recipient, $creditsUrl, $topEmailAd));
  		}
  		else  {
                // dump('in mail for pro users');
  			Mail::to($recipient)->send(new CreditMail($mailing, $sender, $recipient, $creditsUrl));
  		}
  		// $c++;
  		dump("id: ".$recipient->id." successfully sent mail to: ".$recipient->email);
  		dump($mailing->subject);
  	}


        //set mailing to sent - but not during testing
  	$mailing->status = "sent";
  	$mailing->save();

  	if ($mailing->solo)
  		$sender->solo_tokens -= 1;
  	else 
  		$sender->credits -= $mailing->credits;
  	$sender->save();

        //send an email notifying the sender of a completed mailing
  	Mail::to($sender)->send(new MailingCompleted($sender,count($recipients)));

  	dump('mailing finished');

  }


}