<?php

namespace App\Livewire;

use Livewire\Component;

class Ads extends Component
{

    public $ads;

    public function __construct($ads){
        $this->ads = $ads;
    }

    public function render()
    {
        return view('livewire.ads');
    }
}
