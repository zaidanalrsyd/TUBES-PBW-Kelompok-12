<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar',
        ]);

        $token = Str::random(64);
        $user = User::where('email', $request->email)->first();

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        Mail::send('admin.emails.forgot-password', [
            'user' => $user,
            'token' => $token
        ], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Reset Password - ' . config('app.name'));
        });

        return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda');
    }

    public function showResetForm($token)
    {
        $resetData = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$resetData) {
            return redirect('/')->with('error', 'Token tidak valid!');
        }

        return view('admin.auth.reset-password', [
            'token' => $token,
            'email' => $resetData->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
            'token' => 'required'
        ], [
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password_confirmation.required' => 'Konfirmasi password harus diisi',
            'password_confirmation.same' => 'Password tidak sama',
        ]);

        $resetData = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->first();

        if (!$resetData) {
            return redirect()->back()->with('error', 'Token tidak valid!');
        }

        User::where('email', $resetData->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')
            ->where('email', $resetData->email)
            ->delete();

        return redirect('/')->with('success', 'Password berhasil diubah!');
    }
}