<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = Route::current()->parameter('product');
        return [
            'name'          => "required|min:3|max:250|unique:products,name,$id,id",
            'price'         => 'required|numeric',
            'quantity'      => 'required|integer',
            'category_id'   => 'required|exists:categories,id',
            'image'         => 'nullable|mimes:jpeg,png,jpg,gif|max:1024'
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'category'
        ];
    }
}
