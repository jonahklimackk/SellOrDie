<?php

namespace app\Helpers;

use App\Models\User;
use App\Models\CreditClicks;
use App\Models\Mailings;

class BuildsCreditsUrl
{

	/**
	* /build the cr3edit url including necessary 
	* tab le entrise to make it all work
	*
	* @return int
	*/
	public static function build (User $sender, User $recipient,Mailings $mailing)
	{

		//random key 40 chars long
		// $key = "6f431a093bc22dc8bd1e687b9e428e57".rand(10000000,99999999);
		$key = BuildsCreditsUrl::generateRandomString(40);

		$credits = rand(config('sellordie.lower_credits_bound'),config('sellordie.upper_credits_bound'));


		$creditClicksUrl = new CreditClicks;
		$creditClicksUrl->recipient_id = $recipient->id;
		$creditClicksUrl->sender_id = $sender->id;
		$creditClicksUrl->mailing_id = $mailing->id;
		$creditClicksUrl->key = $key;
		$creditClicksUrl->credits = $credits;
		$creditClicksUrl->clicks = 0;
		$creditClicksUrl->earned_credits = false;
		$creditClicksUrl->ip = ENV("REMOTE_ADDR");
		$creditClicksUrl->save();



		// dump($creditClicksUrl)

		return '/earn/'.$creditClicksUrl->key;

	}



	/*
	* creates a random string 
	*
	* @return string $key
	*/
	public static function generateRandomString($length = 10) 
	{
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}


}