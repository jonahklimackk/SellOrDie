<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffiliateSale extends Model
{
    // The table name is inferred as 'affiliate_sales'

    /**
     * Mass‐assignable attributes.
     */
    protected $fillable = [
        'referrer_id',
        'buyer_id',
        'campaign',
        'amount',
    ];

    /**
     * The user who earned the sale commission.
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    /**
     * The user who made the purchase.
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
