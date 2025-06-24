<?php

namespace app\Helpers;


use Cookie;
use App\Models\User;
use App\Models\Campaigns;
use App\Helpers\DownlineDebugger;

class AffiliateTracker
{
	const YEAR_IN_MINUTES = 60*24*365;
	const DEFAULT_CAMPAIGN_NAME = 'aff';	
	const DEFAULT_CAMPAIGN_VALUE = '/';


	/**
	* Someone clicked directly to listjoe.com
	* checks and sets affiliate, campaign appropriately
	*
	* @return void
	*/
	public static function clickedHome()
	{
		// dump('clickedHome');
		$affiliate = self::getAffiliate();
		$campaign = self::getCampaign($affiliate);

		// dump($affiliate);
		// dump($campaign);

		self::click($campaign);
		self::tag($campaign, $affiliate);

	}



	/**
	* Someone clicked http://listjoe.com/aff/username
	* checks and sets affiliate, campaign appropriately
	*
	* @param string $affiliateUsername
	* @return void
	*/
	public static function clickedAff($affiliateUsername)
	{
		// dump('clickedAFF');

		$affiliate = self::getAffiliate($affiliateUsername);
		$campaign = self::getCampaign($affiliate);

		// dump($affiliate);
		// dump($campaign);

		self::click($campaign);
		self::tag($campaign, $affiliate);

	}



	/**
	* Someone clicked directly to listjoe.com
	* checks and sets affiliate, campaign appropriately
	*
	* @param string $affiliateUsername
	* @param string $campaignName
	* @return void
	*/
	public static function clickedAffCampaign($affiliateUsername, $campaignName)
	{
		// dump('in clickedAFFCampaign');
		$affiliate = self::getAffiliate($affiliateUsername);
		$campaign = self::getCampaign($affiliate, $campaignName);


		// dump($affiliate);
		// dump($campaign);


		self::click($campaign);
		self::tag($campaign, $affiliate);

	}




	/**
	* process the click
	*
	* @param Campaign $campaign
	* @return void
	*/
	public static function click($campaign)
	{
		$campaign->unique = !(is_null(Cookie::get('aff'))) || !(is_null(Cookie::get('campaign'))) ? intval($campaign->unique) : intval($campaign->unique + 1);

		$campaign->raw += 1;
		$campaign->save();
	}



	/**
	* tag the visitor with the appropriate cookie
	*
	* @param Campaign $campaign
	* @param User $affiliate
	* @return void
	*/
	public static function tag($campaign, $affiliate)
	{
		Cookie::queue('aff',$affiliate->username, self::YEAR_IN_MINUTES);
		Cookie::queue('campaign', $campaign->value, self::YEAR_IN_MINUTES);
	}


	/**
	* tag the visitor to admin
	*
	* @return void
	*/
	public static function tagWithAdmin()
	{
		Cookie::queue('aff',config('sellordie.admin_username'), self::YEAR_IN_MINUTES);
		Cookie::queue('campaign', '/', self::YEAR_IN_MINUTES);
	}



	/**
	* get the admin user
	*
	* @return User
	*/
	public static function getAdmin()
	{
		$admin = User::find(config('sellordie.admin_id'));

		return is_null($admin) ? die("Can't find admin user") : $admin;
	}



	/**
	* Get the campaign model
	*
	* @param User $affiliate
	* @param string $campaignName
	* @return int
	*/
	public static function getCampaign(User $affiliate, $campaignName=null)
	{
		// dump('in get campaign');
	// dump($affiliate);
		// dump($campaignName);
		if(is_null($campaignName) && is_null(Cookie::get('campaign')))
			return self::createDefaultCampaign($affiliate);
		else if (is_null($campaignName) && !is_null(Cookie::get('campaign')))
		{
			// dump('cookie'.Cookie::get($campaignName));
			$campaign = Campaigns::where('affiliate_id', $affiliate->id)->where('name', $campaignName)->get()->first();
			// dump($campaign);
			return isset($campaign) ? $campaign : self::createDefaultCampaign($affiliate);

		}
		else if (!is_null($campaignName))
		{
			$campaign = Campaigns::where('affiliate_id', $affiliate->id)->where('name', $campaignName)->get()->first();

			return isset($campaign) ? $campaign : self::createCampaign($affiliate, $campaignName);
		}

	}



	/**
	* Get the Affiliate (user) model
	*
	* @param string $affiliateUsername
	* @return int
	*/
	public static function getAffiliate($affiliateUsername=null)
	{
		if(!is_null($affiliateUsername))
		{
			$affiliate = User::where('username', $affiliateUsername)->get()->first();
			return isset($affiliate) ? $affiliate : self::getAdmin();
		}
		else
		{
			$affiliateUsername = Cookie::get('aff');
			return is_null($affiliateUsername) ? self::getAdmin() : self::getAffiliate($affiliateUsername);
		}

	}


	/**
	* Creates the default admin campaign in table
	*
	* @return
	*/
	public static function createDefaultCampaign(User $affiliate)
	{
		return Campaigns::firstOrCreate([
			'affiliate_id' => $affiliate->id,
			'name' => self::DEFAULT_CAMPAIGN_NAME,
			'value' => self::DEFAULT_CAMPAIGN_VALUE
		]);
	}


	/**
	* Creates a campaign row in table for user
	*
	* @return
	*/
	public static function createCampaign(User $affiliate, $campaignName)
	{
		return Campaigns::firstOrCreate([
			'affiliate_id' => $affiliate->id,
			'name' => self::DEFAULT_CAMPAIGN_NAME,
			'value' => $campaignName
		]);
	}

	/**
	* Credits the confirmation with this campaign
	*
	* @return void
	*/
	public static function recordConfirm(int $campaignId)
	{
            $campaign = Campaigns::where('id', $campaignId)->get()->first();
            $campaign->confirms++;
            $campaign->update(['confirms', $campaign->confirms]);
            $campaign->save();
	}



	/**
	* Credits the join with this campaign
	*
	* @return void
	*/
	public static function recordJoin(int $campaignId)
	{
            $campaign = Campaigns::where('id', $campaignId)->get()->first();
            $campaign->joins++;
            $campaign->update(['joins', $campaign->joins]);
            $campaign->save();
	}



	/**
	* Credits the sale with this campaign
	*
	* @return void
	*/
	public static function recordSale(int $campaignId)
	{
            $campaign = Campaigns::where('id', $campaignId)->get()->first();
            $campaign->sales++;
            $campaign->update(['sales', $campaign->sales]);
            $campaign->save();
	}



}