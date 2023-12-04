@extends('website.layouts.layout')

@section('title')
Home | @parent
@endsection

@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Welcome {{ auth()->user()->name }}</h1>
            </div>
        </div>
    </div>
</div>
<!-- Content Header -->

<!-- Main content -->
<div class="content mt-5">
    <div class="container-fluid">
        <div class="row">
            @foreach ($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('storage/'.$product->image->path) }}" class="card-img-top" alt="..."
                        style="height: 200px">
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::substr($product->name, 0, 10) }}</h5>
                        <p class="card-text text-primary">{{ $product->category->name }}</p>
                        <p class="card-text">Price: {{ floatval($product->price) }}</p>
                        <form action="{{ route('addToCart',$product->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Main content -->

@endsection