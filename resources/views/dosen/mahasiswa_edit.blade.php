@extends('layouts.panel')
@section('title', 'Edit Mahasiswa')
@section('content')
@php
$fields = [['nim','NIM','text'],['name','Nama Lengkap','text'],['username','Username','text'],['email','Email','email'],
           ['tempat_lahir','Tempat Lahir','text'],['tanggal_lahir','Tanggal Lahir','date']];
@endphp
@include('partials.alerts')
<div class="card p-4">
    <form method="POST" action="{{ route('dosen.mahasiswa.update', $mahasiswa) }}">
        @csrf @method('PUT')
        <div class="row g-3">
            @foreach($fields as [$n,$l,$t])
                <div class="col-md-6">
                    <label class="form-label">{{ $l }}</label>
                    <input type="{{ $t }}" name="{{ $n }}"
                           value="{{ old($n, $t==='date' ? $mahasiswa->tanggal_lahir->format('Y-m-d') : $mahasiswa->$n) }}"
                           class="form-control" required>
                </div>
            @endforeach
            <div class="col-md-6">
                <label class="form-label">Password Baru <span class="text-muted small">(kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password" class="form-control" autocomplete="new-password">
            </div>
        </div>
        <div class="mt-4 d-flex gap-2">
            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('dosen.mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection