<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $affiliateId  = auth()->id();
        $currentMonth = $request->get('month', Carbon::now()->format('Y-m'));

        // Build last 12 months for dropdown
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $dt            = Carbon::now()->subMonths($i);
            $months[$dt->format('Y-m')] = $dt->format('F, Y');
        }

        // Compute start/end of selected month
        $start = Carbon::createFromFormat('Y-m', $currentMonth)->startOfMonth();
        $end   = (clone $start)->endOfMonth();

        // Fetch commissions due in that month
        $commissions = Commission::with('sale')
            ->where('affiliate_id', $affiliateId)
            ->whereBetween('due_date', [$start, $end])
            ->get();

        return view('affiliate.commission', compact(
            'commissions',
            'months',
            'currentMonth'
        ));
    }
}
