@extends('layouts.panel')
@section('title', 'Tagihan Mahasiswa')
@section('content')
@include('partials.alerts')
<div class="card p-4 mb-4">
    <h5 class="mb-3">Tambah Tagihan</h5>
    <form method="POST" action="{{ route('dosen.tagihan.store') }}" class="row g-3">
        @csrf
        <div class="col-md-4">
            <select name="mahasiswa_id" class="form-select" required>
                <option value="">-- Mahasiswa --</option>
                @foreach($mahasiswa as $m)<option value="{{ $m->id }}" @selected(old('mahasiswa_id')==$m->id)>{{ $m->nim }} - {{ $m->name }}</option>@endforeach
            </select>
        </div>
        <div class="col-md-2"><input type="number" name="semester" min="1" max="14" value="{{ old('semester') }}" class="form-control" placeholder="Semester" required></div>
        <div class="col-md-3"><input name="keterangan" value="{{ old('keterangan') }}" class="form-control" placeholder="Keterangan (UKT, dll)" required></div>
        <div class="col-md-3"><input type="number" name="jumlah" min="1" value="{{ old('jumlah') }}" class="form-control" placeholder="Jumlah (Rp)" required></div>
        <div class="col-md-3"><label class="form-label small mb-0">Jatuh tempo</label><input type="date" name="jatuh_tempo" value="{{ old('jatuh_tempo') }}" class="form-control" required></div>
        <div class="col-md-3 d-flex align-items-end"><button class="btn btn-primary w-100">Simpan</button></div>
    </form>
</div>
<div class="card p-4">
    <h5 class="mb-3">Daftar Tagihan</h5>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Mahasiswa</th><th>Smt</th><th>Keterangan</th><th>Jumlah</th><th>Jatuh Tempo</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
            @forelse($tagihan as $t)
                <tr>
                    <td>{{ $t->mahasiswa->nim }} - {{ $t->mahasiswa->name }}</td>
                    <td>{{ $t->semester }}</td><td>{{ $t->keterangan }}</td>
                    <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $t->jatuh_tempo->format('d-m-Y') }}</td>
                    <td><span class="badge {{ $t->status === 'lunas' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $t->status === 'lunas' ? 'Lunas' : 'Belum Bayar' }}</span></td>
                    <td>
                        @if($t->status === 'belum')
                            <form method="POST" action="{{ route('dosen.tagihan.lunas', $t) }}">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-outline-success">Tandai Lunas</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted">Belum ada tagihan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection