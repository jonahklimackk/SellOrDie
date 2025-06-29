<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class FullDownline extends Component
{
    public $tree = [];

    public function mount()
    {
        // 1) load all users
        $users = User::select('id','name','email','referrer_id')->get();

        // 2) group by referrer_id
        $byRef = $users->groupBy('referrer_id');

        // 3) recursively build tree starting from the authenticated user
        $rootId = auth()->id(); 
        $this->tree = $this->buildTree($byRef, $rootId);
    }

    private function buildTree($byRef, $parentId)
    {
        $children = $byRef->get($parentId, collect());
        return $children->map(function($user) use ($byRef) {
            return [
                'user'     => $user,
                'children' => $this->buildTree($byRef, $user->id),
            ];
        })->all();
    }

    public function render()
    {
        return view('livewire.full-downline');
    }
}
