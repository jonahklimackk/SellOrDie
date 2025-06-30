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
            $dt           = Carbon::now()->subMonths($i);
            $value        = $dt->format('Y-m');
            $months[$value] = $dt->format('F, Y');
        }

        // Determine start/end of selected month
        $start = Carbon::createFromFormat('Y-m', $currentMonth)->startOfMonth();
        $end   = (clone $start)->endOfMonth();

        // Fetch only this month’s sales
        $sales = AffiliateSale::with('buyer')
            ->where('referrer_id', $affiliateId)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        return view('affiliate.sales', compact('sales', 'months', 'currentMonth'));
    }
}
