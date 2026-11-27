@extends('layouts.panel')
@section('title', 'Data Mahasiswa')
@section('content')
@php
$fields = [['nim','NIM','text'],['name','Nama Lengkap','text'],['username','Username','text'],['email','Email','email'],
           ['tempat_lahir','Tempat Lahir','text'],['tanggal_lahir','Tanggal Lahir','date'],['password','Password','password']];
@endphp
@include('partials.alerts')
<div class="card p-4 mb-4">
    <h5 class="mb-3">Tambah Mahasiswa</h5>
    <form method="POST" action="{{ route('dosen.mahasiswa.store') }}">
        @csrf
        <div class="row g-3">
            @foreach($fields as [$n,$l,$t])
                <div class="col-md-4">
                    <label class="form-label">{{ $l }}</label>
                    <input type="{{ $t }}" name="{{ $n }}" value="{{ $t==='password' ? '' : old($n) }}" class="form-control" required>
                </div>
            @endforeach
            <div class="col-md-4 d-flex align-items-end"><button class="btn btn-primary w-100">Simpan</button></div>
        </div>
    </form>
</div>
<div class="card p-4">
    <h5 class="mb-3">Daftar Mahasiswa ({{ $mahasiswa->count() }})</h5>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th>NIM</th><th>Nama</th><th>Username</th><th>TTL</th><th>IPK</th><th style="width:170px">Aksi</th></tr></thead>
            <tbody>
            @forelse($mahasiswa as $m)
                <tr>
                    <td>{{ $m->nim }}</td><td>{{ $m->name }}</td><td>{{ $m->username }}</td>
                    <td>{{ $m->tempat_lahir }}, {{ $m->tanggal_lahir->format('d-m-Y') }}</td>
                    <td><span class="badge bg-primary">{{ number_format($m->ipk,2) }}</span></td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('dosen.mahasiswa.edit', $m) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form method="POST" action="{{ route('dosen.mahasiswa.destroy', $m) }}" onsubmit="return confirm('Hapus {{ $m->name }}? Nilai, KRS, dan tagihannya ikut terhapus.')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted">Belum ada mahasiswa.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection