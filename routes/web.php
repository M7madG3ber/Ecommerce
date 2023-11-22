<?php

use App\Http\Controllers\HomeController;
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
                    'website'
                ]
            ],
            function () {

                Route::get("/", [HomeController::class, 'index'])->name('home');
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
