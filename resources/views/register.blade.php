<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300..900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-sec-400">
    <div class="grid place-items-center min-h-[80vh] py-3">
        <div class="shadow-xl rounded-lg p-4 lg:w-[28%] md:w-2/3 w-11/12 bg-white">
            <!-- Header Section -->
            <div class="text-center mb-3">
                <!-- Icon -->
                <div
                    class="mx-auto w-10 h-10 bg-linear-to-br from-pr-400 to-pr-600 rounded-full flex items-center justify-center mb-2 shadow-lg border-2 border-pr-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <!-- Heading -->
                <h1 class="text-xl font-bold text-gray-900 mb-1 font-car">Daftar Akun Baru</h1>

                <!-- Description Paragraph -->
                <p class="text-gray-600 text-xs max-w-sm mx-auto leading-relaxed">
                    Buat akun untuk menikmati layanan rental mobil
                </p>
            </div>
            <form method="POST" action="/register" enctype="multipart/form-data" class="rounded-lg px-2 sm:px-3">
                @csrf
                <div class="mb-3">
                    <label for="name" class="block text-xs font-medium text-gray-700 mb-1">Nama
                        :</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7"></path>
                            </svg>
                        </div>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="block w-full text-sm pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pr-400 focus:border-pr-400 transition-colors duration-200 @error('name') @enderror"
                            placeholder="Masukkan nama lengkap Anda">
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email :
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="block w-full text-sm pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pr-400 focus:border-pr-400 transition-colors duration-200 @error('email') @enderror"
                            placeholder="Masukkan email Anda">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Avatar Selection Section -->
                <div class="mb-3">
                    <label for="password" class="block text-xs font-medium text-gray-700 mb-1">
                        Password :</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8">
                                </path>
                            </svg>
                        </div>
                        <input type="password" id="password"
                            class="block w-full text-sm pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pr-400 focus:border-pr-400 transition-colors duration-200 @error('password') @enderror"
                            name="password" placeholder="Masukkan password">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="block text-xs font-medium text-gray-700 mb-1">
                        Konfirmasi Password :</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <input type="password" id="password-confirm"
                            class="block w-full text-sm pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pr-400 focus:border-pr-400 transition-colors duration-200 @error('password_confirmation') @enderror"
                            name="password_confirmation" placeholder="Ulangi password Anda">
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-start mb-3">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value=""
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-pr-300 "
                            name="remember" {{ old('remember') ? 'checked' : '' }}>
                    </div>
                    <label for="remember2" class="ml-2 text-xs font-medium text-gray-700">Ingat Saya</label>
                </div>
                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-pr-400 hover:bg-pr-500 focus:ring-4 focus:outline-none focus:ring-pr-300 font-semibold rounded-lg text-sm px-5 py-2 text-center text-white transition-colors duration-200 mb-2">
                    Daftar
                </button>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="/" class="text-pr-400 hover:text-pr-500 font-medium hover:underline">
                            Masuk di sini
                        </a>
                    </p>
                </div>


            </form>
        </div>

        <div class="text-center mt-2">
            <p class="text-xs text-gray-500">
                © 2026 Fun Ride. Veylando
            </p>
        </div>

    </div>
</body>

</html>
