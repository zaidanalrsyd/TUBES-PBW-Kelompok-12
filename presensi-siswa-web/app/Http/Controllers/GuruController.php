<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class GuruController extends Controller
{
    public function index()
    {
        $guru = User::where('role_id', 2)->get();
        return view('admin.pages.guru', [
            'guru' => $guru
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'repassword' => 'required|same:password',
            ], [
                'name.required' => 'Nama harus diisi',
                'name.string' => 'Nama harus berupa text',
                'name.max' => 'Nama maksimal 255 karakter',
                'username.required' => 'Username harus diisi',
                'username.string' => 'Username harus berupa text',
                'username.max' => 'Username maksimal 255 karakter',
                'username.unique' => 'Username sudah digunakan',
                'email.required' => 'Email harus diisi',
                'email.string' => 'Email harus berupa text',
                'email.email' => 'Format email tidak valid',
                'email.max' => 'Email maksimal 255 karakter',
                'email.unique' => 'Email sudah digunakan',
                'password.required' => 'Password harus diisi',
                'password.string' => 'Password harus berupa text',
                'password.min' => 'Password minimal 8 karakter',
                'repassword.required' => 'Konfirmasi password harus diisi',
                'repassword.same' => 'Password tidak sama',
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

            return redirect()->back()->with('success', 'Data guru berhasil ditambahkan dan email verifikasi telah dikirim');
        } catch (\Exception $e) {
            \Log::error('Error saat menambah guru: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Data guru gagal ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validationRules = [
                'name' => 'required',
                'username' => 'required|unique:users,username,' . $id,
                'email' => 'required|email|unique:users,email,' . $id,
            ];

            $validationMessages = [
                'name.required' => 'Nama harus diisi',
                'username.required' => 'Username harus diisi',
                'username.unique' => 'Username sudah digunakan',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
            ];

            if ($request->password != null) {
                $validationRules['password'] = 'required';
                $validationRules['repassword'] = 'required|same:password';
                $validationMessages['password.required'] = 'Password harus diisi';
                $validationMessages['repassword.required'] = 'Konfirmasi password harus diisi';
                $validationMessages['repassword.same'] = 'Password tidak sama';
            }

            $request->validate($validationRules, $validationMessages);

            $guru = User::find($id);
            $guru->name = $request->name;
            $guru->username = $request->username;
            $guru->email = $request->email;
            if ($request->password != null) {
                $guru->password = bcrypt($request->password);
            }
            $guru->save();

            return redirect()->back()->with('success', 'Data guru berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data guru gagal diubah');
        }
    }

    public function destroy($id)
    {
        try {
            $guru = User::find($id);
            $guru->delete();
            return redirect()->back()->with('success', 'Data guru berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data guru gagal dihapus');
        }
    }
}