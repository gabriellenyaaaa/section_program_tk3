@extends('layouts.bs')
@section('title', 'Register')
@section('content')
@php
$fields = [
  ['nim','NIM','text'], ['name','Nama Lengkap','text'],
  ['tempat_lahir','Tempat Lahir','text'], ['tanggal_lahir','Tanggal Lahir','date'],
  ['username','Username','text'], ['email','Email','email'],
  ['password','Password','password'], ['password_confirmation','Konfirmasi Password','password'],
];
@endphp
<div class="container py-5">
  <div class="row justify-content-center"><div class="col-lg-8">
    <div class="card p-4">
      <h3 class="text-center mb-4">Daftar Akun Baru</h3>
      <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
          @foreach($fields as [$name, $label, $type])
            <div class="col-md-6">
              <label class="form-label">{{ $label }}</label>
              <input type="{{ $type }}" name="{{ $name }}"
                     value="{{ $type === 'password' ? '' : old($name) }}"
                     class="form-control @error($name) is-invalid @enderror" required>
              @error($name) <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          @endforeach
          <div class="col-12">
            <label class="form-label">Foto (opsional, maks 2 MB)</label>
            <input type="file" name="photo" accept="image/*" class="form-control @error('photo') is-invalid @enderror">
            @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <button class="btn btn-primary w-100 mt-4">Daftar</button>
      </form>
      <p class="text-center mt-3 mb-0 small">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
  </div></div>
</div>
@endsection