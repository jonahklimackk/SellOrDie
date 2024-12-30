<?php

namespace App\Livewire;

use Auth;
use App\Models\Ads;
use Livewire\Component;

class Mailings extends Component
{

    public $ads;

    // public function __construct ($ads) {
    //     $this->ads = $ads;
    // }
    public function render()
    {
        $this->ads = Ads::where('user_id', Auth::user()->id)->get()->all();
        // dd($this->ads);
        return view('livewire.mailings')->with('ads', $this->ads);
    }
}
