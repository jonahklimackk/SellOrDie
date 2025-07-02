<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffiliateSale extends Model
{
    protected $fillable = [
        'referrer_id',
        'buyer_id',
        'campaign',
        'product',
        'amount',
        'commission',
        'stripe_payment_intent',
        'stripe_charge_id',
        'refund',
        'refund_amount',
        'refunded_at'
    ];

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
