<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownlineController extends Controller
{
    /**
     * Display the downline overview.
     */
    public function index()
    {
        $user = auth()->user();

        $counts = DB::table('user_downline_counts')
                    ->where('user_id', $user->id)
                    ->first();

        if (! $counts) {
            // default zero counts if no view entry yet
            $counts = (object) array_fill_keys(
                array_map(fn($n) => "level{$n}_count", range(1,7)),
                0
            );
        }

        return view('downline.index', compact('counts'));
    }

    /**
     * Show referrals for a specific downline level (1-7).
     */
 public function showLevel(int $level)
{
    $user = auth()->user();

    // 1) Grab only the IDs at that level via recursive CTE
    $sql = <<<'SQL'
WITH RECURSIVE downline AS (
  SELECT id, referrer_id, 1 AS lvl
    FROM users
   WHERE referrer_id = ?

  UNION ALL

  SELECT u.id, u.referrer_id, d.lvl + 1
    FROM users u
    JOIN downline d ON u.referrer_id = d.id
   WHERE d.lvl < ?
)
SELECT id
  FROM downline
 WHERE lvl = ?;
SQL;

    $bindings = [$user->id, $level, $level];
    $rows     = DB::select($sql, $bindings);

    // 2) Extract the IDs and load full User models
    $ids = array_map(fn($r) => $r->id, $rows);

    $referrals = User::whereIn('id', $ids)
                     ->orderBy('name')
                     ->get(); 

    // 3) Pass real User models to the view
    return view('downline.level', compact('referrals', 'level'));
}


}
