<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\AffiliateSale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $affiliateId  = auth()->id();
        $currentMonth = $request->get('month', Carbon::now()->format('Y-m'));

    // Build the last 12 months dropdown
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $dt = Carbon::now()->subMonths($i);
            $months[$dt->format('Y-m')] = $dt->format('F, Y');
        }

    // Start/end of selected month
        $start = Carbon::createFromFormat('Y-m', $currentMonth)->startOfMonth();
        $end   = (clone $start)->endOfMonth();

    // Non-refunded sales
        $sales = AffiliateSale::with('buyer')
        ->where('referrer_id', $affiliateId)
        ->where('refunded', false)
        ->whereBetween('created_at', [$start, $end])
        ->get();

    // Refunded sales
        $refundedSales = AffiliateSale::with('buyer')
        ->where('referrer_id', $affiliateId)
        ->where('refunded', true)
        ->whereBetween('created_at', [$start, $end])
        ->get();

    // Totals
        $totalCommission    = $sales->sum('commission');
        $refundedCommission = $refundedSales->sum('commission');
        $netCommission      = $totalCommission - $refundedCommission;

        return view('affiliate.sales', compact(
            'sales',
            'refundedSales',
            'months',
            'currentMonth',
            'totalCommission',
            'refundedCommission',
            'netCommission'
        ));
    }

}
