<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DownlineMatrix extends Component
{
    public $nodes;

    public function mount()
    {
        // grab your root position
        $root = Auth::user()
            ->matrixPositions()
            ->whereNull('parent_id')
            ->with('childrenRecursive')
            ->first();

        $this->nodes = $this->buildNode($root);
    }

    protected function buildNode($pos)
    {
        if (! $pos) {
            return null;
        }

        // base payload
        $data = [
            'id'    => $pos->id,
            'name'  => $pos->user->name,
            'email' => $pos->user->email,
            'children' => [],
        ];

        // load up to 5 children, ordered by position_index
        $children = $pos->children()
                        ->orderBy('position_index')
                        ->get();

        for ($i = 1; $i <= 5; $i++) {
            $child = $children->firstWhere('position_index', $i);
            $data['children'][] = $this->buildNode($child);
        }

        return $data;
    }

    public function render()
    {
        return view('livewire.downline-matrix');
    }
}