<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\EditRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Traits\ImageManagerTrait;

class ProductController extends Controller
{
    use ImageManagerTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::active()->paginate(10);

        return view('dashboard.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('dashboard.products.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        // create record
        $product = Product::create([
            'name'          => $request->name,
            'price'         => $request->price,
            'quantity'      => $request->quantity,
            'category_id'   => $request->category_id
        ]);

        // save image
        if ($file = $request->file('image')) {
            $path = 'images/';
            $fileData = $this->uploads($file, $path);
            $image = Image::create([
                'name' => $fileData['fileName'],
                'type' => $fileData['fileType'],
                'path' => $fileData['filePath'],
                'size' => $fileData['fileSize']
            ]);
            Product::where("id", $product->id)
                ->update([
                    'image_id' => $image->id
                ]);
        }

        return to_route('products.index')
            ->with(
                [
                    'type'  => 'success',
                    'alert' => 'Product created successfully.'
                ]
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd("Show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $id = (int)($id);

            $product = Product::findOrFail($id);
            $categories = Category::get();

            return view('dashboard.products.edit', [
                'product' => $product,
                'categories' => $categories
            ]);
        } catch (\Exception $e) {
            return to_route('products.index')
                ->with(
                    [
                        'type'  => 'danger',
                        'alert' => 'Somethings be wrong, please try again!'
                    ]
                );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id)
    {
        try {
            $id = (int)($id);

            $product = Product::findOrFail($id);

            // update record
            $product = Product::where("id", $id)
                ->update([
                    'name'          => $request->name,
                    'price'         => $request->price,
                    'quantity'      => $request->quantity,
                    'category_id'   => $request->category_id
                ]);

            // save image
            if ($file = $request->file('image')) {
                $path = 'images/';
                $fileData = $this->uploads($file, $path);
                $image = Image::create([
                    'name' => $fileData['fileName'],
                    'type' => $fileData['fileType'],
                    'path' => $fileData['filePath'],
                    'size' => $fileData['fileSize']
                ]);
                Product::where("id", $id)
                    ->update([
                        'image_id' => $image->id
                    ]);
            }

            return to_route('products.index')
                ->with(
                    [
                        'type'  => 'success',
                        'alert' => 'Product updated successfully.'
                    ]
                );
        } catch (\Exception $e) {
            return to_route('products.index')
                ->with(
                    [
                        'type'  => 'danger',
                        'alert' => 'Somethings be wrong, please try again!'
                    ]
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $id = (int)($id);

            $product = Product::findOrFail($id);

            $carts = Cart::where("product_id", $id)
                ->exists();
            $orders = Order::whereHas('products', function ($q) use ($id) {
                $q->where('product_id', $id);
            })
                ->exists();

            if ($carts || $orders) {
                Product::where("id", $id)
                    ->update([
                        'is_active' => false
                    ]);
                return to_route('products.index')
                    ->with(
                        [
                            'type'  => 'info',
                            'alert' => 'Product used in carts or orders, so make it disactive!'
                        ]
                    );
            }

            Product::where("id", $id)
                ->delete();

            return to_route('products.index')
                ->with(
                    [
                        'type'  => 'success',
                        'alert' => 'Product deleted successfully.'
                    ]
                );
        } catch (\Exception $e) {
            return to_route('products.index')
                ->with(
                    [
                        'type'  => 'danger',
                        'alert' => 'Somethings be wrong, please try again!'
                    ]
                );
        }
    }
}
