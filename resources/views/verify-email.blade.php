<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi Email</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-sec-400 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Verifikasi Email</h1>
        <p class="text-sm text-gray-600 mb-4">
            Kami sudah mengirim link verifikasi ke email:
            <span class="font-semibold text-gray-800">{{ $email }}</span>
        </p>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/email/verification-notification" class="mb-3">
            @csrf
            <button type="submit"
                class="w-full bg-pr-400 hover:bg-pr-500 text-white font-semibold rounded-lg text-sm px-4 py-2 transition-colors duration-200">
                Kirim Ulang Verifikasi ke Email Pribadi
            </button>
        </form>

        <a href="/" class="block text-center text-sm text-pr-500 hover:underline">
            Kembali ke Login
        </a>

        <p class="mt-4 text-xs text-gray-500 leading-relaxed">
            Untuk development lokal dengan Mailpit, buka http://127.0.0.1:8025 untuk melihat email masuk.
        </p>
    </div>
</body>

</html>
