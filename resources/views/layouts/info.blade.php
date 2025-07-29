<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="assets/css/output.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/input.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('assets/js/index.js') }}"></script>
</head>

<body class="pt-20">
  <!-- Section Header -->
  <header class="bg-white fixed top-0 left-0 right-0 z-50">
    <nav class="px-4 py-2 flex items-center justify-between w-full">
      <div>
        <img width="100" src="{{ asset('assets/svg/logo.svg') }}" alt="BLUD" />
      </div>
      <div>
        <button id="hamburger" name="hamburger" type="button" class="block lg:hidden">
          <span class="hamburger-line origin-top-left transition duration-300 ease-in-out"></span>
          <span class="hamburger-line transition duration-300 ease-in-out"></span>
          <span class="hamburger-line origin-bottom-left transition duration-300 ease-in-out"></span>
        </button>

        <div id="nav-menu"
          class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg lg:static lg:block lg:max-w-full lg:rounded-none lg:bg-transparent lg:shadow-none">
          <ul class="block lg:flex lg:items-center">
            <li class="group">
              <a href="index.html"
                class="mx-8 flex py-2 text-base font-bold text-blue-400 group-hover:text-primary">Home</a>
            </li>
            <li class="group">
              <li>
                <a href="jadwal_event.html" class="block p-2 hover:bg-gray-100">Jadwal</a>
              </li>  
            </li>
            <li class="group">
              <a href="objek_wisata.html"
                class="mx-8 flex py-2 text-base font text-gray-800 group-hover:text-primary">Objek Wisata</a>
            </li>
            <li class="group">
              <a href="login.html"
                class="mx-8 flex items-center justify-center py-2 px-4 text-base font-bold text-blue-400 border border-blue-400 rounded-md hover:bg-blue-400 hover:text-white transition group-hover:text-primary">Masuk/Daftar</a>
            </li>
          </ul>
        </div>
       
        <div id="sidebar"
          class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300">
          <div class="p-4 border-b flex justify-between items-center">
            <span class="text-lg font-bold">Menu</span>
            <button id="closeBtn" class="text-gray-700 text-xl">
              &times;
            </button>
          </div>
          <ul class="p-4 space-y-2">
            <li>
              <a href="#" class="block p-2 bg-blue-200 rounded">Home</a>
            </li>
            <li>
              <a href="objek_wisata.html" class="block p-2 hover:bg-gray-100">Objek Wisata</a>
            </li>
            <li>
              <li>
                <a href="jadwal_event.html" class="block p-2 hover:bg-gray-100">Jadwal</a>
              </li>  
            </li>
            <li>
              <a href="login.html" class="block p-2 hover:bg-gray-100">Masuk/Daftar</a>
            </li>
          </ul>
        </div>
        </div>
    </nav>
  </header>

   <main class="main">
            @yield('content')
    </main>

<footer>
    <div class="bg-slate-100 py-4 px-8 lg:flex lg:justify-around">
      <div class="flex items-center space-x-4">
          <img src="{{ asset('assets/svg/logo.svg') }}" alt="BLUD" class="h-14">
          <img src="{{ asset('assets/img/telu.png') }}" alt="Telkom" class="h-16">
      </div>
      <div class="text-primary py-4 flex justify-between flex-wrap gap-4 lg:gap-10">
        <div class="flex flex-col gap-2">
          <h2 class="font-bold text-xl">Link Terkait</h2>
          <p class="font-semibold text-base"><a href="">Home</a></p>
          <p class="font-semibold text-base">
            <a href="objek_wisata.html">Objek Wisata</a>
          </p>
          <p class="font-semibold text-base"><a href="">Jadwal</a></p>
        </div>
        <div class="flex flex-col gap-2">
          <h2 class="font-bold text-xl">Alamat</h2>
          <div class="flex items-start gap-2">
            <img class="text-primary" src="{{ asset('assets/svg/location.svg') }}" alt="" />
            <p class="font-semibold text-xs text-justify max-w-[150px]">
              Kantor BLUD Pariwisata Baturraden Glempang, Bancarkembar,
              Purwokerto Utara, Banyumas, 53121
            </p>
          </div>
        </div>
        <div class="flex flex-col gap-2">
          <h2 class="font-bold text-xl">Social Media</h2>
          <div class="flex items-center gap-2">
            <img class="text-primary" src="{{ asset('assets/svg/wa.svg') }}" alt="" />
            <p class="font-semibold text-xs">0867-0987-9987</p>
          </div>
          <div class="flex items-center gap-2">
            <img class="text-primary" src="{{ asset('assets/svg/instagram.svg') }}" alt="" />
            <p class="font-semibold text-xs">BLUD Pariwisata</p>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-primary p-4 text-center">
      <p class="text-white font-semibold">
        Copyright© BLUDPariwisata, All rights reserved.
      </p>
    </div>
  </footer>

  <script src="../js/index.js"></script>
</body>

</html>