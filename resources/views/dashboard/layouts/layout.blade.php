<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
      <title>
            @section('title')
            Dashboard
            @show
      </title>

      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/dashboard/dist/css/adminlte.min.css') }}">
      @yield('styles')

</head>

<body class="hold-transition sidebar-mini">

      <div class="wrapper">

            {{-- @include('dashboard.layouts.nav') --}}

            @include('dashboard.layouts.aside')

            <div class="content-wrapper">
                  @yield('content')
            </div>

            {{-- @include('dashboard.layouts.footer') --}}
      </div>

      <script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/dashboard/dist/js/adminlte.min.js') }}"></script>
      <script src="{{ asset('assets/js/alert.js') }}"></script>
      @yield('scripts')

</body>

</html>