<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginPage()
    {
        return view('login');
    }

    public function processLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $user = LoginModel::where('email', '=', $validated['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar',
            ]);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah',
            ]);
        }

        if (!$user->status_login) {
            session([
                'pending_verification_user_id' => $user->id,
            ]);

            return redirect('/email/verify')->withErrors([
                'email' => 'Email belum diverifikasi. Silakan klik tombol kirim verifikasi.',
            ]);
        }

        session([
            'user_login' => true,
            'user_id' => $user->id,
            'user_email' => $user->email,
            'user_name' => $user->name,
            'user_role' => $user->role ?? 'user',
        ]);

        $role = $user->role ?? 'user';

        if ($role === 'admin') {
            return redirect('/admin/dashboard')->with('success', 'Selamat datang, Admin!');
        }
        return redirect('/home')->with('success', 'Login berhasil!');
    }

    public function processLogout()
    {
        session()->flush();
        return redirect('/');
    }
}
