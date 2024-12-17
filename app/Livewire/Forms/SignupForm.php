<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SignupForm extends Form
{

    #[Validate('required|min:3|max:40|unique:users,username|alpha_num')]
    public $username;

    #[Validate('required|email|unique:users,email|max:40')]
    public $email;

    #[Validate('required|min:6|max:40')]
    public $password;


    public function store()
    {
        $this->validate();
        $user = User::Create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // event(new Registered($user = $user));
    }
}
