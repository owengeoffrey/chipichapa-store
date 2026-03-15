<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showRegister()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|min:3|max:40',
            'email'        => ['required', 'string', 'email', 'unique:users', 'regex:/^[a-zA-Z0-9._%+\-]+@gmail\.com$/'],
            'password'     => 'required|string|min:6|max:12|confirmed',
            'nomor_hp'     => ['required', 'string', 'regex:/^08/'],
        ], [
            'email.regex'    => 'Email harus menggunakan @gmail.com',
            'nomor_hp.regex' => 'Nomor handphone harus diawali dengan 08',
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'name'         => $request->nama_lengkap,
            'email'        => $request->email,
            'nomor_hp'     => $request->nomor_hp,
            'password'     => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('user.catalog');
    }

    public function showLogin()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('user.catalog');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
