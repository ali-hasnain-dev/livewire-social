<?php

use App\Livewire\Pages\Auth\Forgetpassword;
use App\Livewire\Pages\Auth\Signin;
use App\Livewire\Pages\Auth\Signup;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Profile;
use App\Livewire\Pages\Settings;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/signin', Signin::class)->name('login');
Route::get('/signup', Signup::class)->name('signup');
Route::get('/forgot-password', Forgetpassword::class)->name('forgot-password');

Route::middleware('auth')->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/settings', Settings::class)->name('Settings');
    Route::get('/profile/{name?}', Profile::class)->name('profile');
});
