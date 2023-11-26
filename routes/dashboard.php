<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(
      [
            'middleware' => [
                  'auth'
            ]
      ],
      function () {

            Route::group(
                  [
                        'middleware' => [
                              'dashboard'
                        ],
                        'prefix' => 'dashboard'
                  ],
                  function () {

                        Route::get("/", [DashboardController::class, 'index'])->name('dashboard');

                        Route::resource('categories', CategoryController::class);

                        Route::resource('products', ProductController::class);
                  }
            );
      }
);
