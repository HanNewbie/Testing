<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="flex flex-col min-h-screen">
  <!-- Header -->
  <header class="bg-white shadow-md p-4 flex justify-between items-center">
    <div class="flex items-center">
      <img src="{{ asset('assets/img/logo blud.png') }}" alt="Logo" class="h-10 mr-2">
    </div>
    <div class="flex items-center">
      <span class="mr-4 font-medium text-gray-700">{{ auth()->user()->username }}</span>
      <img src="{{auth()->user()->photo }}" alt="Profile" class="h-10 w-10 rounded-full border border-gray-300">
    </div>
  </header>

  <div class="flex flex-1">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md flex flex-col">
  <nav class="mt-4 flex-1">
    <ul>
      {{-- Dashboard --}}
      <li>
        <a href="{{ route('admin.dashboard') }}"
           class="w-full block px-6 py-3 rounded text-left
           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white' : 'hover:bg-blue-100 text-black' }}">
          🏠 Dashboard
        </a>
      </li>

      {{-- Pengguna --}}
      @php
        $isUserActive = request()->is('admin/account*') || request()->is('admin/umum*');
      @endphp
      <li>
        <button onclick="toggleDropdown('dropdownUserMenu', this)"
          class="w-full flex justify-between items-center px-6 py-3 rounded text-left
          {{ $isUserActive ? 'bg-blue-500 text-white' : 'hover:bg-blue-100 text-black' }}">
          <div class="flex items-center"><span class="mr-3">👤</span> Pengguna</div>
          <img src="{{ asset('assets/img/dropdownimg.png') }}" class="w-4 h-4 transform transition-transform duration-200"
               :class="{ 'rotate-180': {{ $isUserActive ? 'true' : 'false' }} }">
        </button>
        <ul id="dropdownUserMenu" class="ml-6 mt-1 text-sm bg-white shadow-md rounded-md {{ $isUserActive ? '' : 'hidden' }}">
          <li class="px-6 py-2 {{ request()->routeIs('admin.account.index') ? 'bg-blue-500 text-white' : 'hover:bg-blue-100' }}">
            <a href="{{ route('account.index') }}">Admin</a>
          </li>
          <li class="px-6 py-2 hover:bg-blue-100">
            <a href="{{ route('user.index') }}">Umum</a>
          </li>
        </ul>
      </li>

      {{-- Edit Fitur --}}
      @php
        $isFiturActive = request()->is('admin/fitur*') || request()->is('jadwal*') || request()->is('berita*') || request()->is('tempatwisata*');
      @endphp
      <li>
        <button onclick="toggleDropdown('dropdownEditFitur', this)"
          class="w-full flex justify-between items-center px-6 py-3 rounded text-left
          {{ $isFiturActive ? 'bg-blue-500 text-white' : 'hover:bg-blue-100 text-black' }}">
          <div class="flex items-center"><span class="mr-3">⚙️</span> Edit Fitur</div>
          <img src="{{ asset('assets/img/dropdownimg.png') }}" class="w-4 h-4">
        </button>
        <ul id="dropdownEditFitur" class="ml-6 mt-1 text-sm bg-white shadow-md rounded-md {{ $isFiturActive ? '' : 'hidden' }}">
          <li class="px-6 py-2 hover:bg-blue-100"><a href="#">Jadwal</a></li>
          <li class="px-6 py-2 hover:bg-blue-100"><a href="#">Berita</a></li>
          <li class="px-6 py-2 hover:bg-blue-100"><a href="#">Tempat Wisata</a></li>
        </ul>
      </li>

      {{-- Pengajuan --}}
      @php
        $isPengajuanActive = request()->is('pengajuanadmin*') || request()->is('approvenew*') || request()->is('rejectpengajuan*');
      @endphp
      <li>
        <button onclick="toggleDropdown('dropdownPengajuan', this)"
          class="w-full flex justify-between items-center px-6 py-3 rounded text-left
          {{ $isPengajuanActive ? 'bg-blue-500 text-white' : 'hover:bg-blue-100 text-black' }}">
          <div class="flex items-center"><span class="mr-3">📑</span> Pengajuan</div>
          <img src="{{ asset('assets/img/dropdownimg.png') }}" class="w-4 h-4">
        </button>
        <ul id="dropdownPengajuan" class="ml-6 mt-1 text-sm bg-white shadow-md rounded-md {{ $isPengajuanActive ? '' : 'hidden' }}">
          <li class="px-6 py-2 hover:bg-blue-100"><a href="#">List Pengajuan</a></li>
          <li class="px-6 py-2 hover:bg-blue-100"><a href="#">Approved</a></li>
          <li class="px-6 py-2 hover:bg-blue-100"><a href="#">Rejected</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div class="px-4 py-6 border-t">
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
            Logout
        </button>
      </form>
    </div>
</aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      @yield('content')
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-white p-4 text-center text-sm text-gray-500">
    © BLUD Pariwisata, All rights reserved.
  </footer>
</div>

    <!-- SCRIPT -->
 <script>
    let activeButtonId = null; // menyimpan tombol yang terakhir aktif

    function resetButtonStyles(exceptId = null) {
        const buttonIds = ['buttonDashboard', 'buttonPengguna', 'buttonEditFitur', 'buttonPengajuan'];
        buttonIds.forEach(id => {
            const btn = document.getElementById(id);
            if (btn) {
                if (id === exceptId) {
                    btn.classList.add('bg-blue-100');
                    activeButtonId = id; // simpan tombol aktif
                } else {
                    btn.classList.remove('bg-blue-100');
                }
            }
        });
    }

    function closeAllDropdowns(exceptId = null) {
        const dropdownIds = ['dropdownUserMenu', 'dropdownEditFitur', 'dropdownPengajuan'];
        dropdownIds.forEach(id => {
            const dropdown = document.getElementById(id);
            if (dropdown && id !== exceptId) {
                dropdown.classList.add('hidden');
            }
        });
    }

    function toggleDropdown(menuId, buttonId) {
        const dropdown = document.getElementById(menuId);
        const isHidden = dropdown.classList.contains('hidden');

        closeAllDropdowns(menuId);
        dropdown.classList.toggle('hidden', !isHidden);

        resetButtonStyles(isHidden ? buttonId : null);
    }

    function activateMenu(buttonId) {
        closeAllDropdowns();
        resetButtonStyles(buttonId);
    }

    // Klik di luar sidebar: tutup dropdown, tapi tetap simpan tombol aktif
    document.addEventListener('click', function (e) {
        const isClickInsideSidebar = e.target.closest('aside');
        if (!isClickInsideSidebar) {
            closeAllDropdowns();
            // Jangan reset tombol aktif, cukup biarkan yang terakhir aktif tetap biru
            resetButtonStyles(activeButtonId);
        }
    });
    
</script>



</body>
</html>
