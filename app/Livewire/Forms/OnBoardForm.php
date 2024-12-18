<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Form;


class OnBoardForm extends Form
{
    use WithFileUploads;
    public $currentStep = 1;
    public $totalSteps = 2;

    public $cover;
    public $profile;

    public $first_name;
    public $last_name;
    public $phone;
    public $dob;
    public $bio;

    public $gender;

    public function store()
    {

        if ($this->cover) {
            $coverPath = $this->cover->store('user/cover', 'public');
        }

        if ($this->profile) {
            $profilePath = $this->profile->store('user/profile', 'public');
        }

        Auth::user()->update([
            'avatar' => $this->profile ? 'storage/' . $profilePath : '',
            'cover' => $this->cover ? 'storage/' . $coverPath : '',
            'first_name' => $this->first_name ?? '',
            'last_name' => $this->last_name ?? '',
            'phone' => $this->phone ?? '',
            'dob' => $this->dob ?? '',
            'bio' => $this->bio ?? '',
            'gender' => $this->gender ?? '',
            'is_new' => 0,
        ]);
    }
}
