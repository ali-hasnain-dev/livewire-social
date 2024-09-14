<?php

namespace App\Livewire\Components;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class GeneralInfo extends Component
{
    use WithFileUploads;

    public $username = '';

    #[Validate('required|min:3|max:40')]
    public $name = '';

    #[Validate('nullable|min:3|max:40')]
    public $bio;

    public $dob;

    // #[Validate('nullable|sometimes|image|max:1024')]
    public $avatar;

    public $image;
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->username = $this->user->username;
        $this->bio = $this->user->bio;
        $this->name = $this->user->name;
        $this->dob = $this->user->dob ? Carbon::parse($this->user->dob)->format('m/d/Y') : '';
        $this->image = $this->user->image ? asset($this->user->image) : asset('images/avatar4.png');
    }

    public function updateProfile()
    {
        $this->validate();
        $photoPath = $this->avatar ? $this->avatar->store('profile_images', 'public') : null;
        $this->user->update([
            'avatar' => $photoPath,
            'name' => $this->name,
            'bio' => $this->bio ?? '',
            'dob' => $this->dob ? Carbon::parse($this->dob) : "",
        ]);

        session()->flash('profile_success', 'Profile updated successfully');
    }

    public function render()
    {
        return view('livewire.components.general-info');
    }
}
