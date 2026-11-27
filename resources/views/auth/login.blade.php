@extends('layouts.bs')
@section('title', 'Login')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center"><div class="col-md-6 col-lg-5">
    <div class="card p-4">
      <h3 class="text-center mb-4">Login</h3>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" required autofocus>
          @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100">Masuk</button>
      </form>
      <p class="text-center mt-3 mb-0 small">Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
    </div>
  </div></div>
</div>
@endsection