<?php


namespace app\Helpers;

use  Carbon\Carbon;


class SetsStartDate
{


	/**
	* seets start date to feed into raw myusql query
	*
	* @return void
	*/
	public static function setDate($period)
	{

		if ($period == 'today')
		{
			$dates['start'] = new Carbon('today');
			$dates['end'] = new Carbon();
			// dd($dates);
		}
		else if ($period == 'yesterday')
		{
			$dates['start'] = new Carbon('yesterday');
			$dates['end'] = new Carbon('today');
			// dd($dates);
		}		
		else if ($period == 'thisweek')
		{
			$dates['start'] = new Carbon('1 week ago');
			$dates['end'] = new Carbon('today');			
		}
		else if ($period == 'lastweek')
		{
			$dates['start'] = new Carbon('2 weeks ago');
			$dates['end'] = new Carbon('1 week ago');			
		}
		else if ($period == 'thismonth')	
		{
			$dates['start'] = new Carbon('1 month ago');
			$dates['end'] = new Carbon('today');	
		}
		else if ($period == 'lastmonth')	
		{
			$dates['start'] = new Carbon('2 months ago');
			$dates['end'] = new Carbon('1 month ago');	
		}
		else if ($period == 'all')	
		{
			$dates['start'] = new Carbon('20 years ago');
			$dates['end'] = new Carbon();	
		}
		else //default to today
		{
			$dates['start'] = new Carbon('yesterday');
			$dates['end'] = new Carbon('today');
		}


		return $dates;

	}
}