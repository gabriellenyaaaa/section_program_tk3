<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nim'           => ['required', 'string', 'max:20', 'unique:users,nim'],
            'name'          => ['required', 'string', 'max:255'],
            'username'      => ['required', 'alpha_dash', 'max:50', 'unique:users,username'],
            'email'         => ['required', 'email', 'max:255', 'unique:users,email'],
            'tempat_lahir'  => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'photo'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'password'      => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $user = User::create($data);
        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
