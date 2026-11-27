<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matkul = auth()->user()->mataKuliah()->orderBy('semester')->orderBy('kode')->get();
        return view('dosen.matakuliah', compact('matkul'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode'     => ['required', 'max:10', 'unique:mata_kuliah,kode'],
            'nama'     => ['required', 'max:255'],
            'sks'      => ['required', 'integer', 'between:1,6'],
            'semester' => ['required', 'integer', 'between:1,8'],
        ]);

        $request->user()->mataKuliah()->create($data);
        return back()->with('success', 'Mata kuliah ditambahkan.');
    }
}