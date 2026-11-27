@extends('layouts.panel')
@section('title', 'Biodata')
@section('content')
@include('partials.alerts')
<div class="mb-3"><a href="{{ route('biodata.edit') }}" class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit Biodata</a></div>
@php $u = auth()->user(); @endphp
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card p-4 text-center">
            @if($u->photo)
                <img src="{{ asset('storage/'.$u->photo) }}" class="avatar mx-auto" alt="Foto">
            @else
                <span class="avatar-ph mx-auto"><i class="bi bi-person-fill"></i></span>
            @endif
            <h5 class="mt-3 mb-0">{{ $u->name }}</h5>
            <p class="text-muted mb-2">&#64;{{ $u->username }}</p>
            <span class="badge bg-primary">{{ strtoupper($u->role) }}</span>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card p-4">
            <h5 class="mb-3">Data Diri</h5>
            <table class="table table-borderless mb-0">
                <tr><th style="width:35%">{{ $u->role === 'dosen' ? 'NIDN' : 'NIM' }}</th><td>{{ $u->nim }}</td></tr>
                <tr><th>Nama Lengkap</th><td>{{ $u->name }}</td></tr>
                <tr><th>Username</th><td>{{ $u->username }}</td></tr>
                <tr><th>Email</th><td>{{ $u->email }}</td></tr>
                <tr><th>Tempat Lahir</th><td>{{ $u->tempat_lahir }}</td></tr>
                <tr><th>Tanggal Lahir</th><td>{{ $u->tanggal_lahir->translatedFormat('d F Y') }}</td></tr>
                <tr><th>Peran</th><td>{{ ucfirst($u->role) }}</td></tr>
                @if($u->role === 'mahasiswa')
                    <tr><th>IPK</th><td><span class="badge bg-primary fs-6">{{ number_format($u->ipk, 2) }}</span></td></tr>
                @endif
                <tr><th>Terdaftar Sejak</th><td>{{ $u->created_at->translatedFormat('d F Y') }}</td></tr>
            </table>
        </div>
    </div>
</div>
@endsection