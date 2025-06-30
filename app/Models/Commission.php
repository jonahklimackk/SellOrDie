<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'affiliate_sale_id',
        'affiliate_id',
        'amount',
        'due_date',
        'paid_at',
        'status',
    ];

    public function sale()
    {
        return $this->belongsTo(AffiliateSale::class, 'affiliate_sale_id');
    }

    public function affiliate()
    {
        return $this->belongsTo(User::class, 'affiliate_id');
    }
}
