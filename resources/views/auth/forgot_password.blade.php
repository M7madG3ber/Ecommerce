@extends('auth.layouts.layout')

@section('title')
Forgot Password | @parent
@endsection

@section('form')
<form action="" method="POST">

      @csrf

      @include('auth.alert')

      <div class="form-outline mb-4">
            <input name="email" type="email" value="{{ old('email') }}" required placeholder="Enter your email"
                  class="form-control form-control-md" />
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
      </div>

      <button type="submit" class="btn btn-primary btn-md btn-block">Send</button>

      @include('auth.back_to_login')

</form>
@endsection