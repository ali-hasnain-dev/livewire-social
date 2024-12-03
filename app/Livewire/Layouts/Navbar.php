<?php

namespace App\Livewire\Layouts;

use App\Livewire\Pages\Auth\Signin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Navbar extends Component
{
    public function logout()
    {
        Auth::logout();
        Session::flush();

        return $this->redirect(Signin::class, true);
    }

    public function render()
    {
        return view('livewire.layouts.navbar');
    }
}
