<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * Login Routes
 */
Route::get("/login", [AuthController::class, 'login'])->name('login');
Route::post("/login", [AuthController::class, 'doLogin']);

Route::get("/logout", [AuthController::class, 'logout'])->name('logout');

Route::get("/register", [AuthController::class, 'register'])->name('register');
Route::post("/register", [AuthController::class, 'doRegister']);

Route::get("/forgot-password", [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::post("/forgot-password", [AuthController::class, 'doForgotPassword']);

Route::get("/reset-password/{token}", [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post("/reset-password/{token}", [AuthController::class, 'doResetPassword']);
