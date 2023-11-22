<?php

use App\Http\Controllers\DashboardController;
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
                        ]
                  ],
                  function () {

                        Route::get("/dashboard", [DashboardController::class, 'index'])->name('dashboard');
                  }
            );
      }
);

/**
 * Fullback Route
 */
Route::fallback(function () {
      return to_route('logout');
});
