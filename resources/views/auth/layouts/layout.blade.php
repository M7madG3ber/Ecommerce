<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
      <link rel="stylesheet" href="{{ asset('assets/css/bootstrap5.css') }}">
      <style>
            .divider:after,
            .divider:before {
                  content: "";
                  flex: 1;
                  height: 1px;
                  background: #eee;
            }

            .alert {
                  border-radius: 5px;
                  padding: 10px;
            }
      </style>
      @yield('styles')

      <title>
            @section('title')
            Ecommerce
            @show
      </title>
</head>

<body>
      <section class="vh-100">
            <div class="container py-5 h-100">
                  <div class="row d-flex align-items-center justify-content-center h-100">
                        <div class="col-md-8 col-lg-7 col-xl-6">
                              <img src="{{ asset('assets/images/draw.svg') }}" class="img-fluid" alt="Phone image">
                        </div>
                        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                              @yield('form')
                        </div>
                  </div>
            </div>
      </section>

      <script src="{{ asset('assets/js/jquery.js') }}"></script>
      <script src="{{ asset('assets/js/alert.js') }}"></script>
      @yield('scripts')
</body>

</html>