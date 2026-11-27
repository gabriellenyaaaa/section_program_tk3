@extends('layouts.panel')
@section('title', 'Jadwal')
@section('content')
@include('partials.alerts')
<div class="card p-4 mb-4">
    <h5 class="mb-1">Tambah Jadwal</h5>
    <p class="text-muted small">Bentrok dicek pada periode yang sama (ganjil dengan ganjil, genap dengan genap): ruangan, jadwal dosen, dan kelas semester yang sama.</p>
    <form method="POST" action="{{ route('dosen.jadwal.store') }}" class="row g-3">
        @csrf
        <div class="col-md-4">
            <select name="mata_kuliah_id" class="form-select" required>
                <option value="">-- Mata kuliah --</option>
                @foreach($matkul as $m)
                    <option value="{{ $m->id }}" @selected(old('mata_kuliah_id')==$m->id)>{{ $m->kode }} - {{ $m->nama }} (Smt {{ $m->semester }} / {{ $m->periode }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="hari" class="form-select" required>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)<option @selected(old('hari')==$h)>{{ $h }}</option>@endforeach
            </select>
        </div>
        <div class="col-md-2"><input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="form-control" required></div>
        <div class="col-md-2"><input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" class="form-control" required></div>
        <div class="col-md-2"><input name="ruangan" value="{{ old('ruangan') }}" class="form-control" placeholder="Ruangan" required></div>
        <div class="col-12"><button class="btn btn-primary">Simpan Jadwal</button></div>
    </form>
</div>
<div class="card p-4">
    <h5 class="mb-3">Jadwal Mengajar</h5>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light"><tr><th>Smt</th><th>Periode</th><th>Hari</th><th>Jam</th><th>Mata Kuliah</th><th>Ruangan</th><th></th></tr></thead>
            <tbody>
            @forelse($jadwal as $j)
                <tr>
                    <td>{{ $j->mataKuliah->semester }}</td>
                    <td><span class="badge {{ $j->mataKuliah->periode === 'Ganjil' ? 'bg-primary' : 'bg-success' }}">{{ $j->mataKuliah->periode }}</span></td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ substr($j->jam_mulai,0,5) }} - {{ substr($j->jam_selesai,0,5) }}</td>
                    <td>{{ $j->mataKuliah->nama }}</td><td>{{ $j->ruangan }}</td>
                    <td>
                        <form method="POST" action="{{ route('dosen.jadwal.destroy', $j) }}" onsubmit="return confirm('Hapus jadwal?')">
                            @csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted">Belum ada jadwal.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection