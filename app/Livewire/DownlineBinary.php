<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DownlineBinary extends Component
{
    public $nodes;

    public function mount()
    {
        // Load the root position for current user
        $rootPosition = Auth::user()
            ->matrixPositions()
            ->whereNull('parent_id')
            ->with(['childrenRecursive' => function ($q) {
                $q->with('childrenRecursive');
            }])
            ->first();

        // Build a normalized binary tree array
        $this->nodes = $this->buildNode($rootPosition);
    }

    protected function buildNode($pos)
    {
        if (! $pos) {
            return null;
        }

        // get exactly two children (position_index 1 = left, 2 = right)
        $children = $pos->children()->orderBy('position_index')->get();
        $left  = $children->firstWhere('position_index', 1);
        $right = $children->firstWhere('position_index', 2);

        return [
            'id'        => $pos->id,
            'name'      => $pos->user->name,
            'email'     => $pos->user->email,
            'left'      => $this->buildNode($left),
            'right'     => $this->buildNode($right),
        ];
    }

    public function render()
    {
        return view('livewire.downline-binary');
    }
}