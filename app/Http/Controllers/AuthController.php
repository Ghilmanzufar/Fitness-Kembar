<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Tampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Proses Login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah email & password cocok dengan database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Kalau sukses, lempar ke Dashboard Admin
            return redirect()->intended('admin');
        }

        // Kalau gagal, kembalikan ke form login dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah bro!',
        ])->onlyInput('email');
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Lempar balik ke halaman login
        return redirect('/login');
    }
}