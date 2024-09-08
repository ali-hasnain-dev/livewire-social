<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Pages\Home;
use Illuminate\Container\Attributes\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Signin extends Component
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required')]
    public $password;

    public function submitLogin()
    {
        $this->validate();

        if (auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->reset(['email', 'password']);
            return $this->redirect(Home::class, true);
        }

        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
        return view('livewire.pages.auth.signin');
    }
}
