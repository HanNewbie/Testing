@extends('layouts.info')

@section('content')
<section class="py-10 px-6">
    <h1 class="bg-primary mx-auto w-max text-center px-8 py-2 rounded-2xl uppercase text-white font-bold text-lg mb-8">
        {{ $contents->name }}
    </h1>

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Gambar Wisata --}}
        @if($contents->image)
            <div>
                <img src="{{ asset('storage/' . $contents->image) }}" alt="{{ $contents->name }}"
                     class="w-full rounded-xl shadow-md object-cover max-h-[500px]">
            </div>
        @endif

        {{-- Deskripsi --}}
        <div class="bg-white border rounded-xl shadow p-6">
            <h2 class="font-bold text-xl text-gray-800 mb-4">Deskripsi</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $contents->description ?? 'Tidak ada deskripsi untuk wisata ini.' }}
            </p>
        </div>

        {{-- Jam Operasional & Harga --}}
        <div class="bg-white border rounded-xl shadow p-6">
            <h2 class="font-bold text-xl text-gray-800 mb-4">Jam Operasional</h2>
            <p class="text-gray-600 mb-2">
                Senin - Minggu:
                {{ $contents->open_time ? \Carbon\Carbon::parse($contents->open_time)->format('H:i') : '-' }}
                -
                {{ $contents->close_time ? \Carbon\Carbon::parse($contents->close_time)->format('H:i') : '-' }}
            </p>

            <h2 class="font-bold text-xl text-gray-800 mt-6 mb-2">Harga Tiket</h2>
            <p class="text-gray-600">
                <strong>Weekday: </strong>Rp{{$contents->price_weekday ?? '-' }}
            </p>
            <p class="text-gray-600">
                <strong>Weekend: </strong>Rp{{$contents->price_weekend ?? '-' }}
            </p>
        </div>

        {{-- Lokasi --}}
        <div class="bg-white border rounded-xl shadow p-6">
            <h2 class="font-bold text-xl text-gray-800 mb-4">Lokasi</h2>
            @if ($contents->location)
                <p class="text-gray-700 font-medium mb-4">{{ $contents->location }}</p>
            @endif

            @if ($contents->location_embed)
                <div class="relative w-full pt-[56.25%] overflow-hidden rounded-lg">
                    {!! str_replace(
                        '<iframe ',
                        '<iframe style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;" ',
                        $contents->location_embed
                    ) !!}
                </div>
            @else
                <p class="text-gray-500 italic">Peta lokasi belum tersedia.</p>
            @endif
        </div>

    </div>
</section>
@endsection



{{-- Tombol Booking (jika ada jadwal event) --}}
        {{-- <div class="flex justify-end">
            <a href="{{ route('booking', ['slug' => $content->slug]) }}"
               class="bg-primary text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-600">
                Lihat Jadwal Booking
            </a>
        </div> --}}