<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

      <title>
            @section('title')
            {{ env('APP_NAME' ) }}
            @show
      </title>

      <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/bootstrap5.css') }}">
      @yield('styles')

</head>

<body>

      @include('website.layouts.navbar')

      @if (session()->has('alert'))
      <div class="container">
            <div class="row">
                  <div class="col-sm-12">
                        <x-alert type="{{ session('type') }}" message="{{ session('alert') }}" />
                  </div>
            </div>
      </div>
      @endif

      <div class="container">

            <div class="content-wrapper">
                  @yield('content')
            </div>

      </div>

      <script src="{{ asset('assets/js/jquery.js') }}"></script>
      <script src="{{ asset('assets/js/alert.js') }}"></script>
      @yield('scripts')
</body>

</html>