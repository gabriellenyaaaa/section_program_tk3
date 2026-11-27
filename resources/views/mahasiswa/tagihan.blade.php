@extends('layouts.panel')
@section('title', 'Tagihan')
@section('content')
@forelse($tagihan as $semester => $items)
    @php
        $total = $items->sum('jumlah');
        $sisa  = $items->where('status', 'belum')->sum('jumlah');
    @endphp
    <div class="card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Semester {{ $semester }}</h5>
            <span class="badge {{ $sisa ? 'bg-danger' : 'bg-success' }}">{{ $sisa ? 'Ada tagihan belum lunas' : 'Lunas semua' }}</span>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr><th>Keterangan</th><th>Jumlah</th><th>Jatuh Tempo</th><th>Status</th><th>Tanggal Bayar</th></tr>
                </thead>
                <tbody>
                @foreach($items as $t)
                    <tr>
                        <td>{{ $t->keterangan }}</td>
                        <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $t->jatuh_tempo->format('d-m-Y') }}</td>
                        <td><span class="badge {{ $t->status === 'lunas' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $t->status === 'lunas' ? 'Lunas' : 'Belum Bayar' }}</span></td>
                        <td>{{ $t->tanggal_bayar?->format('d-m-Y') ?? '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr><th>Total</th><th colspan="4">Rp {{ number_format($total, 0, ',', '.') }}
                        <span class="text-muted fw-normal ms-2">(sisa: Rp {{ number_format($sisa, 0, ',', '.') }})</span></th></tr>
                </tfoot>
            </table>
        </div>
    </div>
@empty
    <div class="alert alert-info">Belum ada tagihan.</div>
@endforelse
@endsection