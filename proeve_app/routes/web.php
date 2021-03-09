<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function() {
    return redirect()->route('login');
})->name('frontpage');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
