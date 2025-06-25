<?php
// app/Http/Controllers/CreditController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Credit;

class CreditController extends Controller
{
    public function overview(Request $request)
    {
        $userId = Auth::id();

        // 1) Total credits
        $total = Credit::where('user_id', $userId)->sum('amount');

        // 2) Spill-over credits (types ending in "_spillover")
        $spillover = Credit::where('user_id', $userId)
                            ->where('type', 'like', '%_spillover')
                            ->sum('amount');

        // 3) Base credits = total – spillover
        $base = $total - $spillover;

        // 4) Breakdown by type
        $byType = Credit::where('user_id', $userId)
                        ->selectRaw("type, SUM(amount) as total")
                        ->groupBy('type')
                        ->orderBy('total', 'desc')
                        ->get();

        return view('credits.overview', compact('total','base','spillover','byType'));
    }
}
