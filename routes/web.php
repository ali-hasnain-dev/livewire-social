<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route::get('/', function () {
//     return view('welcome');
// });

Volt::route('/', 'home')->name('home');
Volt::route('/signin', 'pages.signin')->name('signin');
