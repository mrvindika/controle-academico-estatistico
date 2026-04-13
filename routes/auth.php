<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*-----------------------------------------------------------------------------------
|     GUEST USER ROUTES 
|-----------------------------------------------------------------------------------*/
Route::middleware('guest')->group(function () {
    Volt::route('/', 'pages.welcome')->name('welcome');
    Volt::route('settings/users/register', 'pages.auth.register')->name('register');
    Volt::route('login', 'pages.auth.login')->name('login');
    Volt::route('settings/forgot-password', 'pages.auth.forgot-password')->name('password.request');
    Volt::route('settings/reset-password/{token}', 'pages.auth.reset-password')->name('password.reset');
});

/*------------------------------------------------------------------------------------
|     AUTHENTICATED USER ROUTES 
|------------------------------------------------------------------------------------*/
Route::middleware('auth')->group(function () {
    // Dashboard
    Volt::route('dashboard', 'pages.dashboard')->name('dashboard')->middleware('verified'); 
    Volt::route('verify-email', 'pages.auth.verify-email')->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Volt::route('confirm-password', 'pages.auth.confirm-password')->name('password.confirm');
});
