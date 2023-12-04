<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

                Route::get("/cart", [CartController::class, 'cart'])->name('cart');
                Route::post("/add-to-cart/{id}", [CartController::class, 'addToCart'])->name('addToCart');
                Route::delete("/delete-from-cart/{id}", [CartController::class, 'deleteFromCart'])->name('deleteFromCart');
                Route::post("/update-cart", [CartController::class, 'updateCart'])->name('updateCart');

                Route::post("/create-order", [OrderController::class, 'createOrder'])->name('createOrder');
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
