<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => [
            'auth'
        ]
    ],
    function () {

        /**
         * Website
         */
        Route::group(
            [
                'middleware' => [
                    'website'
                ]
            ],
            function () {

                Route::get("/", [HomeController::class, 'index'])->name('home');
            }
        );


        /**
         * Dashboard
         */
        Route::group(
            [
                'middleware' => [
                    'dashboard'
                ]
            ],
            function () {

                Route::get("/dashboard", [DashboardController::class, 'index'])->name('dashboard');
            }
        );
    }
);

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
