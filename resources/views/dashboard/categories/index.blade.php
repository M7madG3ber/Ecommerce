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
                        <h1 class="m-0">Categories</h1>
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
                        <a class="btn btn-primary" href="{{ route('categories.create') }}">
                              <i class="fas fa-plus-circle"></i> </a>
                  </div>

                  <div class="col-sm-12 mt-3">
                        <table class="table table-striped table-hover">
                              <thead>
                                    <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Actions</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                          <th scope="row">{{ $category->id }}</th>
                                          <td>{{ $category->name }}</td>
                                          <td class="d-flex">

                                                <form action="{{ route('categories.destroy', $category->id ) }}"
                                                      method="POST">
                                                      @csrf
                                                      @method('delete')
                                                      <button class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                      </button>
                                                </form>

                                                <a href="{{ route('categories.edit', $category->id ) }}"
                                                      class="btn btn-primary mx-2">
                                                      <i class="fas fa-edit"></i>
                                                </a>

                                          </td>
                                    </tr>
                                    @endforeach

                              </tbody>
                        </table>
                  </div>

                  <div class="col-sm-12">
                        {{ $categories->links("pagination::bootstrap-5") }}
                  </div>
            </div>
      </div>
</div>
<!-- Main content -->

@endsection