<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\SigninForm;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Signin extends Component
{
    public SigninForm $signinForm;
    public function mount()
    {
        if (Auth::check()) {
            $this->redirect(Home::class, true);
        }
    }

    public function submitLogin()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->signinForm->email, 'password' => $this->signinForm->password])) {
            return $this->redirect(Home::class, true);
        }

        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
        return view('livewire.pages.auth.signin');
    }
}
