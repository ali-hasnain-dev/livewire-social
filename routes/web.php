<?php

use App\Livewire\Pages\Auth\Forgetpassword;
use App\Livewire\Pages\Auth\Signin;
use App\Livewire\Pages\Auth\Signup;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/signin', Signin::class)->name('login');
Route::get('/signup', Signup::class)->name('signup');
Route::get('/forgot-password', Forgetpassword::class)->name('forgot-password');

Route::middleware('auth')->group(function () {
    Route::get('/', Home::class)->name('home');
});
