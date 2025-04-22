<?php

namespace App\Models;

use App\Http\Controllers\LeagueController;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
	/** @use HasFactory<\Database\Factories\FightFactory> */
	use HasFactory;


	  /**
	  * get user through mailing object
	  *
	  * @return integer
	  */
	  public function user()
	  {
	  	return $this->belongsTo(User::class);
	  }


	  /**
	  * gets the fighters in a fight
	  *
	  * @return integer
	  */
	  public function getFighters()
	  {



	  }




	  /**
	  * how does this fight rank
	  *
	  * @return integer
	  */
	  public static function getRank($fightId)
	  {		
	  	$fights = LeagueController::getLeagueStats('all');

	  	$c=1;
	  	foreach($fights as $fight){
	  		// dump($fight->id);
	  		if ($fightId == $fight->id)
	  			$ranking = $c;
	  		$c++;
	  	}

	  	//if ranking not set it isn't a fight thats live
	  	if (!isset($ranking))
	  		return 0;


	  	return $ranking;

	  }



	}
