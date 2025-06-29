<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // or wherever your User/referral lives

class FullDownlineController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // buildTree() is your recursive transformer
        $tree = $this->buildTree($user->referrals()->with('referrals')->get());
  
        // pass $tree into the Blade
        return view('full-downline', compact('tree'));
    }

    private function buildTree($nodes)
    {
        return $nodes->map(function($node) {
            return [
                'name'       => $node->name,
                'email'      => $node->email,
                'isPersonal' => true,
                'children'   => $this->buildTree($node->referrals),
            ];
        })->toArray();
    }
}
