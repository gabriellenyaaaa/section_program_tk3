@extends('layouts.panel')
@section('title', 'Beranda')
@section('content')
@php
    $u = auth()->user();

    if ($u->role === 'dosen') {
        $matkulIds = $u->mataKuliah()->pluck('id');
        $stats = [
            ['Mahasiswa', \App\Models\User::where('role','mahasiswa')->count(), 'bi-people', 'primary'],
            ['Mata Kuliah Diampu', $matkulIds->count(), 'bi-journal-bookmark', 'success'],
            ['Jadwal Mengajar', \App\Models\Jadwal::whereIn('mata_kuliah_id', $matkulIds)->count(), 'bi-calendar-week', 'warning'],
        ];
        $menus = [
            ['Biodata', 'Lihat data diri Anda', 'bi-person-vcard', 'biodata', 'primary'],
            ['Mahasiswa', 'Lihat dan tambah mahasiswa', 'bi-people', 'dosen.mahasiswa.index', 'success'],
            ['Mata Kuliah', 'Kelola mata kuliah yang diampu', 'bi-journal-bookmark', 'dosen.matakuliah.index', 'info'],
            ['Jadwal', 'Atur jadwal dan ruangan', 'bi-calendar-week', 'dosen.jadwal.index', 'warning'],
            ['Input Nilai', 'Tugas, UTS, UAS per semester', 'bi-card-checklist', 'dosen.nilai.index', 'danger'],
            ['Tagihan', 'Buat dan kelola tagihan mahasiswa', 'bi-receipt', 'dosen.tagihan.index', 'secondary'],
        ];
    } else {
        $sks = $u->nilai()->whereNotNull('bobot')->with('mataKuliah')->get()->sum(fn ($n) => $n->mataKuliah->sks);
        $stats = [
            ['IPK', number_format($u->ipk, 2), 'bi-award', 'primary'],
            ['Total SKS', $sks, 'bi-journal-check', 'success'],
            ['Tagihan Belum Lunas', $u->tagihan()->where('status','belum')->count(), 'bi-exclamation-circle', 'danger'],
        ];
        $menus = [
            ['Biodata', 'Data diri lengkap Anda', 'bi-person-vcard', 'biodata', 'primary'],
            ['Nilai', 'Nilai tugas, UTS, UAS per semester', 'bi-card-checklist', 'mahasiswa.nilai', 'success'],
            ['Tagihan', 'Rincian tagihan per semester', 'bi-receipt', 'mahasiswa.tagihan', 'danger'],
            ['Mata Kuliah & Jadwal', 'Daftar mata kuliah, jam, dan ruangan', 'bi-calendar-week', 'mahasiswa.matkul', 'warning'],
        ];
    }
@endphp

{{-- Banner sambutan --}}
<div class="bg-grad text-white rounded-4 p-4 p-lg-5 mb-4">
    <div class="small opacity-75">{{ now()->translatedFormat('l, d F Y') }}</div>
    <h2 class="fw-bold mt-1">Selamat datang, {{ $u->name }}!</h2>
    <p class="mb-0 opacity-90">
        {{ $u->role === 'dosen' ? 'Kelola perkuliahan, nilai, dan tagihan mahasiswa dari satu tempat.' : 'Pantau nilai, jadwal kuliah, dan tagihan Anda di sini.' }}
    </p>
</div>

{{-- Ringkasan --}}
<div class="row g-3 mb-4">
    @foreach($stats as [$label, $val, $icon, $color])
        <div class="col-md-4">
            <div class="card p-3 d-flex flex-row align-items-center gap-3">
                <div class="feature-icon bg-{{ $color }}-subtle text-{{ $color }}"><i class="bi {{ $icon }}"></i></div>
                <div><div class="fs-3 fw-bold lh-1">{{ $val }}</div><div class="text-muted small">{{ $label }}</div></div>
            </div>
        </div>
    @endforeach
</div>

{{-- Informasi --}}
<div class="card p-4 mb-4">
    <h5 class="mb-3"><i class="bi bi-megaphone text-primary me-1"></i> Informasi Akademik</h5>
    <ul class="list-group list-group-flush">
        <li class="list-group-item px-0"><span class="badge bg-primary me-2">Info</span>Periksa jadwal kuliah dan ruangan secara berkala, karena dapat berubah sewaktu-waktu.</li>
        <li class="list-group-item px-0"><span class="badge bg-warning text-dark me-2">Tagihan</span>Pembayaran dilakukan sebelum tanggal jatuh tempo pada rincian tagihan.</li>
        <li class="list-group-item px-0"><span class="badge bg-success me-2">Nilai</span>Nilai akhir = 30% tugas + 30% UTS + 40% UAS. IPK diperbarui otomatis.</li>
    </ul>
</div>

{{-- Menu --}}
<h5 class="mb-3">Menu Utama</h5>
<div class="row g-3">
    @foreach($menus as [$title, $desc, $icon, $route, $color])
        <div class="col-sm-6 col-xl-4">
            <a href="{{ route($route) }}" class="text-decoration-none">
                <div class="card menu-card h-100 p-4">
                    <div class="feature-icon bg-{{ $color }}-subtle text-{{ $color }} mb-3"><i class="bi {{ $icon }}"></i></div>
                    <h5 class="text-dark mb-1">{{ $title }}</h5>
                    <p class="text-muted small mb-0">{{ $desc }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection