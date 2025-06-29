<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownlineController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // assumes you created the SQL view `user_downline_counts`
        $counts = DB::table('user_downline_counts')
                    ->where('user_id', $user->id)
                    ->first();

        // if no row exists yet, you can default to zeros
        if (! $counts) {
            $counts = (object) array_fill_keys(
                array_map(fn($n) => "level{$n}_count", range(1,7)),
                0
            );
        }

        return view('downline.index', compact('counts'));
    }
}
