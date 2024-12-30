<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RandomOpponents extends Model
{
    protected $fillable = [
        'team_id','clicks','fighter_id','ad_id'
    ];
}
