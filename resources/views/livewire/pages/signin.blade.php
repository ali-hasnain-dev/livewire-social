<?php

use Livewire\Volt\Component;


new class extends Component {
use function Livewire\Volt\{rules};

    rules(['email'=>'required|email','password'=>'required']);

    $submit=function(){
        $this->validate();
    }
}; ?>

<div class="h-[calc(100vh-98px)] flex items-center justify-center">
    <div class="bg-white p-8 rounded-md shadow-md w-[400px]">
        <h1 class="mb-4 text-lg font-semibold text-blue-500">Welcome to Livewire Social</h1>
        <form class="flex flex-col gap-6" wire:submit.prevent="submit">
            <div class="flex flex-col gap-2">
                <label for="" class="text-sm">Email</label>
                <input type="text" class="w-full p-2 border border-gray-500 rounded-md" placeholder="Email" required>
                <p>{{ $errors->first('email') }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <label for="" class="text-sm">Password</label>
                <input type="password" class="w-full p-2 border border-gray-500 rounded-md" placeholder="Password"
                    required>
            </div>
            <button class="p-2 bg-blue-500 text-white rounded-md">login</button>
        </form>
        <div class="flex items-center justify-center mt-4">
            <p>Don't have an account? <a href="" wire:navigate class="text-blue-500"><b>Signup</b></a>
            </p>
        </div>
    </div>

</div>
