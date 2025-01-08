<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Cek apakah email sudah diverifikasi
            if (is_null(Auth::user()->email_verified_at)) {
                Auth::logout();
                return back()
                    ->withErrors(['email' => 'Silakan verifikasi email Anda terlebih dahulu'])
                    ->withInput();
            }

            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Login Berhasil');
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah',
            'password' => 'Email atau Password salah',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout Berhasil');
    }
}
