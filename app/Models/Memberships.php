<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memberships extends Model
{
    //this setup is fucking ridiculous
    //plural class name mem bershipis is mapped to membership
    //and membership model says nothing
    //so memberships = membership table
    protected $table='membership';
}
