<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
@php $u = auth()->user(); @endphp

{{-- Top bar khusus HP --}}
<div class="d-lg-none bg-grad p-2 d-flex align-items-center">
    <button class="btn btn-light btn-sm me-2" data-bs-toggle="offcanvas" data-bs-target="#sidebar"><i class="bi bi-list fs-5"></i></button>
    <span class="text-white fw-bold d-flex align-items-center">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" height="28" class="me-2">
    {{ config('app.name') }}
    </span>
</div>

<aside class="offcanvas-lg offcanvas-start sidebar p-3" tabindex="-1" id="sidebar">
    <div class="d-flex align-items-center mb-3">
        <a href="{{ route('home') }}" class="text-white text-decoration-none fw-bold fs-5 d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="me-2 bg-white rounded-circle">
            {{ config('app.name') }}
        </a>
        <button class="btn-close btn-close-white d-lg-none ms-auto" data-bs-dismiss="offcanvas" data-bs-target="#sidebar"></button>
    </div>

    <div class="text-center py-3 border-top border-bottom border-light border-opacity-25 mb-2">
        @if($u->photo)
            <img src="{{ asset('storage/'.$u->photo) }}" class="mini-avatar" alt="Foto">
        @else
            <span class="mini-avatar-ph"><i class="bi bi-person-fill"></i></span>
        @endif
        <div class="fw-semibold mt-2">{{ $u->name }}</div>
        <span class="badge bg-light text-primary">{{ strtoupper($u->role) }}</span>
    </div>

    <nav class="nav flex-column">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-house-door me-2"></i>Beranda</a>
        <a class="nav-link {{ request()->routeIs('biodata*') ? 'active' : '' }}" href="{{ route('biodata') }}"><i class="bi bi-person-vcard me-2"></i>Biodata</a>

        <div class="menu-label">Akademik</div>
        @if($u->role === 'dosen')
            <a class="nav-link {{ request()->routeIs('dosen.mahasiswa.*') ? 'active' : '' }}" href="{{ route('dosen.mahasiswa.index') }}"><i class="bi bi-people me-2"></i>Mahasiswa</a>
            <a class="nav-link {{ request()->routeIs('dosen.matakuliah.*') ? 'active' : '' }}" href="{{ route('dosen.matakuliah.index') }}"><i class="bi bi-journal-bookmark me-2"></i>Mata Kuliah</a>
            <a class="nav-link {{ request()->routeIs('dosen.jadwal.*') ? 'active' : '' }}" href="{{ route('dosen.jadwal.index') }}"><i class="bi bi-calendar-week me-2"></i>Jadwal</a>
            <a class="nav-link {{ request()->routeIs('dosen.nilai.*') ? 'active' : '' }}" href="{{ route('dosen.nilai.index') }}"><i class="bi bi-card-checklist me-2"></i>Input Nilai</a>
            <a class="nav-link {{ request()->routeIs('dosen.tagihan.*') ? 'active' : '' }}" href="{{ route('dosen.tagihan.index') }}"><i class="bi bi-receipt me-2"></i>Tagihan</a>
        @else
            <a class="nav-link {{ request()->routeIs('mahasiswa.nilai') ? 'active' : '' }}" href="{{ route('mahasiswa.nilai') }}"><i class="bi bi-card-checklist me-2"></i>Nilai</a>
            <a class="nav-link {{ request()->routeIs('mahasiswa.matkul') ? 'active' : '' }}" href="{{ route('mahasiswa.matkul') }}"><i class="bi bi-calendar-week me-2"></i>Mata Kuliah &amp; Jadwal</a>
            <a class="nav-link {{ request()->routeIs('mahasiswa.tagihan') ? 'active' : '' }}" href="{{ route('mahasiswa.tagihan') }}"><i class="bi bi-receipt me-2"></i>Tagihan</a>
        @endif
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button class="btn btn-light w-100"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
    </form>
</aside>

<main class="main p-3 p-lg-4">
    <h4 class="fw-bold mb-4">@yield('title')</h4>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>