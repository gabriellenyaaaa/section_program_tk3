@extends('layouts.panel')
@section('title', 'Input Nilai')
@section('content')
@php $warna = ['A'=>'success','B'=>'primary','C'=>'info','D'=>'warning','E'=>'danger']; @endphp
@include('partials.alerts')

{{-- Keterangan huruf --}}
<div class="card p-3 mb-4">
    <div class="d-flex flex-wrap gap-2 align-items-center">
        <strong class="me-2">Keterangan huruf:</strong>
        <span class="badge bg-success">A : 80-100 (4,00)</span>
        <span class="badge bg-primary">B : 70-79 (3,00)</span>
        <span class="badge bg-info">C : 60-69 (2,00)</span>
        <span class="badge bg-warning text-dark">D : 50-59 (1,00)</span>
        <span class="badge bg-danger">E : 0-49 (0,00)</span>
        <span class="text-muted small ms-lg-auto">Nilai akhir = 30% tugas + 30% UTS + 40% UAS</span>
    </div>
</div>

{{-- Pilih semester & mata kuliah --}}
<div class="card p-4 mb-4">
    <div class="fw-semibold mb-2">1. Pilih Semester</div>
    <div class="mb-3">
        @for($s=1;$s<=8;$s++)
            <a href="{{ route('dosen.nilai.index', ['semester'=>$s,'tahap'=>$tahap]) }}"
               class="btn btn-sm me-1 mb-1 {{ $semester===$s ? 'btn-primary' : 'btn-outline-primary' }}">Semester {{ $s }}</a>
        @endfor
    </div>
    @if($semester)
        <div class="fw-semibold mb-2">2. Pilih Mata Kuliah</div>
        @forelse($daftarMk as $m)
            <a href="{{ route('dosen.nilai.index', ['semester'=>$semester,'mk'=>$m->id,'tahap'=>$tahap]) }}"
               class="btn btn-sm me-1 mb-1 {{ $mk && $mk->id===$m->id ? 'btn-success' : 'btn-outline-success' }}">{{ $m->kode }} - {{ $m->nama }}</a>
        @empty
            <span class="text-muted">Anda belum punya mata kuliah di semester ini.</span>
        @endforelse
    @endif
</div>

