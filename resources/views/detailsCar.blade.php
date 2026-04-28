 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>{{ config('app.name', 'RentCar') }}</title>
     {{-- jquery --}}
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     {{-- sweet alert --}}
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
     {{-- flatpickr JS --}}
     {{-- @include('flatpickr::components.style') --}}
     @vite('resources/css/app.css')
     @vite('resources/js/app.js')
     <style>
         html {
             scroll-behavior: smooth;
         }
     </style>
 </head>

 <body class="bg-sec-400">
     <!-- Navigation -->
     <header>
         <nav class="bg-sec-600 border-gray-200 px-4 lg:px-6 py-4">
             <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                 {{-- LOGO --}}
                 <a href="/home" class="flex items-center">
                     <img loading="lazy" src="/storage/logos/logo2.png" class="mr-3 h-12" alt="Flowbite Logo" />
                 </a>

                 {{-- Client Menu --}}
                 <div class="hidden justify-between items-center w-full lg:flex lg:w-auto" id="mobile-menu-2">
                     <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                         <li>
                             <a href="/home">
                                 <div class="group text-center">
                                     <div class="group-hover:cursor-pointer">Beranda</div>
                                     <div
                                         class="block invisible bg-pr-400 w-12 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                     </div>
                                 </div>
                             </a>
                         </li>
                         <li>
                             <a href="/cars">
                                 <div class="group text-center">
                                     <div class="group-hover:cursor-pointer">Mobil</div>
                                     <div
                                         class="block invisible bg-pr-400 w-8 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                     </div>
                                 </div>
                             </a>
                         </li>
                     </ul>
                 </div>

                 {{-- Client Dropdown --}}
                 <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                     class="text-black bg-pr-400 hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center "
                     type="button">
                     <img loading="lazy" src="/storage/images/user.png" width="24" alt="user icon" class="mr-3">
                     {{ session('user_name') }}


                     <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                         </path>
                     </svg>
                 </button>

                 <!-- Dropdown menu -->
                 <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                     <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                         <li>
                             <a href="/#" class="block px-4 py-2 hover:bg-pr-200">Profil</a>
                         </li>
                         <li>
                             <a href="#" class="block px-4 py-2 hover:bg-pr-200">Reservasi
                                 Saya</a>
                         </li>
                         <li>
                             <a class="block px-4 py-2 hover:bg-pr-200 " href="/logout"
                                 onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                 Logout
                             </a>
                             <form id="logout-form" action="/logout" method="POST" class="hidden">
                                 @csrf
                             </form>
                         </li>
                     </ul>
                 </div>

                 {{-- Mobile menu toggle --}}

             </div>
         </nav>
     </header>


     <div class="bg-white min-h-screen">
         <!-- Main Car Details Section -->
         <div class="mx-auto max-w-7xl px-4 py-8">

             <!-- Breadcrumb -->
             <nav class="mb-8">
                 <ol class="flex items-center space-x-2 text-sm text-gray-500">
                     <li><a href="/home" class="hover:text-orange-500">Beranda</a></li>
                     <li>/</li>
                     <li><a href="/cars" class="hover:text-orange-500">Mobil</a></li>
                     <li>/</li>
                     <li class="text-gray-900">{{ $car->brand }} {{ $car->model }}</li>
                 </ol>
             </nav>

             <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                 <!-- Left Column - Images -->
                 <div class="space-y-4">
                     <!-- Main Image -->
                     <div class="relative aspect-4/3 overflow-hidden rounded-lg shadow-lg">
                         <img id="mainImage" src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}"
                             class="w-full h-full object-cover">
                         @if ($car->reduce > 0)
                             <span
                                 class="absolute top-4 left-4 bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                 {{ $car->reduce }}% OFF
                             </span>
                         @endif
                         @if ($car->status === 'disewa')
                             <span
                                 class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                 Disewa
                             </span>
                         @elseif($car->status === 'perbaikan')
                             <span
                                 class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                 Perbaikan
                             </span>
                         @endif
                     </div>
                 </div>

                 <!-- Right Column - Car Details -->
                 <div class="space-y-6">
                     <h1 class="text-3xl font-bold text-gray-900 mb-2">
                         {{ $car->brand }} {{ $car->model }}
                     </h1>
                     <div class="flex items-center space-x-4 mb-4">
                         <div class="flex items-center">
                             @for ($i = 1; $i <= 5; $i++)
                                 <svg class="h-5 w-5 {{ $i <= $car->stars ? 'text-orange-400' : 'text-gray-300' }} fill-current"
                                     viewBox="0 0 20 20">
                                     <path
                                         d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                 </svg>
                             @endfor
                             <span class="ml-2 text-sm text-gray-600">{{ number_format($car->stars, 1) }}</span>
                         </div>
                         <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm font-medium">
                             {{ $car->category }}
                         </span>
                     </div>

                     <!-- Price -->
                     <div class="bg-gray-50 p-6 rounded-lg">
                         <div class="flex items-center justify-between">
                             <div>
                                 <span
                                     class="text-3xl font-bold text-orange-500">{{ $car->formatted_discounted_price }}</span>
                                 <span class="text-gray-600 ml-2">per hari</span>
                                 @if ($car->reduce > 0)
                                     <div class="mt-1">
                                         <span class="text-lg text-red-500 line-through">
                                             {{ $car->formatted_price }}
                                         </span>
                                     </div>
                                 @endif
                             </div>
                             <div class="text-right">
                                 <p class="text-sm text-gray-600">Sewa Minimum</p>
                                 <p class="font-semibold">{{ $car->minimum_rental_days }} Hari</p>
                             </div>
                         </div>
                     </div>

                     <!-- Car Specifications -->
                     <div class="grid grid-cols-2 gap-4">
                         <div class="bg-white border border-gray-200 p-4 rounded-lg">
                             <div class="flex items-center space-x-3">
                                 <svg class="h-6 w-6 text-orange-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M13 10V3L4 14h7v7l9-11h-7z" />
                                 </svg>
                                 <div>
                                     <p class="text-sm text-gray-600">Transmisi</p>
                                     <p class="font-semibold capitalize">
                                         {{ $car->transmission }}</p>
                                 </div>
                             </div>
                         </div>

                         <div class="bg-white border border-gray-200 p-4 rounded-lg">
                             <div class="flex items-center space-x-3">
                                 <svg class="h-6 w-6 text-orange-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                 </svg>
                                 <div>
                                     <p class="text-sm text-gray-600">Bahan Bakar</p>
                                     <p class="font-semibold capitalize">
                                         {{ $car->fuel_type }}</p>
                                 </div>
                             </div>
                         </div>

                         <div class="bg-white border border-gray-200 p-4 rounded-lg">
                             <div class="flex items-center space-x-3">
                                 <svg class="h-6 w-6 text-orange-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                 </svg>
                                 <div>
                                     <p class="text-sm text-gray-600">Kursi</p>
                                     <p class="font-semibold">{{ $car->seats }} Orang
                                     </p>
                                 </div>
                             </div>
                         </div>

                         <div class="bg-white border border-gray-200 p-4 rounded-lg">
                             <div class="flex items-center space-x-3">
                                 <svg class="h-6 w-6 text-orange-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                 </svg>
                                 <div>
                                     <p class="text-sm text-gray-600">Pintu</p>
                                     <p class="font-semibold">{{ $car->doors }} Pintu
                                     </p>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Additional Info -->
                     <div class="border-t border-gray-200 pt-4 space-y-2">
                         <div class="flex justify-between py-2 border-b">
                             <span class="text-gray-600">Tahun</span>
                             <span class="font-semibold">{{ $car->year }}</span>
                         </div>
                         <div class="flex justify-between py-2 border-b">
                             <span class="text-gray-600">Warna</span>
                             <span class="font-semibold">{{ $car->color }}</span>
                         </div>
                         <div class="flex justify-between py-2 border-b">
                             <span class="text-gray-600">Kilometer</span>
                             <span class="font-semibold">{{ number_format($car->mileage) }}
                                 km</span>
                         </div>
                         <div class="flex justify-between py-2 border-b">
                             <span class="text-gray-600">Sewa Jangka Panjang</span>
                             <span
                                 class="font-semibold">{{ $car->available_for_long_term ? 'Tersedia' : 'Tidak Tersedia' }}</span>
                         </div>
                     </div>
                     <!-- Features -->
                     <div>
                         <h3 class="text-lg font-semibold mb-3">Fitur</h3>
                         <div class="grid grid-cols-2 gap-2">
                             @if ($car->features && is_array($car->features))
                                 @foreach ($car->features as $feature)
                                     <div class="flex items-center space-x-2">
                                         <svg class="h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                             <path fill-rule="evenodd"
                                                 d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                 clip-rule="evenodd" />
                                         </svg>
                                         <span class="text-sm">{{ $feature }}</span>
                                     </div>
                                 @endforeach
                             @endif
                         </div>
                     </div>

                     <!-- Description -->
                     @if ($car->description)
                         <div>
                             <h3 class="text-lg font-semibold mb-3">Deskripsi</h3>
                             <p class="text-gray-600 leading-relaxed">
                                 {{ $car->description }}</p>
                         </div>
                     @endif

                     <!-- Book Now Button -->
                     <div class="pt-6">
                         @if ($car->status === 'tersedia')
                             {{-- <a href="{{ route('reservations.create', $car->id) }}" --}}
                             <a href="#"
                                 class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-lg text-center block transition-colors">
                                 Pesan Sekarang
                             </a>
                         @else
                             <button disabled
                                 class="w-full bg-gray-400 text-white font-bold py-4 px-8 rounded-lg text-center block cursor-not-allowed">
                                 Tidak Tersedia
                             </button>
                         @endif
                     </div>
                 </div>
             </div>

             <!-- Reviews Section -->
             <div class="mt-16">
                 <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                     <!-- Reviews Display -->
                     <div class="lg:col-span-2">
                         <div class="flex items-center justify-between mb-6">
                             <h2 class="text-2xl font-bold text-gray-900">Ulasan Pelanggan
                             </h2>
                             <div class="flex items-center">
                                 <div class="flex items-center">
                                     <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                         <path
                                             d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                     </svg>
                                     <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                         <path
                                             d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                     </svg>
                                     <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                         <path
                                             d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                     </svg>
                                     <svg class="h-5 w-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                         <path
                                             d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                     </svg>
                                     <svg class="h-5 w-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                         <path
                                             d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                     </svg>
                                 </div>
                                 <span
                                     class="ml-2 text-lg font-semibold text-gray-900">{{ number_format($car->stars, 1) }}</span>
                                 {{-- <span class="ml-1 text-gray-600">({{ $car->reviews()->approved()->count() }}
                                     Ulasan)</span> --}}
                                 <span class="ml-1 text-gray-600">Belum Ada Ulsaan</span>
                             </div>
                         </div>

                         <div class="space-y-6">
                             {{-- @forelse($car->reviews()->approved()->get() as $review)
                                 <div class="bg-gray-50 rounded-lg p-6">
                                     <div class="flex items-center justify-between mb-3">
                                         <div class="flex items-center">
                                             <div
                                                 class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white font-semibold">
                                                 {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                                             </div>
                                             <div class="ml-3">
                                                 <p class="font-semibold text-gray-900">
                                                     {{ $review->user->name ?? 'User' }}
                                                 </p>
                                                 <p class="text-sm text-gray-600">
                                                     {{ $review->created_at->diffForHumans() }}
                                                 </p>
                                             </div>
                                         </div>
                                         <div class="flex items-center">
                                             @for ($i = 1; $i <= 5; $i++)
                                                 <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }} fill-current"
                                                     viewBox="0 0 20 20">
                                                     <path
                                                         d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                 </svg>
                                             @endfor
                                         </div>
                                     </div>
                                     <p class="text-gray-700">{{ $review->comment }}</p>
                                 </div> --}}
                             {{-- @empty --}}
                             <div class="bg-gray-50 rounded-lg p-8 text-center">
                                 <p class="text-gray-600">Belum ada ulasan untuk mobil
                                     ini.</p>
                             </div>
                             {{-- @endforelse --}}
                         </div>

                         <!-- Review Form -->
                         <div class="lg:col-span-1">

                             <div class="bg-white border border-gray-200 rounded-lg p-6">
                                 <h3 class="text-lg font-semibold text-gray-900 mb-4">Tulis
                                     Ulasan</h3>

                                 @if (session('success'))
                                     <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                         role="alert">
                                         <span class="block sm:inline">{{ session('success') }}</span>
                                     </div>
                                 @endif

                                 @if (session('error'))
                                     <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                         role="alert">
                                         <span class="block sm:inline">{{ session('error') }}</span>
                                     </div>
                                 @endif

                                 @if ($errors->any())
                                     <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                         role="alert">
                                         <ul class="list-disc list-inside">
                                             @foreach ($errors->all() as $error)
                                                 <li>{{ $error }}</li>
                                             @endforeach
                                         </ul>
                                     </div>
                                 @endif
                                 <form method="POST" action="/reviews" id="reviewForm">
                                     @csrf
                                     <input type="hidden" name="car_id" value="{{ $car->id }}">
                                     <!-- Rating -->
                                     <div class="mb-4">
                                         <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                         <div class="flex items-center space-x-1">
                                             <button type="button" onclick="setRating(1)"
                                                 class="rating-star text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors">
                                                 <svg class="h-6 w-6 fill-current" viewBox="0 0 20 20">
                                                     <path
                                                         d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                 </svg>
                                             </button>
                                             <button type="button" onclick="setRating(2)"
                                                 class="rating-star text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors">
                                                 <svg class="h-6 w-6 fill-current" viewBox="0 0 20 20">
                                                     <path
                                                         d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                 </svg>
                                             </button>
                                             <button type="button" onclick="setRating(3)"
                                                 class="rating-star text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors">
                                                 <svg class="h-6 w-6 fill-current" viewBox="0 0 20 20">
                                                     <path
                                                         d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                 </svg>
                                             </button>
                                             <button type="button" onclick="setRating(4)"
                                                 class="rating-star text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors">
                                                 <svg class="h-6 w-6 fill-current" viewBox="0 0 20 20">
                                                     <path
                                                         d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                 </svg>
                                             </button>
                                             <button type="button" onclick="setRating(5)"
                                                 class="rating-star text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors">
                                                 <svg class="h-6 w-6 fill-current" viewBox="0 0 20 20">
                                                     <path
                                                         d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                 </svg>
                                             </button>
                                         </div>
                                         <input type="hidden" name="rating" id="rating" value="5"
                                             required>
                                     </div>

                                     <!-- Comment -->
                                     <div class="mb-4">
                                         <label for="comment"
                                             class="block text-sm font-medium text-gray-700 mb-2">Komentar
                                             <span class="text-red-500">*</span></label>
                                         <textarea name="comment" id="comment" rows="4" required
                                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                             placeholder="Bagikan pengalaman Anda dengan mobil ini... (minimal 10 karakter)">{{ old('comment') }}</textarea>
                                         <p class="text-xs text-gray-500 mt-1">Minimal 10 karakter</p>
                                     </div>

                                     <!-- Submit Button -->
                                     <button type="submit"
                                         class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                         Kirim Ulasan
                                     </button>
                                 </form>

                             </div>

                         </div>
                     </div>
                 </div>

                 <!-- Related Cars Section -->
                 <div class="mt-16">
                     <div class="flex items-center justify-between mb-8">
                         <h2 class="text-2xl font-bold text-gray-900">Mobil Terkait</h2>
                         <a href="/cars" class="text-orange-500 hover:text-orange-600 font-medium">
                             Lihat Semua →
                         </a>
                     </div>

                     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                         @forelse($relatedCars as $relatedCar)
                             <div
                                 class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                                 <a href="/cars/{{ $relatedCar->id }}">
                                     <div class="aspect-4/3 overflow-hidden relative">
                                         <img src="{{ $relatedCar->image_url }}"
                                             alt="{{ $relatedCar->brand }} {{ $relatedCar->model }}"
                                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                         @if ($relatedCar->reduce > 0)
                                             <span
                                                 class="absolute top-2 left-2 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                                 {{ $relatedCar->reduce }}% OFF
                                             </span>
                                         @endif
                                     </div>
                                     <div class="p-4">
                                         <h3 class="font-semibold text-gray-900 mb-2">{{ $relatedCar->brand }}
                                             {{ $relatedCar->model }}</h3>
                                         <div class="flex items-center justify-between">
                                             <div>
                                                 <span
                                                     class="text-lg font-bold text-orange-500">{{ $relatedCar->formatted_discounted_price }}</span>
                                                 <span class="text-xs text-gray-600">/hari</span>
                                             </div>
                                             <div class="flex items-center">
                                                 <svg class="h-4 w-4 text-orange-400 fill-current"
                                                     viewBox="0 0 20 20">
                                                     <path
                                                         d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                 </svg>
                                                 <span
                                                     class="ml-1 text-sm text-gray-600">{{ number_format($relatedCar->stars, 1) }}</span>
                                             </div>
                                         </div>
                                     </div>
                                 </a>
                             </div>
                         @empty
                             <div class="col-span-4 text-center py-8">
                                 <p class="text-gray-600">Tidak ada mobil terkait lainnya.</p>
                             </div>
                         @endforelse
                     </div>
                 </div>
             </div>
         </div>

     </div>

     <script>
         // Rating Stars Functionality
         function setRating(rating) {
             document.getElementById('rating').value = rating;
             const stars = document.querySelectorAll('.rating-star');
             stars.forEach((star, index) => {
                 if (index < rating) {
                     star.classList.remove('text-gray-300');
                     star.classList.add('text-yellow-400');
                 } else {
                     star.classList.remove('text-yellow-400');
                     star.classList.add('text-gray-300');
                 }
             });
         }

         // Initialize with 5 stars on page load
         document.addEventListener('DOMContentLoaded', function() {
             setRating(5);
         });
     </script>
 </body>

 </html>
