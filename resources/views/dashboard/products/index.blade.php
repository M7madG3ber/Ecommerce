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
                  <div class="col-lg-6">
                        <div class="card">
                              <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                    <p class="card-text">
                                          Some quick example text to build on the card title and make
                                          up the bulk of the card's
                                          content.
                                    </p>

                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>
<!-- Main content -->

@endsection