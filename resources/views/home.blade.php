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
      {{-- flatpickr JS --}}
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
      @vite('resources/css/app.css')
      @vite('resources/js/app.js')
      <style>
          html {
              scroll-behavior: smooth;
          }
      </style>
  </head>

  <body class="bg-sec-400">
      <header>
          <nav class="bg-sec-600 border-gray-200 px-4 lg:px-6 py-4 mb-8">
              <div class="flex flex-wrap justify-between items-center mx-auto max-w-7xl">
                  <!-- LOGO -->
                  <a href="/home" class="flex items-center">
                      <img loading="lazy" src="/storage/logos/loogo2.png" class="mr-3 h-12" alt="Logo" />
                  </a>
                  <div class="flex items-center lg:order-2">
                      <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                          class="text-black bg-pr-400 hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center"
                          type="button">
                          <img loading="lazy" src="/storage/images/user.png" width="24" alt="user icon"
                              class="mr-3">
                          {{ session('user_name') ?? 'Guest' }}
                          <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                              </path>
                          </svg>
                      </button>

                  </div>
                  <!-- Menu -->
                  <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu">
                      <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                          <li>
                              <a href="/home" class="block py-2 pr-4 pl-3 text-gray-700 hover:text-orange-500 lg:p-0">
                                  <div class="group text-center">
                                      <div class="group-hover:cursor-pointer">Beranda</div>
                                      <div
                                          class="block invisible bg-orange-500 w-12 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                      </div>
                                  </div>
                              </a>
                          </li>
                          <li>
                              <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 hover:text-orange-500 lg:p-0">
                                  <div class="group text-center">
                                      <div class="group-hover:cursor-pointer">Mobil</div>
                                      <div
                                          class="block invisible bg-orange-500 w-8 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible">
                                      </div>
                                  </div>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>
      </header>
      <main>
          <div class="bg-sec-400 m-8">
              <h1 class="font-bold text-5xl">DASHBOARD USER</h1>
              <h2 class="font-bold text-amber-500 text-3xl mb-4">Hello {{ session('user_name') }}</h2>
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
