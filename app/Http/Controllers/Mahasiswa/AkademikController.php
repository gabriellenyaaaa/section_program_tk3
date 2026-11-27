<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class AkademikController extends Controller
{
    public function nilai(Request $request)
    {
        $user        = auth()->user();
        $kelas       = $user->kelas()->get();
        $adaSemester = $kelas->pluck('semester')->unique()->values();
        $semester    = (int) $request->query('semester');
        $rows        = collect();
        $ips         = null;

        if ($semester && $adaSemester->contains($semester)) {
            $mkSemester = $kelas->where('semester', $semester)->values();
            $nilai      = $user->nilai()->whereIn('mata_kuliah_id', $mkSemester->pluck('id'))->get()->keyBy('mata_kuliah_id');

            $rows = $mkSemester->map(fn ($m) => ['mk' => $m, 'n' => $nilai->get($m->id)]);

            $dinilai = $rows->filter(fn ($r) => $r['n'] && ! is_null($r['n']->bobot));
            $sks     = $dinilai->sum(fn ($r) => $r['mk']->sks);
            $ips     = $sks ? round($dinilai->sum(fn ($r) => $r['n']->bobot * $r['mk']->sks) / $sks, 2) : null;
        } else {
            $semester = 0;
        }

        return view('mahasiswa.nilai', compact('adaSemester', 'semester', 'rows', 'ips'));
    }

    public function matkul(Request $request)
    {
        $ada      = MataKuliah::pluck('semester')->unique()->values();
        $semester = (int) $request->query('semester');

        if (! $ada->contains($semester)) {
            $semester = (int) ($ada->min() ?? 1);
        }

        $matkul = MataKuliah::with(['dosen', 'jadwal'])->where('semester', $semester)->orderBy('kode')->get();

        return view('mahasiswa.matkul', compact('ada', 'semester', 'matkul'));
    }

    public function tagihan()
    {
        $tagihan = auth()->user()->tagihan()->orderBy('semester')->orderBy('jatuh_tempo')->get()->groupBy('semester');
        return view('mahasiswa.tagihan', compact('tagihan'));
    }
}