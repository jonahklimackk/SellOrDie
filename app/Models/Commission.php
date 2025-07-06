<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'affiliate_id',
        'month',
        'year',
        'amount',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'month'      => 'integer',
        'year'       => 'integer',
        'amount'     => 'decimal:2',
        'paid_at'    => 'datetime',
    ];

    // Optional: for nice accessors
    public function getLabelAttribute()
    {
        return \Carbon\Carbon::create($this->year, $this->month, 1)
                             ->format('F Y');
    }
}
