@extends('auth.layouts.layout')

@section('title')
Register | @parent
@endsection

@section('form')
<form action="" method="POST">

      @csrf

      @include('auth.alert')

      <div class="form-outline mb-4">
            <input name="name" type="text" value="{{ old('name') }}" required placeholder="Enter your name"
                  class="form-control form-control-md" />
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
      </div>

      <div class="form-outline mb-4">
            <input name="email" type="email" value="{{ old('email') }}" required placeholder="Enter your email"
                  class="form-control form-control-md" />
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
      </div>

      <div class="form-outline mb-4">
            <input name="password" type="password" required placeholder="Enter your password"
                  class="form-control form-control-md" />
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
      </div>

      <button type="submit" class="btn btn-primary btn-md btn-block">Register</button>

      @include('auth.back_to_login')

</form>
@endsection