<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Validate;

class Forgetpassword extends Component
{

    #[Validate('required|email|exists:users,email')]
    public $email;

    public function forgotPassword()
    {
        $this->validate();

        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', 'Password reset link sent!');
    }
    public function render()
    {
        return view('livewire.pages.auth.forgetpassword');
    }
}
