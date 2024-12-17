<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithFileUploads;

class OnBoard extends Component
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

    public function incrementStep()
    {
        $this->formValidation();
        if ($this->currentStep != $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function decrementStep()
    {

        if ($this->currentStep != 1) {
            $this->currentStep--;
        }
    }

    public function submit()
    {
        $this->formValidation();
        dd('submitted');
    }

    public function formValidation()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'first_name' => 'required|min:2',
                'last_name' => 'nullable|string',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'gender' => 'required',
                'dob' => 'required',
                'bio' => 'nullable|string',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.on-board');
    }
}
