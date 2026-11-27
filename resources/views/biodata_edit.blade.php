@extends('layouts.panel')
@section('title', 'Edit Biodata')
@section('content')
@php $u = auth()->user(); @endphp
@include('partials.alerts')
<form method="POST" action="{{ route('biodata.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card p-4 text-center">
                @if($u->photo)
                    <img src="{{ asset('storage/'.$u->photo) }}" class="avatar mx-auto" alt="Foto">
                @else
                    <span class="avatar-ph mx-auto"><i class="bi bi-person-fill"></i></span>
                @endif
                <label class="form-label mt-3 small">Ganti / tambah foto (maks 2 MB)</label>
                <input type="file" name="photo" accept="image/*" class="form-control form-control-sm">
                @if($u->photo)
                    <div class="form-check mt-2 text-start">
                        <input class="form-check-input" type="checkbox" name="hapus_foto" value="1" id="hapus_foto">
                        <label class="form-check-label small" for="hapus_foto">Hapus foto saat ini</label>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ $u->role === 'dosen' ? 'NIDN' : 'NIM' }}</label>
                        <input value="{{ $u->nim }}" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input name="name" value="{{ old('name', $u->name) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input name="username" value="{{ old('username', $u->username) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $u->email) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input name="tempat_lahir" value="{{ old('tempat_lahir', $u->tempat_lahir) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $u->tanggal_lahir->format('Y-m-d')) }}" class="form-control" required>
                    </div>
                    <div class="col-12"><hr class="my-1"><div class="small text-muted">Kosongkan password jika tidak ingin mengubahnya.</div></div>
                    <div class="col-md-6">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control" autocomplete="new-password">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('biodata') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection