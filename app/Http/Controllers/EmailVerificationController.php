<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller
{
    public function showNotice()
    {
        $user = $this->getPendingUser();

        if ($user->status_login) {
            session()->forget('pending_verification_user_id');

            return redirect('/')->with('success', 'Email sudah terverifikasi. Silakan login.');
        }
        return view('verify-email', [
            'email' => $user->email,
        ]);
    }
    public function resend()
    {
        $user = $this->getPendingUser();

        if ($user->status_login) {
            session()->forget('pending_verification_user_id');

            return redirect('/')->with('success', 'Email sudah terverifikasi. Silakan login.');
        }

        $this->sendVerificationEmail($user);

        return back()->with('success', 'Email verifikasi berhasil dikirim ulang. Cek Mailpit atau inbox email Anda.');
    }
    public function verify(string $id, string $hash)
    {
        $user = \App\Models\data_user_model::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->email))) {
            abort(403, 'Data verifikasi tidak cocok.');
        }

        if (!$user->status_login) {
            $user->status_login = true;
            $user->save();
        }

        session()->forget('pending_verification_user_id');

        return redirect('/')->with('success', 'Email berhasil diverifikasi. Silakan login.');
    }
    public function sendVerificationEmail(\App\Models\data_user_model $user): void
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );

        Mail::send('emails.verify-email', [
            'name' => $user->name,
            'verificationUrl' => $verificationUrl,
        ], function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject('Verifikasi Email Akun Anda');
        });
    }
    private function getPendingUser(): \App\Models\data_user_model
    {
        $userId = session('pending_verification_user_id');

        if (!$userId) {
            abort(403, 'Sesi verifikasi tidak ditemukan. Silakan login lagi.');
        }
        $user = \App\Models\data_user_model::find($userId);

        if (!$user) {
            session()->forget('pending_verification_user_id');
            abort(404, 'Akun tidak ditemukan.');
        }
        return $user;
    }
}