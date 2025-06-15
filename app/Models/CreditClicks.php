<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditClicks extends Model
{
    /** @use HasFactory<\Database\Factories\CreditClicksFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipient_id', 'sender_id', 'key', 'credits','clicks','earned_credits','ip','challenge_icon'
    ];




    

}
