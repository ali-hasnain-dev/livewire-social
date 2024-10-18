<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Friend extends Component
{
    public $search = '';

    public $users = [];

    public function updatedSearch()
    {
        $users = User::where('id', '!=', Auth::user()->id)->where('name', 'like', '%' . $this->search . '%')->orWhere('username', 'like', '%' . $this->search . '%')->select('id', 'name', 'username', 'avatar')->get();

        $this->users = $users;
    }
    public function render()
    {
        return view('livewire.pages.friend');
    }
}
