<?php

namespace App\Livewire\Pages;

use App\Livewire\Forms\OnBoardForm;
use Livewire\WithFileUploads;
use Livewire\Component;


class OnBoard extends Component
{
    use WithFileUploads;
    public OnBoardForm $onBoardForm;

    public function incrementStep()
    {
        $this->formValidation();
        if ($this->onBoardForm->currentStep != $this->onBoardForm->totalSteps) {
            $this->onBoardForm->currentStep++;
        }
    }

    public function decrementStep()
    {

        if ($this->onBoardForm->currentStep != 1) {
            $this->onBoardForm->currentStep--;
        }
    }

    public function submit()
    {
        $this->formValidation();
        $this->onBoardForm->store();
        return $this->redirect(Home::class, true);
    }

    public function formValidation()
    {
        if ($this->onBoardForm->currentStep == 1) {
            $this->validate([
                'onBoardForm.first_name' => 'required|min:2',
                'onBoardForm.last_name' => 'nullable|string',
            ]);
        } elseif ($this->onBoardForm->currentStep == 2) {
            $this->validate([
                'onBoardForm.gender' => 'required',
                'onBoardForm.dob' => 'required',
                'onBoardForm.bio' => 'nullable|string',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.on-board');
    }
}
