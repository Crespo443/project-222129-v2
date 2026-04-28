<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email Akun</title>
</head>

<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    <h2>Halo {{ $name }},</h2>

    <p>Terima kasih sudah mendaftar. Klik tombol berikut untuk verifikasi email akun Anda:</p>

    <p>
        <a href="{{ $verificationUrl }}"
            style="display: inline-block; background: #eb9925; color: #ffffff; text-decoration: none; padding: 10px 16px; border-radius: 6px;">
            Verifikasi Email
        </a>
    </p>

    <p>Link ini berlaku selama 60 menit.</p>

    <p>Jika Anda tidak merasa melakukan pendaftaran, abaikan email ini.</p>
</body>

</html>
