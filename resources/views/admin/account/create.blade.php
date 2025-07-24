@extends('layouts.sidebar')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Tambah Admin Baru</h2>
        <a href="{{ route('account.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg text-gray-700">Kembali</a>
    </div>

            @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('sukses'))
            <div class="mb-4 bg-green-100 text-green-700 p-4 rounded">
                {{ session('sukses') }}
            </div>
        @endif

    <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Username Admin</label>
                <input type="text" name="username" class="w-full border rounded-lg px-3 py-2" placeholder="username">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Alamat Email</label>
                <input type="email" name="email" class="w-full border rounded-lg px-3 py-2" placeholder="xxx@x.com">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Nomor Handphone</label>
                <input type="text" name="phone" class="w-full border rounded-lg px-3 py-2" placeholder="0866xxxxxxx">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Aktif</label>
                <input type="date" name="created_at" class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Foto</label>
                <input type="file" name="photo" class="w-full border rounded-lg px-3 py-2">
            </div>
        </div>

        <div class="mt-6">
            <label class="block text-sm font-medium mb-1">Nama Lengkap Admin</label>
            <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" placeholder="Nama Lengkap Admin">
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg">
                Tambah
            </button>
        </div>
    </form>
</div>
@endsection
