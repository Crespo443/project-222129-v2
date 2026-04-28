<!DOCTYPE html>
<html lang="in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FunCar') }} - Admin Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-sec-400">
    <header>
        <nav class="bg-sec-600 border-gray-200 px-4 lg:px-6 py-4 mb-8">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-7xl">
                {{-- LOGO --}}
                <a href="#" class="flex items-center">
                    <img loading="lazy" src="/storage/logos/loogo2.png" class="mr-3 h-12" alt="Flowbite Logo" />
                </a>
                <div class="hidden justify-between mb-6 items-center w-full lg:flex lg:w-auto" id="mobile-menu-2">
                    <ul class="flex flex-col  font-medium lg:flex-row lg:space-x-8 lg:mt-0 ">
                        <li>
                            <a href='/admin/dashboard'>
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer">Dasboard</div>
                                    <div
                                        class="block invisible bg-pr-400 w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                            </a>

                        </li>

                        <li class=' '>
                            <a href="#">
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer ">Mobil</div>
                                    <div
                                        class="block invisible bg-pr-400 w-8 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="group text-center">
                                    <div class="group-hover:cursor-pointer">Ulasan</div>
                                    <div
                                        class="block invisible bg-pr-400 w-12 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                    </div>
                            </a>
                        </li>

                    </ul>
                </div>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="text-black bg-pr-400 hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center "
                    type="button">
                    <img loading="lazy" src="/storage/images/user.png" width="24" alt="user icon" class="mr-3">
                    <p> Admin</p>
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
            </div>
        </nav>
    </header>
    <main>
        <div class="m-6">
            <h1 class="font-bold text-5xl text-black my-5">DASHBOARD <span class="text-amber-500">ADMIN</span></h1>
            <a class="relative px-6 py-2 rounded-lg border-2 bg-black text-white text-l font-semibold" href='/logout'
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="/logout" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </main>
</body>
</html>
