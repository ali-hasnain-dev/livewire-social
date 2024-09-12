<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Profile extends Component
{
    #[Locked]
    public $userName;
    #[Locked]
    public $userId;

    public function mount($name)
    {
        $this->userName = $name;
        if ($name != auth()->user()->username) {
            $userId = User::where('username', $name)->first()->id;
            $this->userId = $userId;
        } else {
            $this->userId = auth()->user()->id;
        }
    }

    public function render()
    {
        return view('livewire.pages.profile');
    }
}
