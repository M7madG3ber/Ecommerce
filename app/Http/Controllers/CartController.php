<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $carts = Cart::where("user_id", auth()->user()->id)
            ->with('product')
            ->get();

        return view('website.cart', [
            'carts' => $carts
        ]);
    }
    public function addToCart(string $id)
    {
        try {
            $id = (int)($id);
            $product = Product::findOrFail($id);

            if (Cart::where("user_id", auth()->user()->id)
                ->where("product_id", $id)
                ->exists()
            ) {
                return to_route('home')
                    ->with(
                        [
                            'type'  => 'info',
                            'alert' => 'Product already in the cart.'
                        ]
                    );
            }

            Cart::create([
                'user_id'       => auth()->user()->id,
                'product_id'    => $id,
                'quantity'      => 1
            ]);

            return to_route('home')
                ->with(
                    [
                        'type'  => 'success',
                        'alert' => 'Product added to the cart.'
                    ]
                );
        } catch (\Exception $e) {
            return to_route('home')
                ->with(
                    [
                        'type'  => 'danger',
                        'alert' => 'Somethings be wrong, please try again!'
                    ]
                );
        }
    }

    public function deleteFromCart(string $id)
    {
        try {
            $id = (int)($id);
            $cart = Cart::findOrFail($id);

            Cart::where("id", $id)
                ->delete();

            return to_route('cart')
                ->with(
                    [
                        'type'  => 'success',
                        'alert' => 'Product deleted from the cart.'
                    ]
                );
        } catch (\Exception $e) {
            return to_route('home')
                ->with(
                    [
                        'type'  => 'danger',
                        'alert' => 'Somethings be wrong, please try again!'
                    ]
                );
        }
    }

    public function updateCart(Request $request)
    {
        try {
            $id = (int)($request->id);
            $cart = Cart::findOrFail($id);

            Cart::where("id", $id)
                ->update([
                    'quantity' => $request->value
                ]);

            return response()->json(
                [
                    'status' => true
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => "Somethings be wrong, please try again!"
                ]
            );
        }
    }
}
