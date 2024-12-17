<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\SignupForm;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Signup extends Component
{
    public  SignupForm $signupForm;
    public function mount()
    {
        if (Auth::check()) {
            $this->redirect(Home::class, true);
        }
    }

    public function submitsignup()
    {
        $this->signupForm->store();
        session()->flash('success', 'Account created successfully');
        return $this->redirect(Signin::class, true);
    }

    public function render()
    {
        return view('livewire.pages.auth.signup');
    }
}
