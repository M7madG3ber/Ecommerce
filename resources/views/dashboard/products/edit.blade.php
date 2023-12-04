@extends('dashboard.layouts.layout')

@section('title')
Products | @parent
@endsection

@section('content')

<!-- Content Header -->
<div class="content-header">
      <div class="container-fluid">
            <div class="row mb-2">
                  <div class="col-sm-6">
                        <h1 class="m-0">Edit Product</h1>
                  </div>
            </div>
      </div>
</div>
<!-- Content Header -->

<!-- Main content -->
<div class="content">
      <div class="container-fluid">

            <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">

                  @csrf

                  @method('put')

                  <div class="row">

                        @if (session()->has('alert'))
                        <div class="col-sm-6 mb-3">
                              <x-alert type="{{ session('type') }}" message="{{ session('alert') }}" />
                        </div>
                        @endif

                        <div class="col-md-6 mb-3">
                              <input name="name" type="text" value="{{ $product->name }}" required
                                    placeholder="Enter product name" class="form-control" />
                              @error('name')
                              <x-alert type="danger" message="{{ $message }}" />
                              @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                              <input name="price" type="number" step="0.01" value="{{ $product->price }}" required
                                    placeholder="Enter product price" class="form-control" />
                              @error('price')
                              <x-alert type="danger" message="{{ $message }}" />
                              @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                              <input name="quantity" type="number" step="0.01" value="{{ $product->quantity }}" required
                                    placeholder="Enter product quantity" class="form-control" />
                              @error('quantity')
                              <x-alert type="danger" message="{{ $message }}" />
                              @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                              <select name="category_id" required class="form-control"
                                    value="{{ $product->category_id }}">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category->id == $category->id ?
                                          "selected" : '' }}>{{ $category->name }}</option>
                                    @endforeach
                              </select>
                              @error('category_id')
                              <x-alert type="danger" message="{{ $message }}" />
                              @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                              <input name="image" type="file" placeholder="Select product image" class="form-control" />
                              @error('image')
                              <x-alert type="danger" message="{{ $message }}" />
                              @enderror
                        </div>

                  </div>

                  <div class="row">
                        <div class="col-md-3">
                              <button type="submit" class="btn btn-primary btn-md btn-block">Save</button>
                        </div>
                  </div>

            </form>
      </div>
</div>
<!-- Main content -->

@endsection