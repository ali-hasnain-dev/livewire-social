<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ChangePassword extends Component
{
    public $old_password;
    public $new_password;
    public $confirm_password;
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function updatePassword()
    {
        $this->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|min:6|different:old_password',
            'confirm_password' => 'required|same:new_password'
        ]);

        try {
            $this->user->update([
                'password' => Hash::make($this->new_password)
            ]);

            $this->reset(['old_password', 'new_password', 'confirm_password']);

            session()->flash('password_success', 'Password updated successfully');
        } catch (\Throwable $th) {
            Log::error('Error updating password: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.components.change-password');
    }
}
