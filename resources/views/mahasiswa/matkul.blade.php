@extends('layouts.panel')
@section('title', 'Mata Kuliah & Jadwal')
@section('content')
<div class="card p-4 mb-4">
    <div class="fw-semibold mb-2">Pilih Semester</div>
    <div class="d-flex flex-wrap gap-2">
        @for($s=1;$s<=8;$s++)
            @if($ada->contains($s))
                <a href="{{ route('mahasiswa.matkul', ['semester'=>$s]) }}"
                   class="btn {{ $semester===$s ? 'btn-primary' : 'btn-outline-primary' }}">Semester {{ $s }}</a>
            @else
                <button type="button" class="btn btn-outline-secondary" disabled>Semester {{ $s }}</button>
            @endif
        @endfor
    </div>
</div>

<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Semester {{ $semester }} <span class="badge {{ $semester % 2 ? 'bg-primary' : 'bg-success' }}">{{ $semester % 2 ? 'Ganjil' : 'Genap' }}</span></h5>
        <span class="text-muted small">Total {{ $matkul->sum('sks') }} SKS</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Kode</th><th>Mata Kuliah</th><th>SKS</th><th>Dosen</th><th>Hari</th><th>Jam</th><th>Ruangan</th></tr>
            </thead>
            <tbody>
            @forelse($matkul as $m)
                @forelse($m->jadwal as $j)
                    <tr>
                        <td>{{ $m->kode }}</td><td>{{ $m->nama }}</td><td>{{ $m->sks }}</td><td>{{ $m->dosen->name }}</td>
                        <td>{{ $j->hari }}</td>
                        <td>{{ substr($j->jam_mulai,0,5) }} - {{ substr($j->jam_selesai,0,5) }}</td>
                        <td><span class="badge bg-primary">{{ $j->ruangan }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td>{{ $m->kode }}</td><td>{{ $m->nama }}</td><td>{{ $m->sks }}</td><td>{{ $m->dosen->name }}</td>
                        <td colspan="3" class="text-muted">Jadwal belum ditentukan</td>
                    </tr>
                @endforelse
            @empty
                <tr><td colspan="7" class="text-center text-muted">Belum ada mata kuliah di semester ini.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection