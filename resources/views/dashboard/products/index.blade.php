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
                        <h1 class="m-0">Products</h1>
                  </div>
            </div>
      </div>
</div>
<!-- Content Header -->

<!-- Main content -->
<div class="content">
      <div class="container-fluid">
            <div class="row">

                  <div class="col-sm-12">
                        <a class="btn btn-primary" href="{{ route('products.create') }}">
                              <i class="fas fa-plus-circle"></i> </a>
                  </div>

                  @if (session()->has('alert'))
                  <div class="col-sm-12">
                        <x-alert type="{{ session('type') }}" message="{{ session('alert') }}" />
                  </div>
                  @endif

                  <div class="col-sm-12 mt-3">
                        <table class="table table-striped table-hover">
                              <thead>
                                    <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Price</th>
                                          <th scope="col">Quantity</th>
                                          <th scope="col">Category</th>
                                          {{-- <th scope="col">image</th> --}}
                                          <th scope="col">Actions</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                          <th scope="row">{{ $product->id }}</th>
                                          <td>{{ $product->name }}</td>
                                          <td>{{ $product->price }}</td>
                                          <td>{{ $product->quantity }}</td>
                                          <td>{{ $product->category->name }}</td>
                                          {{-- <td>
                                                <img src="{{ asset('storage/'.$product->image->path) }}" alt="">
                                          </td> --}}
                                          <td class="d-flex">

                                                <a href="{{ route('products.edit', $product->id ) }}"
                                                      class="btn btn-primary">
                                                      <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('products.destroy', $product->id ) }}"
                                                      method="POST" class="mx-2">
                                                      @csrf
                                                      @method('delete')
                                                      <button class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                      </button>
                                                </form>

                                          </td>
                                    </tr>
                                    @endforeach

                              </tbody>
                        </table>
                  </div>

                  <div class="col-sm-12">
                        {{ $products->links("pagination::bootstrap-5") }}
                  </div>
            </div>
      </div>
</div>
<!-- Main content -->

@endsection