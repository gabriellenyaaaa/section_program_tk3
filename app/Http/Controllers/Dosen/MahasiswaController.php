<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->orderBy('nim')->get();
        return view('dosen.mahasiswa', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nim'           => ['required', 'max:20', 'unique:users,nim'],
            'name'          => ['required', 'max:255'],
            'username'      => ['required', 'alpha_dash', 'max:50', 'unique:users,username'],
            'email'         => ['required', 'email', 'unique:users,email'],
            'tempat_lahir'  => ['required', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'password'      => ['required', 'min:8'],
        ]);

        User::create($data);
        return back()->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(User $mahasiswa)
    {
        abort_unless($mahasiswa->role === 'mahasiswa', 404);
        return view('dosen.mahasiswa_edit', compact('mahasiswa'));
    }

    public function update(Request $request, User $mahasiswa)
    {
        abort_unless($mahasiswa->role === 'mahasiswa', 404);

        $data = $request->validate([
            'nim'           => ['required', 'max:20', Rule::unique('users', 'nim')->ignore($mahasiswa->id)],
            'name'          => ['required', 'max:255'],
            'username'      => ['required', 'alpha_dash', 'max:50', Rule::unique('users', 'username')->ignore($mahasiswa->id)],
            'email'         => ['required', 'email', Rule::unique('users', 'email')->ignore($mahasiswa->id)],
            'tempat_lahir'  => ['required', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'password'      => ['nullable', 'min:8'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);   // kosong = password tidak diubah
        }

        $mahasiswa->update($data);
        return redirect()->route('dosen.mahasiswa.index')->with('success', 'Data mahasiswa diperbarui.');
    }

    public function destroy(User $mahasiswa)
    {
        abort_unless($mahasiswa->role === 'mahasiswa', 404);

        if ($mahasiswa->photo) {
            Storage::disk('public')->delete($mahasiswa->photo);
        }
        $mahasiswa->delete();   // nilai, KRS, dan tagihan ikut terhapus (cascade)

        return back()->with('success', 'Mahasiswa dihapus.');
    }
}