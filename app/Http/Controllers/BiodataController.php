<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class BiodataController extends Controller
{
    public function edit()
    {
        return view('biodata_edit');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'          => ['required', 'max:255'],
            'username'      => ['required', 'alpha_dash', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'email'         => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'tempat_lahir'  => ['required', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'photo'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'password'      => ['nullable', 'confirmed', Password::defaults()],
        ]);

        unset($data['photo']);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        } elseif ($request->boolean('hapus_foto')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = null;
        }

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('biodata')->with('success', 'Biodata berhasil diperbarui.');
    }
}