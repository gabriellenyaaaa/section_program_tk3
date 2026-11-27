<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagihanController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->orderBy('nim')->get();
        $tagihan   = Tagihan::with('mahasiswa')->orderByDesc('id')->get();
        return view('dosen.tagihan', compact('mahasiswa', 'tagihan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mahasiswa_id' => ['required', Rule::exists('users', 'id')->where('role', 'mahasiswa')],
            'semester'     => ['required', 'integer', 'between:1,14'],
            'keterangan'   => ['required', 'max:255'],
            'jumlah'       => ['required', 'integer', 'min:1'],
            'jatuh_tempo'  => ['required', 'date'],
        ]);

        Tagihan::create($data);
        return back()->with('success', 'Tagihan ditambahkan.');
    }

    public function lunas(Tagihan $tagihan)
    {
        $tagihan->update(['status' => 'lunas', 'tanggal_bayar' => now()->toDateString()]);
        return back()->with('success', 'Tagihan ditandai lunas.');
    }
}