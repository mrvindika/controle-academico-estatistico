<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*-----------------------------------------------------------------------------------
|     SYSTEM ROUTES 
|-----------------------------------------------------------------------------------*/
require __DIR__.'/auth.php';
 
/*------------------------------------------------------------------------------------
|     ASSETS ROUTES 
|------------------------------------------------------------------------------------*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Users
    Route::group(['prefix'=> 'settings'], function(){
        Volt::route('users', 'pages.users.index')->name('users.index'); 
        Volt::route('users/create', 'pages.users.create')->name('users.create'); 
        Volt::route('users/{user}', 'pages.users.show')->name('users.show'); 
    });

});

/*-------------------------------------------------------------------------------------
|     FALLBACK ROUTE 
|-------------------------------------------------------------------------------------*/
Route::fallback(fn()=> back());




