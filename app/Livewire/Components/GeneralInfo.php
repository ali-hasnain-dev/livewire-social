<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GeneralInfo extends Component
{
    public $username = '';

    #[Validate('required|min:3|max:40')]
    public $first_name = '';

    public $last_name = '';

    public $gender;


    public $user;


    public function mount()
    {
        $this->user = Auth::user();
        $this->username = $this->user->username;
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->gender = $this->user->gender;
    }

    public function updateGeneralProfile()
    {
        $this->validate();
        $this->user->update([
            'first_name' => $this->first_name,
            'bio' => $this->bio ?? '',
            'dob' => $this->dob ?? '',
        ]);

        session()->flash('profile_success', 'Profile updated successfully');
    }

    public function updateAboutProfile() {}

    public function render()
    {
        return view('livewire.components.general-info');
    }
}
