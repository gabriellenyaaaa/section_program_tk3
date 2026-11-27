<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $matkul = $request->user()->mataKuliah()->orderBy('semester')->orderBy('kode')->get();
        $tahap  = $request->query('tahap') === 'genap' ? 'genap' : 'ganjil';

        $mk       = $request->filled('mk') ? $matkul->firstWhere('id', (int) $request->query('mk')) : null;
        $semester = $mk ? (int) $mk->semester : (int) $request->query('semester');
        $daftarMk = $semester ? $matkul->where('semester', $semester)->values() : collect();

        $peserta = $nilai = $calon = collect();

        if ($mk) {
            $peserta = $mk->peserta()->orderBy('nim')->get();
            $nilai   = $mk->nilaiMahasiswa()->get()->keyBy('mahasiswa_id');
            $calon   = User::where('role', 'mahasiswa')->whereNotIn('id', $peserta->pluck('id'))->orderBy('nim')->get();
        }

        return view('dosen.nilai', compact('semester', 'tahap', 'daftarMk', 'mk', 'peserta', 'nilai', 'calon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => ['required', 'integer'],
            'rows'           => ['required', 'array'],
            'rows.*.tugas'   => ['nullable', 'integer', 'between:0,100'],
            'rows.*.uts'     => ['nullable', 'integer', 'between:0,100'],
            'rows.*.uas'     => ['nullable', 'integer', 'between:0,100'],
        ]);

        $mk    = $request->user()->mataKuliah()->findOrFail($request->input('mata_kuliah_id'));
        $tahap = $request->input('tahap') === 'genap' ? 'genap' : 'ganjil';
        $kolom = $tahap === 'ganjil' ? ['tugas', 'uts'] : ['uas'];

        $pesertaIds = $mk->peserta()->pluck('users.id')->map(fn ($id) => (int) $id)->all();

        foreach ($request->input('rows') as $mhsId => $row) {
            if (! in_array((int) $mhsId, $pesertaIds, true)) {
                continue;   // bukan peserta kelas ini
            }

            $nilai = Nilai::firstOrNew(['mahasiswa_id' => $mhsId, 'mata_kuliah_id' => $mk->id]);

            $kosong = collect($kolom)->every(fn ($k) => ($row[$k] ?? null) === null);
            if (! $nilai->exists && $kosong) {
                continue;   // jangan buat baris kosong
            }

            $nilai->semester = $mk->semester;
            foreach ($kolom as $k) {
                $nilai->{'nilai_'.$k} = $row[$k] ?? null;
            }

            $nilai->hitungAkhir();
            $nilai->save();   // IPK mahasiswa dihitung ulang otomatis
        }

        return back()->with('success', 'Nilai tahap '.$tahap.' tersimpan. IPK diperbarui otomatis untuk nilai yang sudah lengkap.');
    }

    public function tambahPeserta(Request $request)
    {
        $data = $request->validate([
            'mata_kuliah_id'  => ['required', 'integer'],
            'mahasiswa_ids'   => ['required', 'array'],
            'mahasiswa_ids.*' => [Rule::exists('users', 'id')->where('role', 'mahasiswa')],
        ]);

        $mk = $request->user()->mataKuliah()->findOrFail($data['mata_kuliah_id']);
        $mk->peserta()->syncWithoutDetaching($data['mahasiswa_ids']);

        return back()->with('success', 'Peserta ditambahkan ke kelas.');
    }

    public function hapusPeserta(Request $request, User $mahasiswa)
    {
        $mk = $request->user()->mataKuliah()->findOrFail($request->input('mata_kuliah_id'));

        Nilai::where('mahasiswa_id', $mahasiswa->id)
            ->where('mata_kuliah_id', $mk->id)
            ->get()->each->delete();   // dihapus satu per satu supaya IPK ikut dihitung ulang

        $mk->peserta()->detach($mahasiswa->id);

        return back()->with('success', 'Peserta dikeluarkan dari kelas.');
    }
}