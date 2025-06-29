<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class DownlineBinaryHighlight extends Component
{
    public ?object $tree = null;

    public function mount()
    {
        $this->tree = $this->buildTree(auth()->user(), false);
    }

// app/Http/Livewire/MyBinaryDownline.php

protected function buildTree(User $user, bool $highlight): object
{
    // base node
    $node = (object)[
        'name'       => $user->name,
        'email'      => $user->email,
        'isPersonal' => $highlight,
        'children'   => [],
    ];

    // loop over every referral, oldest first
    $referrals = $user->referrals()
                      ->orderBy('created_at')
                      ->get();

    foreach ($referrals as $referral) {
        // once you hit YOUR ID, mark all descendants as personal
        $nextHighlight = $highlight || $user->id === auth()->id();
        $node->children[] = $this->buildTree($referral, $nextHighlight);
    }

    return $node;
}

public function render()
{
    $rootUser = auth()->user();  // or however you get the top
    $tree = $this->buildTree($rootUser, false);

    return view('livewire.my-binary-downline', [
        'tree' => $tree,
    ]);
}
}
