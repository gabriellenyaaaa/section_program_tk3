<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JadwalController extends Controller
{
    public function index()
    {
        $matkul = auth()->user()->mataKuliah;
        $jadwal = Jadwal::with('mataKuliah')
            ->whereIn('mata_kuliah_id', $matkul->pluck('id'))
            ->orderByRaw("FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jam_mulai')->get();

        return view('dosen.jadwal', compact('matkul', 'jadwal'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mata_kuliah_id' => ['required', Rule::in($request->user()->mataKuliah()->pluck('id')->all())],
            'hari'           => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu'],
            'jam_mulai'      => ['required', 'date_format:H:i'],
            'jam_selesai'    => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'ruangan'        => ['required', 'max:50'],
        ]);

        $mk      = MataKuliah::findOrFail($data['mata_kuliah_id']);
        $paritas = $mk->semester % 2;   // 1 = ganjil, 0 = genap

        // Jadwal lain di hari & jam yang beririsan, pada periode (ganjil/genap) yang sama
        $dasar = fn () => Jadwal::where('hari', $data['hari'])
            ->where('jam_mulai', '<', $data['jam_selesai'])
            ->where('jam_selesai', '>', $data['jam_mulai'])
            ->whereHas('mataKuliah', fn ($q) => $q->whereRaw('semester % 2 = ?', [$paritas]));

        if ($dasar()->where('ruangan', $data['ruangan'])->exists()) {
            return back()->withInput()->withErrors(['ruangan' => 'Ruangan sudah dipakai pada jam tersebut di periode '.$mk->periode.'.']);
        }

        if ($dasar()->whereHas('mataKuliah', fn ($q) => $q->where('dosen_id', $mk->dosen_id))->exists()) {
            return back()->withInput()->withErrors(['jam_mulai' => 'Anda sudah punya jadwal mengajar lain pada jam tersebut.']);
        }

        if ($dasar()->whereHas('mataKuliah', fn ($q) => $q->where('semester', $mk->semester))->exists()) {
            return back()->withInput()->withErrors(['jam_mulai' => 'Mahasiswa semester '.$mk->semester.' sudah punya kuliah lain pada jam tersebut.']);
        }

        Jadwal::create($data);
        return back()->with('success', 'Jadwal ditambahkan.');
    }

    public function destroy(Jadwal $jadwal)
    {
        abort_unless($jadwal->mataKuliah->dosen_id === auth()->id(), 403);
        $jadwal->delete();
        return back()->with('success', 'Jadwal dihapus.');
    }
}
