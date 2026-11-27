@extends('layouts.panel')
@section('title', 'Nilai')
@section('content')
<div class="card p-4 mb-4">
    <div class="fw-semibold mb-2">Pilih Semester</div>
    <div class="d-flex flex-wrap gap-2">
        @for($s=1;$s<=8;$s++)
            @if($adaSemester->contains($s))
                <a href="{{ route('mahasiswa.nilai', ['semester'=>$s]) }}"
                   class="btn {{ $semester===$s ? 'btn-primary' : 'btn-outline-primary' }}">Semester {{ $s }}</a>
            @else
                <button type="button" class="btn btn-outline-secondary" disabled>Semester {{ $s }}</button>
            @endif
        @endfor
    </div>
</div>

@if($semester)
    <div class="row g-3 mb-4">
        <div class="col-md-6"><div class="card p-3 text-center"><div class="text-muted small">IPS Semester {{ $semester }}</div>
            <div class="display-6 fw-bold text-primary">{{ $ips !== null ? number_format($ips, 2) : '-' }}</div></div></div>
        <div class="col-md-6"><div class="card p-3 text-center"><div class="text-muted small">IPK Kumulatif</div>
            <div class="display-6 fw-bold text-success">{{ number_format(auth()->user()->ipk, 2) }}</div></div></div>
    </div>

    <div class="card p-4">
        <h5 class="mb-3">Daftar Nilai Semester {{ $semester }}</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th>No</th><th>Mata Kuliah</th><th class="text-center">Nilai Tugas</th><th class="text-center">Nilai UTS</th><th class="text-center">Nilai UAS</th></tr>
                </thead>
                <tbody>
                @foreach($rows as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $r['mk']->kode }} - {{ $r['mk']->nama }}</td>
                        <td class="text-center">{{ $r['n']?->nilai_tugas ?? '-' }}</td>
                        <td class="text-center">{{ $r['n']?->nilai_uts ?? '-' }}</td>
                        <td class="text-center">{{ $r['n']?->nilai_uas ?? '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@elseif($adaSemester->isNotEmpty())
    <div class="alert alert-info"><i class="bi bi-info-circle me-1"></i> Pilih salah satu semester di atas untuk menampilkan nilai.</div>
@else
    <div class="alert alert-info">Anda belum terdaftar di mata kuliah mana pun. Hubungi dosen pengampu.</div>
@endif
@endsection