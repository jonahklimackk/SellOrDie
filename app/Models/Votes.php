<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Votes extends Model
{
    /** @use HasFactory<\Database\Factories\AdsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'team_id', 'ad_id','key','user_id'
    ];
}
