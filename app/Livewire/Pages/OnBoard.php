<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class OnBoard extends Component
{
    public $currentStep = 1;

    public $totalSteps = 2;

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
        $this->formValidation();
        if ($this->currentStep != 1) {
            $this->currentStep--;
        }
    }

    public function submit()
    {
        dd($this->currentStep);
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
                'bio' => 'nullable|string',
                'dob' => 'required',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.on-board');
    }
}
