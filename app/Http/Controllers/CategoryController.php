<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\EditRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('dashboard.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        return to_route('categories.index')
            ->with(
                [
                    'type'  => 'success',
                    'alert' => 'Category created successfully.'
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

            $category = Category::findOrFail($id);

            return view('dashboard.categories.edit', [
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return to_route('categories.index')
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

            $category = Category::findOrFail($id);

            Category::where("id", $id)
                ->update([
                    'name' => $request->name
                ]);

            return to_route('categories.index')
                ->with(
                    [
                        'type'  => 'success',
                        'alert' => 'Category updated successfully.'
                    ]
                );
        } catch (\Exception $e) {
            return to_route('categories.index')
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

            $category = Category::findOrFail($id);

            if ($category->products()->exists()) {
                return redirect()
                    ->back()
                    ->with(
                        [
                            'type'  => 'danger',
                            'alert' => 'Category has many products based on it!'
                        ]
                    );
            }

            Category::where("id", $id)
                ->delete();

            return to_route('categories.index')
                ->with(
                    [
                        'type'  => 'success',
                        'alert' => 'Category deleted successfully.'
                    ]
                );
        } catch (\Exception $e) {
            return to_route('categories.index')
                ->with(
                    [
                        'type'  => 'danger',
                        'alert' => 'Somethings be wrong, please try again!'
                    ]
                );
        }
    }
}
