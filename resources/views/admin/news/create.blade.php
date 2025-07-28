@extends('layouts.sidebar')

@section('content')
<main class="p-6 bg-gray-50 flex-1">
    <div class="mb-6">
        <h3 class="text-2xl font-semibold mb-2">Tambah Berita</h3>
    </div>

    <div class="bg-white p-5 rounded-lg shadow max-w-6xl mx-auto">
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Upload Gambar --}}
            <div class="mb-4 flex items-center">
                <label for="image" class="w-1/4 font-medium">Upload Gambar</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-3/4 border px-4 py-2 rounded-lg">
            </div>

            {{-- Judul --}}
            <div class="mb-4 flex items-center">
                <label for="title" class="w-1/4 font-medium">Judul Berita</label>
                <input type="text" name="title" id="title" class="w-3/4 border px-4 py-2 rounded-lg" required>
            </div>

            {{-- Isi Berita --}}
            <div class="mb-4 flex items-start">
                <label for="content" class="w-1/4 font-medium pt-2">Isi Berita</label>
                <textarea name="content" id="content" rows="6" class="w-3/4 border px-4 py-2 rounded-lg" required></textarea>
            </div>

            <div class="mt-6 flex justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md">Simpan</button>
                <a href="{{ route('news.index') }}" class="bg-gray-300 hover:bg-gray-400 px-6 py-2 rounded-md">Kembali</a>
            </div>

        </form>
    </div>
</main>
@endsection
