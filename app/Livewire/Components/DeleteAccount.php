<?php

namespace App\Livewire\Components;

use App\Livewire\Pages\Auth\Signin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class DeleteAccount extends Component
{
    public $password;

    public $erorMessage = '';

    public function deleteAccount()
    {
        $this->validate([
            'password' => 'required'
        ]);

        if (!Hash::check($this->password, Auth::user()->password)) {
            $this->erorMessage = 'Password is incorrect';
            return;
        }

        $user = User::find(Auth::id());
        Auth::logout();
        $user->delete();

        return $this->redirect(Signin::class, true);
    }
    public function render()
    {
        return view('livewire.components.delete-account');
    }
}
