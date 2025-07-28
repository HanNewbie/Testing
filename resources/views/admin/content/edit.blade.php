@extends('layouts.sidebar')

@section('content')
<main class="p-6 bg-gray-50 flex-1">
    <div class="mb-6">
        <h3 class="text-2xl font-semibold mb-2">Edit Tempat Wisata</h3>
    </div>

    <div class="bg-white p-5 rounded-lg shadow max-w-6xl mx-auto">
        <form action="{{ route('content.update', $content->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama Tempat --}}
            <div class="mb-4 flex items-center">
                <label for="name" class="w-1/4 font-medium">Nama Tempat</label>
                <input type="text" name="name" id="name" class="border px-4 py-2 rounded-lg w-3/4" value="{{ old('name', $content->name) }}" required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4 flex items-start">
                <label for="description" class="w-1/4 font-medium pt-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="border px-4 py-2 rounded-lg w-3/4" required>{{ old('description', $content->description) }}</textarea>
            </div>

            {{-- Harga Tiket --}}
            <div class="mb-4 flex items-center">
                <label for="price" class="w-1/4 font-medium">Harga Tiket</label>
                <input type="number" name="price" id="price" class="border px-4 py-2 rounded-lg w-3/4" value="{{ old('price', $content->price) }}" required>
            </div>

            {{-- Jam Operasional --}}
            <div class="mb-4 flex items-center">
                <label class="w-1/4 font-medium">Jam Operasional</label>
                <div class="flex items-center gap-2 w-3/4">
                    <div class="w-full">
                        <label for="open_time" class="block font-medium mb-1">Jam Buka</label>
                        <input type="time" name="open_time" id="open_time" class="border px-4 py-2 rounded-lg w-full" value="{{ old('open_time', \Carbon\Carbon::parse($content->open_time)->format('H:i')) }}">
                    </div>
                    <div class="text-xl font-semibold text-gray-600 pt-6">-</div>
                    <div class="w-full">
                        <label for="close_time" class="block font-medium mb-1">Jam Tutup</label>
                        <input type="time" name="close_time" id="close_time" class="border px-4 py-2 rounded-lg w-full" value="{{ old('open_time', \Carbon\Carbon::parse($content->close_time)->format('H:i')) }}">
                    </div>
                </div>
            </div>

            {{-- Lokasi --}}
            <div class="mb-4 flex items-center">
                <label for="location" class="w-1/4 font-medium">Lokasi</label>
                <input type="text" name="location" id="location" class="border px-4 py-2 rounded-lg w-3/4" value="{{ old('location', $content->location) }}" required>
            </div>

            {{-- Gambar Lama --}}
            @if ($content->image)
            <div class="mb-4 flex items-center">
                <label class="w-1/4 font-medium">Gambar Saat Ini</label>
                <div class="w-3/4">
                    <img src="{{ asset('storage/' . $content->image) }}" alt="Image" class="w-40 h-28 object-cover rounded">
                </div>
            </div>
            @endif

            {{-- Upload Gambar Baru --}}
            <div class="mb-4 flex items-center">
                <label for="image" class="w-1/4 font-medium">Ganti Gambar (opsional)</label>
                <input type="file" name="image" id="image" accept="image/*" class="border px-4 py-2 rounded-lg w-3/4">
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between mt-6">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-md">Perbarui</button>
                <a href="{{ route('content.index') }}" class="bg-gray-300 hover:bg-gray-400 px-6 py-2 rounded-md">Batal</a>
            </div>
        </form>
    </div>
</main>

@if(session('error'))
<script>
    Swal.fire({
        title: "Gagal!",
        text: "{{ session('error') }}",
        icon: "error",
        confirmButtonColor: "#d33"
    });
</script>
@endif
@endsection
