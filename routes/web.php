<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search');
Route::post('/dashboard/action', [DashboardController::class, 'action'])->name('dashboard.action');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);