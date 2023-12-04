<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function createOrder(Request $request)
    {
        // get carts
        $carts = Cart::where("user_id", auth()->user()->id)
            ->with('product')
            ->get();

        // check quantity is correct
        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->quantity) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => "Product: " . $cart->product->name . " has only " . $cart->product->quantity . " quantity!"
                    ]
                );
            }
        }

        // create order
        $order = Order::create([
            'user_id' => auth()->user()->id
        ]);

        // create order details and subtract quantity
        $productIds = $carts->pluck('product_id');
        $quantity = $carts->pluck('quantity');
        $orderDetails = [];
        for ($i = 0; $i < count($productIds); $i++) {
            $orderDetails[] = [
                'product_id'    => $productIds[$i],
                'quantity'      => $quantity[$i]
            ];
            Product::where('id', $productIds[$i])
                ->decrement('quantity', $quantity[$i]);
        }
        $order->products()->sync($orderDetails);

        // delete cart
        Cart::where("user_id", auth()->user()->id)
            ->delete();

        return response()->json(
            [
                'status' => true
            ]
        );
    }
}
