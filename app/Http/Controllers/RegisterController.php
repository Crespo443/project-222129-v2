<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterPage()
    {
        return view('register');
    }

    public function processRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = \App\Models\data_user_model::where('email', '=', $validated['email'])->first();

        if ($user) {
            return back()->withErrors([
                'email' => 'Email sudah terdaftar'
            ]);
        }

        $newUser = \App\Models\data_user_model::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'status_login' => false,
        ]);

        app(EmailVerificationController::class)->sendVerificationEmail($newUser);

        session([
            'pending_verification_user_id' => $newUser->id,
        ]);

        return redirect('/email/verify')->with('success', 'Registrasi berhasil. Link verifikasi sudah dikirim ke email Anda.');
    }
}
