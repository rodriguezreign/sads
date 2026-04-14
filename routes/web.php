<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

/*
|--------------------------------------------------------------------------
| User Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/report', [UserDashboardController::class, 'report'])->name('report');
    Route::post('/report', [UserDashboardController::class, 'storeReport'])->name('report.store');
    
    Route::get('/browse', [UserDashboardController::class, 'browse'])->name('browse');
    
    Route::get('/myitems', [UserDashboardController::class, 'myitems'])->name('myitems');
    
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [UserDashboardController::class, 'updatePassword'])->name('profile.password');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected + Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');
    
    Route::get('/items', function () {
        return view('admin.items');
    })->name('admin.items');
    
    Route::get('/claims', function () {
        return view('admin.claims');
    })->name('admin.claims');
    
    // Reports & Verification Routes
    Route::get('/reports', [AdminDashboardController::class, 'reports'])->name('admin.reports');
    Route::post('/reports/verify/{item}', [AdminDashboardController::class, 'verifyItem'])->name('admin.reports.verify');
    Route::post('/reports/bulk-verify', [AdminDashboardController::class, 'bulkVerify'])->name('admin.reports.bulk');
    
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
});