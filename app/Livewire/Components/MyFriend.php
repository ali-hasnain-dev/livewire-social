<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyFriend extends Component
{
    public $myFriends = [];

    public function mount()
    {
        $this->myFriends = Auth::user()->myFriends()->get();
    }

    public function render()
    {
        return view('livewire.components.my-friend');
    }
}
