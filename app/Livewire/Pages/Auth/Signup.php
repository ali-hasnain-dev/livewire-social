<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Signup extends Component
{
    #[Validate('required|min:3|max:40')]
    public $name;

    #[Validate('required|min:3|max:40|unique:users,username|alpha_num')]
    public $username;

    #[Validate('required|email|unique:users,email|max:40')]
    public $email;

    #[Validate('required|min:6|max:40')]
    public $password;



    public function submitsignup()
    {
        $this->validate();
        dd('submitSignup');
    }

    public function render()
    {
        return view('livewire.pages.auth.signup');
    }
}
