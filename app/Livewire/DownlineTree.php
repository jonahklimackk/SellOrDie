<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DownlineTree extends Component
{
    public $tree;

    public function mount()
    {
        // Get root positions for current user
        $positions = Auth::user()
            ->matrixPositions()
            ->whereNull('parent_id')
            ->with('childrenRecursive')
            ->get();

        $this->tree = $this->buildTree($positions);
    }

    protected function buildTree($positions)
    {
        return $positions->map(function ($pos) {
            return [
                'id'        => $pos->id,
                'user_name' => $pos->user->name,
                'email'     => $pos->user->email,
                'children'  => $this->buildTree($pos->childrenRecursive),
            ];
        });
    }

    public function render()
    {
        return view('livewire.downline-tree');
    }
}
