<?php

namespace App\Models;

use DB;
use App\Models\User;
use App\Models\RandomOpponents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailingAds extends Model
{
    /** @use HasFactory<\Database\Factories\AdsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'subject', 'body','url','status','category','team_id'
    ];



    
}
