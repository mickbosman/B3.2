<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\FrontpageController::class, 'index'])->name('frontpage');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout_get');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/clients/{client}/control', [App\Http\Controllers\ClientController::class, 'control_client'])->name('client.control');