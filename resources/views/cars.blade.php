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

      <header>
          <nav class="bg-sec-600 border-gray-200 px-4 lg:px-6 py-4 mb-8">
              <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                  <!-- LOGO -->
                  <a href="/home" class="flex items-center">
                      <img loading="lazy" src="/storage/logos/loogo2.png" class="mr-3 h-12" alt="Logo" />
                  </a>

                  <!-- User Menu / Auth Buttons -->
                  <div class="flex items-center lg:order-2">
                      {{-- Client Dropdown --}}
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

                      <!-- Dropdown menu -->
                      <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                          <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                              <li>
                                  <a href="#" class="block px-4 py-2 hover:bg-pr-200">Profile</a>
                              </li>
                              <li>
                                  <a href="#" class="block px-4 py-2 hover:bg-pr-200">Reservasi Saya</a>
                              </li>
                              <li>
                                  <a class="block px-4 py-2 hover:bg-pr-200" href="/logout"
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
                              <a href="/cars" class="block py-2 pr-4 pl-3 text-gray-700 hover:text-orange-500 lg:p-0">
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

      <div class="bg-gray-200 mx-auto max-w-screen-xl mt-10 p-6 rounded-md shadow-xl">
          <form action="/cars/search" method="GET">
              <!-- First Row -->
              <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Merek</label>
                      <input type="text" placeholder="Toyota" name="brand" value="{{ request('brand') }}"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                      <input type="text" placeholder="Camry" name="model" value="{{ request('model') }}"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                      <select name="category"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                          <option value="">Semua Kategori</option>
                          <option value="Sedan" {{ request('category') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                          <option value="City Car" {{ request('category') == 'City Car' ? 'selected' : '' }}>City Car
                          </option>
                          <option value="SUV" {{ request('category') == 'SUV' ? 'selected' : '' }}>SUV</option>
                          <option value="Crossover" {{ request('category') == 'Crossover' ? 'selected' : '' }}>Crossover
                          </option>
                          <option value="Double Cabin" {{ request('category') == 'Double Cabin' ? 'selected' : '' }}>
                              Double Cabin</option>
                          <option value="MPV" {{ request('category') == 'MPV' ? 'selected' : '' }}>MPV</option>
                          <option value="Hatchback" {{ request('category') == 'Hatchback' ? 'selected' : '' }}>
                              Hatchback</option>
                      </select>
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Transmisi</label>
                      <select name="transmission"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                          <option value="">Semua</option>
                          <option value="Otomatis" {{ request('transmission') == 'Otomatis' ? 'selected' : '' }}>
                              Otomatis</option>
                          <option value="Manual" {{ request('transmission') == 'Manual' ? 'selected' : '' }}>Manual
                          </option>
                      </select>
                  </div>
              </div>

              <!-- Second Row -->
              <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Bahan Bakar</label>
                      <select name="fuel_type"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                          <option value="">Semua</option>
                          <option value="Bensin" {{ request('fuel_type') == 'Bensin' ? 'selected' : '' }}>Bensin
                          </option>
                          <option value="Solar" {{ request('fuel_type') == 'Solar' ? 'selected' : '' }}>Solar
                          </option>
                          <option value="Listrik" {{ request('fuel_type') == 'Listrik' ? 'selected' : '' }}>Listrik
                          </option>
                      </select>
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Kursi Minimum</label>
                      <select name="seats"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                          <option value="">Semua</option>
                          <option value="2" {{ request('seats') == '2' ? 'selected' : '' }}>2+ Kursi</option>
                          <option value="4" {{ request('seats') == '4' ? 'selected' : '' }}>4+ Kursi</option>
                          <option value="5" {{ request('seats') == '5' ? 'selected' : '' }}>5+ Kursi</option>
                          <option value="7" {{ request('seats') == '7' ? 'selected' : '' }}>7+ Kursi</option>
                      </select>
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Harga Minimum</label>
                      <input type="number" placeholder="0" name="min_price" value="{{ request('min_price') }}"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Harga Maksimum</label>
                      <input type="number" placeholder="1000000" name="max_price"
                          value="{{ request('max_price') }}"
                          class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-500 sm:text-sm sm:leading-6">
                  </div>
              </div>

              <!-- Search and Clear Buttons -->
              <div class="flex justify-between items-center">
                  <div class="flex space-x-3">
                      <button type="submit"
                          class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-md transition-colors">
                          Cari Mobil
                      </button>
                      <a href="/cars"
                          class="bg-gray-400 hover:bg-gray-500 text-white font-medium py-2 px-6 rounded-md transition-colors">
                          Hapus Filter
                      </a>
                  </div>
                  <div class="text-sm text-gray-600">
                      Gunakan filter untuk mencari mobil yang sesuai
                  </div>
              </div>
          </form>
      </div>

      <div class="mt-6 mb-2 grid md:grid-cols-3 justify-center items-center mx-auto max-w-screen-xl">
          @forelse($cars as $car)
              <!-- Card Mobil: {{ $car->brand }} {{ $car->model }} -->
              <div
                  class="relative md:m-10 m-4 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
                  <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl"
                      href="/cars/{{ $car->id }}">
                      <img loading="lazy" class="object-cover w-full h-full" src="{{ $car->image_url }}"
                          alt="{{ $car->brand }} {{ $car->model }}" />
                      @if ($car->reduce > 0)
                          <span
                              class="absolute top-0 left-0 m-2 rounded-full bg-orange-500 px-2 text-center text-sm font-medium text-white">
                              {{ $car->reduce }}% OFF
                          </span>
                      @endif
                      @if ($car->status === 'disewa')
                          <span
                              class="absolute top-0 right-0 m-2 rounded-full bg-red-500 px-2 text-center text-sm font-medium text-white">
                              Disewa
                          </span>
                      @elseif($car->status === 'perbaikan')
                          <span
                              class="absolute top-0 right-0 m-2 rounded-full bg-yellow-500 px-2 text-center text-sm font-medium text-white">
                              Perbaikan
                          </span>
                      @endif
                  </a>
                  <div class="mt-4 px-5 pb-5">
                      <div>
                          <a href="/cars/{{ $car->id }}">
                              <h5
                                  class="font-bold text-xl tracking-tight text-slate-900 hover:text-orange-500 transition-colors">
                                  {{ $car->brand }} {{ $car->model }}
                              </h5>
                          </a>
                          <p class="text-sm text-gray-600 mt-1">
                              {{ $car->category }} • {{ $car->transmission_indonesian }} • {{ $car->seats }} Kursi
                          </p>
                      </div>
                      <div class="mt-2 mb-5 flex items-center justify-between">
                          <p>
                              @if ($car->reduce > 0)
                                  <span
                                      class="text-xl font-bold text-slate-900">{{ $car->formatted_discounted_price }}</span>
                                  <br>
                                  <span class="text-sm text-slate-900 line-through">{{ $car->formatted_price }}</span>
                              @else
                                  <span class="text-xl font-bold text-slate-900">{{ $car->formatted_price }}</span>
                                  <br>
                                  <span class="text-sm text-gray-500">per hari</span>
                              @endif
                          </p>
                          <div class="flex items-center ml-1">
                              @for ($i = 1; $i <= 5; $i++)
                                  @if ($i <= $car->stars)
                                      <svg aria-hidden="true" class="h-5 w-5 text-orange-400" fill="currentColor"
                                          viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                          <path
                                              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                          </path>
                                      </svg>
                                  @else
                                      <svg aria-hidden="true" class="h-5 w-5 text-gray-300" fill="currentColor"
                                          viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                          <path
                                              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                          </path>
                                      </svg>
                                  @endif
                              @endfor
                              <span
                                  class="mr-2 ml-3 rounded bg-orange-300 px-2.5 py-0.5 text-xs font-semibold">{{ number_format($car->stars, 1) }}</span>
                          </div>
                      </div>
                      <a href="/cars/{{ $car->id }}"
                          class="flex items-center justify-center rounded-md bg-slate-900 hover:bg-orange-500 px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 focus:ring-blue-300 transition-colors">
                          <svg class="mr-4 h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                              <path fill-rule="evenodd"
                                  d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                  clip-rule="evenodd" />
                          </svg>
                          Lihat Detail</a>
                  </div>
              </div>
          @empty
              <div class="col-span-3 text-center py-12">
                  <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada mobil ditemukan</h3>
                  <p class="mt-1 text-sm text-gray-500">Coba ubah filter pencarian Anda.</p>
              </div>
          @endforelse
      </div>


      <footer role="navigation" aria-label="Pagination Navigation"
          class="flex items-center justify-center mt-6 mb-8">
          <div class="flex flex-col justify-center items-center">
              {{ $cars->links() }}

              <!-- Info halaman -->
              <div class="mt-2">
                  <p class="text-sm text-gray-700 leading-5">
                      Menampilkan <span class="font-medium">{{ $cars->firstItem() ?? 0 }}</span> hingga <span
                          class="font-medium">{{ $cars->lastItem() ?? 0 }}</span> dari
                      <span class="font-medium">{{ $cars->total() }}</span> hasil
                  </p>
              </div>
          </div>
      </footer>

      <script>
          // Fungsi pencarian mobil
          function cariMobil() {
              Swal.fire({
                  icon: 'info',
                  title: 'Mencari Mobil',
                  text: 'Fitur pencarian sedang diproses...',
                  showConfirmButton: false,
                  timer: 1500
              });
          }

          // Fungsi hapus filter
          function hapusFilter(event) {
              event.preventDefault();
              Swal.fire({
                  icon: 'success',
                  title: 'Filter Dihapus',
                  text: 'Semua filter telah dihapus',
                  showConfirmButton: false,
                  timer: 1500
              }).then(() => {
                  window.location.href = '/cars';
              });
          }
      </script>
  </body>

  </html>
