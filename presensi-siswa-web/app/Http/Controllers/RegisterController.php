<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function show()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);

        Mail::send('admin.emails.verification', [
            'user' => $user,
            'hash' => sha1($user->email)
        ], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Verifikasi Email Anda - ' . config('app.name'));
        });

        return redirect('/')
            ->with('success', 'Pendaftaran berhasil! Silakan cek email Anda untuk verifikasi akun.');
    }

    public function verify($id, $hash)
    {
        $user = User::findOrFail($id);

        if ($user->email_verified_at) {
            return redirect('/')
                ->with('success', 'Email sudah diverifikasi sebelumnya. Silakan login.');
        }

        if (sha1($user->email) !== $hash) {
            return redirect('/')
                ->with('error', 'Link verifikasi tidak valid.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect('/')
            ->with('success', 'Email berhasil diverifikasi. Silakan login.');
    }

    public function resendVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()
                ->back()
                ->with('error', 'User dengan email tersebut tidak ditemukan.');
        }

        if ($user->email_verified_at) {
            return redirect('/')
                ->with('success', 'Email sudah diverifikasi sebelumnya. Silakan login.');
        }

        Mail::send('admin.emails.verification', [
            'user' => $user,
            'hash' => sha1($user->email)
        ], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Verifikasi Email Anda - ' . config('app.name'));
        });

        return redirect()
            ->back()
            ->with('success', 'Email verifikasi telah dikirim ulang.');
    }
}