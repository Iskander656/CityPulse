<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Citizen\DashboardController as CitizenDashboard;
use App\Http\Controllers\Citizen\ReportController;
use App\Http\Controllers\Officer\ReportController as OfficerReportController;
use App\Http\Controllers\Officer\DashboardController as OfficerDashboard;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DepartmentController as AdminDepartmentController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use Illuminate\Support\Facades\Route;

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
            Route::get('/reports', [ReportController::class, 'index'])
                ->name('reports.index');

            Route::get('/reports/create', [ReportController::class, 'create'])
                ->name('reports.create');

            Route::post('/reports', [ReportController::class, 'store'])
                ->name('reports.store');

            Route::get('/reports/{report}', [ReportController::class, 'show'])
                ->name('reports.show');
        });

    Route::prefix('officer')
        ->name('officer.')
        ->middleware('role:department_officer')
        ->group(function () {
            Route::get('/dashboard', [OfficerDashboard::class, 'index'])
                ->name('dashboard');
            Route::get('/reports', [OfficerReportController::class, 'index'])
                ->name('reports.index');

            Route::get('/reports/{report}', [OfficerReportController::class, 'show'])
                ->name('reports.show');

            Route::patch('/reports/{report}', [OfficerReportController::class, 'update'])
                ->name('reports.update');
        });

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:administrator')
        ->group(function () {
            Route::get('/dashboard', [AdminDashboard::class, 'index'])
                ->name('dashboard');
            Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
            Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
            Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
            Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
            Route::get('/departments', [AdminDepartmentController::class, 'index'])
                ->name('departments.index');

            Route::get('/departments/create', [AdminDepartmentController::class, 'create'])
                ->name('departments.create');

            Route::post('/departments', [AdminDepartmentController::class, 'store'])
                ->name('departments.store');

            Route::get('/departments/{department}/edit', [AdminDepartmentController::class, 'edit'])
                ->name('departments.edit');

            Route::put('/departments/{department}', [AdminDepartmentController::class, 'update'])
                ->name('departments.update');

            Route::patch('/departments/{department}/toggle', [AdminDepartmentController::class, 'toggleStatus'])
                ->name('departments.toggle');
            Route::get('/reports', [AdminReportController::class, 'index'])
                ->name('reports.index');

            Route::get('/reports/{report}', [AdminReportController::class, 'show'])
                ->name('reports.show');

            Route::patch('/reports/{report}/assignment', [AdminReportController::class, 'updateAssignment'])
                ->name('reports.assignment.update');
        });
});