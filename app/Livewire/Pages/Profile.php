<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Profile extends Component
{
    #[Locked]
    public $userName;

    #[Locked]
    public $userId;

    public function mount()
    {
        $url = Request::path(); // Get the path like "@test02"
        $name = '';

        if (strpos($url, '@') !== false) {
            $name = explode('@', $url)[1]; // Extract the part after "@"
        }

        $this->userName = $name;
        if ($name != Auth::user()->username) {
            $userId = User::where('username', $name)->first()->id;
            $this->userId = $userId;
        } else {
            $this->userId = Auth::user()->id;
        }
    }

    public function render()
    {
        return view('livewire.pages.profile')->title($this->userName);
    }
}
