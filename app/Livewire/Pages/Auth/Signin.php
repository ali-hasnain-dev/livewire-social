<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Signin extends Component
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required')]
    public $password;

    public function mount()
    {
        if (Auth::check()) {
            $this->redirect(Home::class, true);
        }
    }

    public function submitLogin()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
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
