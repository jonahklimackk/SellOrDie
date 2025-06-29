<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class FullDownline extends Component
{
    public object $tree;

    public function mount()
    {
        // start from the authenticated user (or swap in any root)
        $this->tree = $this->buildTree(auth()->user(), false);
    }

    protected function buildTree(User $user, bool $highlight): object
    {
        $node = (object)[
            'name'       => $user->name,
            'email'      => $user->email,
            'isPersonal' => $highlight,
            'children'   => [],
        ];

        // fetch all direct referrals
        $referrals = $user->referrals()
                          ->orderBy('created_at')
                          ->get();

        foreach ($referrals as $ref) {
            // highlight if this user is in your personal downline
            $nextHighlight = $highlight || $user->id === auth()->id();
            $node->children[] = $this->buildTree($ref, $nextHighlight);
        }

        return $node;
    }

    public function render()
    {
        return view('livewire.full-downline', [
            'tree' => $this->tree,
        ]);
    }
}
