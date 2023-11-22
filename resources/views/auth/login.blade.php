@extends('auth.layouts.layout')

@section('title')
Login | @parent
@endsection

@section('form')
<form action="" method="POST">

      @csrf

      @if (session()->has('alert'))
      <x-alert type="{{ session('type') }}" message="{{ session('alert') }}" />
      @endif

      <div class="form-outline mb-4">
            <input name="email" type="email" value="{{ old('email') }}" id="emailInput" required
                  placeholder="Enter your email" class="form-control form-control-md" />
            @error('email')
            <x-alert type="danger" message="{{ $message }}" />
            @enderror
      </div>

      <div class="form-outline mb-4">
            <input name="password" type="password" id="passwordInput" required placeholder="Enter your password"
                  class="form-control form-control-md" />
            @error('password')
            <x-alert type="danger" message="{{ $message }}" />
            @enderror
      </div>

      <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                  <input name="rememberme" class="form-check-input" type="checkbox" value="1" />
                  <label class="form-check-label">
                        Remember me
                  </label>
            </div>
            <a class="text-primary" href="{{ route('forgotPassword') }}">Forgot password?</a>
      </div>

      <button type="submit" class="btn btn-primary btn-md btn-block">Login</button>

      <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
      </div>

      <div class="d-flex justify-content-center">
            <a class="btn btn-primary btn-md btn-block" href="{{ route('register') }}" role="button">
                  Register new account
            </a>
      </div>

</form>
@endsection