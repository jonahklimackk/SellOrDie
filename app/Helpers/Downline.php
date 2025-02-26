<?php

namespace app\Helpers;

use App\Models\User;
use App\Helpers\DownlineDebugger;

class Downline
{
	// const MAX_LEVEL = config('listjoe.max_level');
	const MAX_LEVEL = 6;

	//this global is needed for fast downline algo
	protected $downline = [];



	/**
	* Get the count for the downline
	*
	* @return int
	*/
	public static function getCount(User $user)
	{
		return (new Downline())->count($user, 0);
	}




	/**
	* Get the count on level x
	*
	* @return int
	*/
	public static function getCountOnLv(User $user, $level)
	{
		$downline = (new Downline())->getDownline($user, 0);
		return isset($downline[$level]) ? count($downline[$level]) : 0;
	}




/**
	* Get the count up to level x
	*
	* @return int
	*/
	public static function getCountUpToLv(User $user, $level)
	{
		$count = 0;
		for ($i = 0; $i <= $level; $i++)
			$count += self::getCountOnLv($user, $i);

		return $count;
	}





	/**
	* count the total number of people in user's downline
	*
	* @param int
	* @param int
	* @param int
	* @return int
	*/
	public function count($user, $level, $maxLevel=null)
	{
		if(is_null($maxLevel) || $maxLevel > self::MAX_LEVEL)
			$maxLevel = self::MAX_LEVEL;

		$downline = $this->getDownline($user, $level);

		$count = 0;
		foreach($downline as $referrals)
			$count += count($referrals);

		return $count;
	}





	/**
	* Get the full downline
	*
	* @param User
	* @param int level
	* @return array User
	*/
	public function getDownline(User $user, $level)
	{
		$level++;
		if($level > self::MAX_LEVEL)
			return;

		$referrals = User::where('sponsor_id', $user->id)->get()->all();
		foreach($referrals as $referral)
		{
			$this->downline[$level][] = $referral;
			self::getDownline($referral, $level);
		}

		return $this->downline;
	}






}