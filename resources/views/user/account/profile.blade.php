@extends('layouts.info') {{-- Ganti dengan layout kamu --}}
@section('content')
<div class="max-w-3xl mx-auto py-16 px-6">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 p-6 text-white text-center">
            <div class="w-24 h-24 mx-auto mb-4 rounded-full overflow-hidden border-4 border-white">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                     alt="Avatar" class="w-full h-full object-cover">
            </div>
            <h2 class="text-2xl font-bold">{{ Auth::user()->name }}</h2>
        </div>
        <div class="p-8 grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700">
            <div>
                <p class="text-sm font-medium text-gray-500">Username</p>
                <p class="text-lg font-semibold">{{ Auth::user()->username }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Email</p>
                <p class="text-lg font-semibold">{{ Auth::user()->email }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Nomor HP</p>
                <p class="text-lg font-semibold">
                    {{ Auth::user()->phone ?? 'Belum diisi' }}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
