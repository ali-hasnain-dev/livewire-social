<?php

use App\Livewire\Pages\Auth\Signin;
use App\Livewire\Pages\Auth\Signup;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Home::class)->name('home');
Route::get('/signin', Signin::class)->name('signin');
Route::get('/signup', Signup::class)->name('signup');
