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
