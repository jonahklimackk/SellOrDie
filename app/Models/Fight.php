<?php

namespace App\Models;

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

}
