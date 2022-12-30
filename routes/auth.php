<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->middleware('guest')->name('admin.login');
Route::get('/logout', [AdminAuthController::class, 'logout'])->middleware('auth:web')->name('logout');
