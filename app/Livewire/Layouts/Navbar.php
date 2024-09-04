<?php

namespace App\Livewire\Layouts;

use App\Livewire\Pages\Auth\Signin;
use Illuminate\Container\Attributes\Auth;
use Livewire\Component;

class Navbar extends Component
{

    public function logout()
    {
        auth()->logout();
        return $this->redirect(Signin::class, true);
    }

    public function render()
    {
        return view('livewire.layouts.navbar');
    }
}
