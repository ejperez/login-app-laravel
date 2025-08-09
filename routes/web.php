<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
    Route::get('/register', [RegistrationController::class, 'index']);
    Route::post('/register', [RegistrationController::class, 'register']);
    Route::get('/register-2', [RegistrationController::class, 'index2']);
    Route::post('/register-2', [RegistrationController::class, 'register2']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/logout', [DashboardController::class, 'logout']);
});

/**
 * APIs
 */
Route::prefix('api/v1')->group(function () {
    Route::post('/check-email', [RegistrationController::class, 'checkEmail']);
    Route::post('/check-username', [RegistrationController::class, 'checkUsername']);
});