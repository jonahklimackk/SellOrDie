<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffiliateClick extends Model
{
    // The table name is inferred as 'affiliate_clicks', so no need to override $table.

    /**
     * Which attributes can be mass-assigned.
     */
    protected $fillable = [
        'referrer_id',
        'visitor_token',
        'campaign',
        'ip',
    ];

    /**
     * The referrer (a User) who generated this click.
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }
}
