<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Citizen\DashboardController as CitizenDashboard;
use App\Http\Controllers\Officer\DashboardController as OfficerDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'redirectDashboard'])
        ->name('dashboard.redirect');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::prefix('citizen')
        ->name('citizen.')
        ->middleware('role:citizen')
        ->group(function () {
            Route::get('/dashboard', [CitizenDashboard::class, 'index'])
                ->name('dashboard');
        });

    Route::prefix('officer')
        ->name('officer.')
        ->middleware('role:department_officer')
        ->group(function () {
            Route::get('/dashboard', [OfficerDashboard::class, 'index'])
                ->name('dashboard');
        });

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:administrator')
        ->group(function () {
            Route::get('/dashboard', [AdminDashboard::class, 'index'])
                ->name('dashboard');
        });
});