<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AboutInfo extends Component
{

    #[Validate('nullable|min:3|max:255')]
    public $bio;

    public $phone;
    public $dob;

    public $user;

    public $showMessage = false;

    public function mount()
    {
        $this->user = Auth::user();
        $this->bio = $this->user->bio;
        $this->phone = $this->user->phone;
        $this->dob = $this->user->dob;
    }

    public function updateAbout()
    {
        $this->validate();
        $this->user->update([
            'bio' => $this->bio ?? '',
            'phone' => $this->phone,
            'dob' => $this->dob,
        ]);

        $this->showMessage = true;
    }

    public function render()
    {
        return view('livewire.components.about-info');
    }
}
