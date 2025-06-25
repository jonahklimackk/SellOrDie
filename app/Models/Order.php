<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'buyer_id', 'stripe_session_id', 'product', 'amount',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