@if($mk)
    {{-- Tahap input --}}
    <div class="card p-4 mb-4">
        <div class="d-flex flex-wrap align-items-center gap-2">
            <div class="fw-semibold me-2">3. Tahap Input:</div>
            <a href="{{ route('dosen.nilai.index', ['semester'=>$semester,'mk'=>$mk->id,'tahap'=>'ganjil']) }}"
               class="btn btn-sm {{ $tahap==='ganjil' ? 'btn-primary' : 'btn-outline-primary' }}">Ganjil (Tugas &amp; UTS)</a>
            <a href="{{ route('dosen.nilai.index', ['semester'=>$semester,'mk'=>$mk->id,'tahap'=>'genap']) }}"
               class="btn btn-sm {{ $tahap==='genap' ? 'btn-primary' : 'btn-outline-primary' }}">Genap (UAS)</a>
        </div>
    </div>

    {{-- Daftar peserta + input nilai --}}
    <div class="card p-4 mb-4">
        <h5 class="mb-1">{{ $mk->kode }} - {{ $mk->nama }}
            <span class="badge bg-secondary">Smt {{ $mk->semester }} &middot; {{ $mk->periode }} &middot; {{ $mk->sks }} SKS</span></h5>
        <p class="text-muted small">Kolom yang aktif hanya yang sesuai tahap. Nilai bisa diubah kapan saja. Nilai akhir dan huruf muncul setelah tugas, UTS, dan UAS lengkap.</p>

        <form method="POST" action="{{ route('dosen.nilai.store') }}">
            @csrf
            <input type="hidden" name="mata_kuliah_id" value="{{ $mk->id }}">
            <input type="hidden" name="tahap" value="{{ $tahap }}">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr><th>No</th><th>NIM</th><th>Nama</th>
                            <th style="width:110px">Tugas</th><th style="width:110px">UTS</th><th style="width:110px">UAS</th>
                            <th class="text-center">Akhir</th><th class="text-center">Huruf</th></tr>
                    </thead>
                    <tbody>
                    @forelse($peserta as $i => $m)
                        @php $n = $nilai->get($m->id); @endphp
                        <tr>
                            <td>{{ $i + 1 }}</td><td>{{ $m->nim }}</td><td>{{ $m->name }}</td>
                            <td><input type="number" min="0" max="100" name="rows[{{ $m->id }}][tugas]"
                                       value="{{ old('rows.'.$m->id.'.tugas', $n?->nilai_tugas) }}"
                                       class="form-control form-control-sm" @disabled($tahap !== 'ganjil')></td>
                            <td><input type="number" min="0" max="100" name="rows[{{ $m->id }}][uts]"
                                       value="{{ old('rows.'.$m->id.'.uts', $n?->nilai_uts) }}"
                                       class="form-control form-control-sm" @disabled($tahap !== 'ganjil')></td>
                            <td><input type="number" min="0" max="100" name="rows[{{ $m->id }}][uas]"
                                       value="{{ old('rows.'.$m->id.'.uas', $n?->nilai_uas) }}"
                                       class="form-control form-control-sm" @disabled($tahap !== 'genap')></td>
                            <td class="text-center">{{ $n?->nilai_angka ?? '-' }}</td>
                            <td class="text-center">
                                @if($n?->nilai_huruf)
                                    <span class="badge bg-{{ $warna[$n->nilai_huruf] }} {{ $n->nilai_huruf==='D' ? 'text-dark' : '' }}">{{ $n->nilai_huruf }}</span>
                                @else - @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted py-4">Belum ada peserta di kelas ini. Tambahkan peserta di bagian bawah.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($peserta->isNotEmpty())
                <button class="btn btn-primary mt-3"><i class="bi bi-save me-1"></i> Simpan Nilai Tahap {{ ucfirst($tahap) }}</button>
            @endif
        </form>
    </div>

    {{-- Kelola peserta --}}
    <div class="card p-4">
        <h5 class="mb-3">Kelola Peserta Kelas</h5>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="fw-semibold mb-2">Tambah peserta</div>
                @if($calon->isEmpty())
                    <div class="text-muted small">Semua mahasiswa sudah terdaftar di kelas ini.</div>
                @else
                    <form method="POST" action="{{ route('dosen.nilai.peserta.store') }}">
                        @csrf
                        <input type="hidden" name="mata_kuliah_id" value="{{ $mk->id }}">
                        <div class="border rounded p-2 mb-2" style="max-height:220px; overflow-y:auto">
                            @foreach($calon as $c)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mahasiswa_ids[]" value="{{ $c->id }}" id="c{{ $c->id }}">
                                    <label class="form-check-label" for="c{{ $c->id }}">{{ $c->nim }} - {{ $c->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn-outline-primary btn-sm">Tambahkan yang dipilih</button>
                    </form>
                @endif
            </div>
            <div class="col-lg-6">
                <div class="fw-semibold mb-2">Peserta saat ini ({{ $peserta->count() }})</div>
                @forelse($peserta as $m)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-1">
                        <span>{{ $m->nim }} - {{ $m->name }}</span>
                        <form method="POST" action="{{ route('dosen.nilai.peserta.destroy', $m) }}"
                              onsubmit="return confirm('Keluarkan {{ $m->name }} dari kelas? Nilainya di kelas ini ikut terhapus.')">
                            @csrf @method('DELETE')
                            <input type="hidden" name="mata_kuliah_id" value="{{ $mk->id }}">
                            <button class="btn btn-sm btn-outline-danger">Keluarkan</button>
                        </form>
                    </div>
                @empty
                    <div class="text-muted small">Belum ada.</div>
                @endforelse
            </div>
        </div>
    </div>
@elseif($semester)
    <div class="alert alert-info"><i class="bi bi-info-circle me-1"></i> Pilih mata kuliah untuk menampilkan daftar mahasiswanya.</div>
@else
    <div class="alert alert-info"><i class="bi bi-info-circle me-1"></i> Pilih semester terlebih dahulu.</div>
@endif
@endsection