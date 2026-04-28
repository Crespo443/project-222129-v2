<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EmailVerificationController;
use Illuminate\Support\Facades\Route;



Route::get('/', [LoginController::class, 'showLoginPage']);
Route::post('/', [LoginController::class, 'processLogin']);

Route::get('/register', [RegisterController::class, 'showRegisterPage']);
Route::post('/register', [RegisterController::class, 'processRegister']);

Route::get('/email/verify', [EmailVerificationController::class, 'showNotice']);
Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend']);
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware('signed')
    ->name('verification.verify');

Route::post('/logout', [LoginController::class, 'processLogout']);

Route::get('/home', [MenuController::class, 'showHomePage']);

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

Route::get('/admin/dashboard', [MenuController::class, 'showAdminDashboard']);