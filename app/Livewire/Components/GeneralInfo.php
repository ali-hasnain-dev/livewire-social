<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GeneralInfo extends Component
{
    public $username = '';

    #[Validate('required|min:3|max:40')]
    public $name = '';

    #[Validate('nullable|min:3|max:40')]
    public $bio;

    public $dob;

    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->username = $this->user->username;
        $this->bio = $this->user->bio;
        $this->name = $this->user->name;
        $this->dob = $this->user->dob;
    }

    public function updateProfile()
    {
        $this->validate();
        $this->user->update([
            'name' => $this->name,
            'bio' => $this->bio ?? '',
            'dob' => $this->dob ?? '',
        ]);

        session()->flash('profile_success', 'Profile updated successfully');
    }

    public function render()
    {
        return view('livewire.components.general-info');
    }
}
