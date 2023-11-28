@extends('dashboard.layouts.layout')

@section('title')
Categories | @parent
@endsection

@section('content')

<!-- Content Header -->
<div class="content-header">
      <div class="container-fluid">
            <div class="row mb-2">
                  <div class="col-sm-6">
                        <h1 class="m-0">Create Category</h1>
                  </div>
            </div>
      </div>
</div>
<!-- Content Header -->

<!-- Main content -->
<div class="content">
      <div class="container-fluid">

            <form action="{{ route('categories.store') }}" method="POST">

                  @csrf

                  <div class="row">

                        @if (session()->has('alert'))
                        <div class="col-sm-6 mb-3">
                              <x-alert type="{{ session('type') }}" message="{{ session('alert') }}" />
                        </div>
                        @endif

                        <div class="col-md-6 mb-3">
                              <input name="name" type="text" value="{{ old('name') }}" required
                                    placeholder="Enter category name" class="form-control" />
                              @error('name')
                              <x-alert type="danger" message="{{ $message }}" />
                              @enderror
                        </div>
                  </div>

                  <div class="row">
                        <div class="col-md-3">
                              <button type="submit" class="btn btn-primary btn-md btn-block">Create</button>
                        </div>
                  </div>

            </form>
      </div>
</div>
<!-- Main content -->

@endsection