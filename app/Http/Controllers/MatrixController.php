<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\AffiliateSale;
use App\Models\Credit;
use App\Models\MatrixPosition;

class MatrixController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1) One-level affiliate sales
        $affiliateSales = AffiliateSale::where('referrer_id', $user->id)
                                       ->with('buyer')
                                       ->get();

        // 2) Build your matrix genealogy tree:
        $rootPos = MatrixPosition::where('user_id', $user->id)->first();

        $tree = $this->buildTree($rootPos, $user);

        return view('matrix', compact('affiliateSales', 'tree'));
    }

    /**
     * Recursively walk the matrix positions, collecting
     * credits you've earned from each downline user.
     */
    protected function buildTree(MatrixPosition $position, $currentUser)
    {
        $nodes = [];

        $children = MatrixPosition::where('parent_id', $position->id)->get();

        foreach ($children as $child) {
            $downUser = $child->user;

            // Sum of all credits you’ve earned from this specific downline user
            $creditsFromThem = Credit::where('user_id', $currentUser->id)
                                     ->where('description', 'like', "%from {$downUser->email}%")
                                     ->sum('amount');

            $nodes[] = [
                'position'    => $child,
                'user'        => $downUser,
                'credits'     => $creditsFromThem,
                'children'    => $this->buildTree($child, $currentUser),
            ];
        }

        return $nodes;
    }
}
