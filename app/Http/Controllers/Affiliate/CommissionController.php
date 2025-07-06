<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\AffiliateSale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommissionController extends Controller
{
    public function index()
    {
        $affiliateId  = auth()->id();
        $now          = Carbon::now();
        $currentMonth = $now->month;
        $currentYear  = $now->year;

        // 1) Load persisted monthly summaries
        $rows = Commission::where('affiliate_id', $affiliateId)
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get(['year','month','amount','status','paid_at']);

        // 2) If “This Month” hasn’t been seeded yet, compute it here
        $hasCurrent = $rows->first(fn($r) => 
            $r->year  === $currentYear && 
            $r->month === $currentMonth
        );

        if (! $hasCurrent) {
            // Sum commissions POSITIVE for non-refunded, NEGATIVE for refunded
            $net = AffiliateSale::where('referrer_id', $affiliateId)
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->selectRaw(
                    'COALESCE(SUM(
                        CASE 
                          WHEN refunded = 0 THEN commission 
                          ELSE -commission 
                        END
                    ),0) as net'
                )
                ->value('net');

            $rows->prepend((object)[
                'year'    => $currentYear,
                'month'   => $currentMonth,
                'amount'  => $net,
                'status'  => 'pending',
                'paid_at' => null,
            ]);
        }

        return view('affiliate.commission', [
            'rows' => $rows,
        ]);
    }
}
