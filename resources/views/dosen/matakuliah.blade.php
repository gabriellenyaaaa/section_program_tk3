@extends('layouts.panel')
@section('title', 'Mata Kuliah')
@section('content')
@include('partials.alerts')
<div class="card p-4 mb-4">
    <h5 class="mb-3">Tambah Mata Kuliah</h5>
    <form method="POST" action="{{ route('dosen.matakuliah.store') }}" class="row g-3">
        @csrf
        <div class="col-md-2"><input name="kode" value="{{ old('kode') }}" class="form-control" placeholder="Kode" required></div>
        <div class="col-md-4"><input name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Nama mata kuliah" required></div>
        <div class="col-md-2"><input type="number" name="sks" value="{{ old('sks') }}" min="1" max="6" class="form-control" placeholder="SKS" required></div>
        <div class="col-md-2">
            <select name="semester" class="form-select" required>
                @for($s=1;$s<=8;$s++)<option value="{{ $s }}" @selected(old('semester')==$s)>Semester {{ $s }}</option>@endfor
            </select>
        </div>
        <div class="col-md-2"><button class="btn btn-primary w-100">Simpan</button></div>
    </form>
</div>
<div class="card p-4">
    <h5 class="mb-3">Mata Kuliah yang Anda Ampu</h5>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light"><tr><th>Semester</th><th>Periode</th><th>Kode</th><th>Nama</th><th>SKS</th></tr></thead>
            <tbody>
            @forelse($matkul as $m)
                <tr>
                    <td>{{ $m->semester }}</td>
                    <td><span class="badge {{ $m->periode === 'Ganjil' ? 'bg-primary' : 'bg-success' }}">{{ $m->periode }}</span></td>
                    <td>{{ $m->kode }}</td><td>{{ $m->nama }}</td><td>{{ $m->sks }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection