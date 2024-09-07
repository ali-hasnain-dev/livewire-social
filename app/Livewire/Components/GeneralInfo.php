<?php

namespace App\Livewire\Components;

use Carbon\Carbon;
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

    public function mount()
    {
        $user = auth()->user();
        $this->username = $user->username;
        $this->bio = $user->bio;
        $this->name = $user->name;
        $this->dob = $user->dob ? Carbon::parse($user->dob)->format('m/d/Y') : '';
        $this->image = $user->image ? asset($user->image) : asset('images/noAvatar.png');
        // dd($this->dob);
    }

    public function updateProfile()
    {
        $this->validate();
        $photoPath = $this->avatar ? $this->avatar->store('profile_images', 'public') : null;
        auth()->user()->update([
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
