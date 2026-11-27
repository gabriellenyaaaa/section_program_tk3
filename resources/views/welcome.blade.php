@extends('layouts.bs')
@section('title', 'Home')
@section('content')
<header class="bg-grad text-white text-center py-5">
  <div class="container py-5">
    <h1 class="display-4 fw-bold">Selamat Datang di Portal Mahasiswa</h1>
    <p class="lead mb-4">Sistem informasi Akademik Terpadu - Kelola perkuliahan, jadwal, administrasi dalam satu pintu.<br><br><strong>Tahun Pembelajaran 2026/2027</strong></p>
    @auth
      <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">Ke Dashboard</a>
    @else
      <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2">Register</a>
      <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Login</a>
    @endauth
  </div>
</header>
<section class="container py-5">
  <div class="row g-4 text-center">
    <div class="col-md-4">
      <div class="card h-100 p-4">
        <div class="feature-icon bg-primary-subtle text-primary mx-auto mb-3"><i class="bi bi-calendar-week"></i></div>
        <h5>Jadwal Kuliah</h5>
        <p class="text-muted mb-0">Lihat mata kuliah, jam, dan ruangan per semester.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 p-4">
        <div class="feature-icon bg-success-subtle text-success mx-auto mb-3"><i class="bi bi-card-checklist"></i></div>
        <h5>Nilai &amp; IPK</h5>
        <p class="text-muted mb-0">Nilai tugas, UTS, UAS, dan IPK terhitung otomatis.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 p-4">
        <div class="feature-icon bg-danger-subtle text-danger mx-auto mb-3"><i class="bi bi-receipt"></i></div>
        <h5>Tagihan</h5>
        <p class="text-muted mb-0">Pantau tagihan per semester dan statusnya.</p>
      </div>
    </div>
  </div>
</section>
{{-- <section class="container py-5">
  <div class="row g-4 text-center">
    <div class="col-md-4"><div class="card p-4 h-100"><h5>Data Lengkap</h5><p class="text-muted mb-0">NIM, nama, tempat dan tanggal lahir.</p></div></div>
    <div class="col-md-4"><div class="card p-4 h-100"><h5>Aman</h5><p class="text-muted mb-0">Autentikasi Laravel Breeze.</p></div></div>
    <div class="col-md-4"><div class="card p-4 h-100"><h5>Foto Profil</h5><p class="text-muted mb-0">Unggah foto saat registrasi.</p></div></div>
  </div>
</section> --}}
@endsection