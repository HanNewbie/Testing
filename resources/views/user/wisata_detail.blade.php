@extends('layouts.info')

@section('content')
<section class="py-10 px-6">
    <h1 class="bg-primary mx-auto w-max text-center px-8 py-2 rounded-2xl uppercase text-white font-bold text-lg mb-8">
        {{ $contents->name }}
    </h1>

    <div class="max-w-5xl mx-auto">
        @if($contents->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $contents->image) }}" alt="{{ $contents->name }}" 
                     class="w-full rounded-xl shadow-md">
            </div>
        @endif

        <div class="bg-white border rounded-xl shadow p-6 mb-6">
            <h2 class="font-bold text-xl text-gray-800 mb-4">Deskripsi</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $contents->description ?? 'Tidak ada deskripsi untuk wisata ini.' }}
            </p>
        </div>

        <div class="bg-white border rounded-xl shadow p-6 mb-6">
            <h2 class="font-bold text-xl text-gray-800 mb-4">Jam Operasional</h2>
            <p class="text-gray-600 leading-relaxed">
                Senin - Minggu : {{\Carbon\Carbon::parse($contents->open_time ?? '' )->format('H:i') }}-{{\Carbon\Carbon::parse($contents->close_time ?? '' )->format('H:i') }}
            </p>
            <h2 class="font-bold text-xl text-gray-800 mb-4 mt-4">Harga Tiket</h2>
            <p class="text-gray-600 leading-relaxed">
                Weekday : {{ $contents->price_weekday ?? '' }}
            </p>
            <p class="text-gray-600">
                Weekend : {{ $contents->price_weekend ?? '' }}
            </p>
        </div>

        <div class="bg-white border rounded-xl shadow p-6 mb-6">
            <h2 class="font-bold text-xl text-gray-800 mb-4">Lokasi</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $contents->location ?? 'Tidak ada deskripsi untuk wisata ini.' }}
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15829.914480877947!2d109.216667!3d-7.299999850000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ff4e95950a913%3A0x14e355314c511c47!2sBaturaden%2C%20Dusun%20III%20Kalipagu%2C%20Ketenger%2C%20Kec.%20Baturaden%2C%20Kabupaten%20Banyumas%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1753862860219!5m2!1sid!2sid" width="975" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </p>
        </div>
            
       

        {{-- Tombol Booking (jika ada jadwal event) --}}
        {{-- <div class="flex justify-end">
            <a href="{{ route('booking', ['slug' => $content->slug]) }}"
               class="bg-primary text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-600">
                Lihat Jadwal Booking
            </a>
        </div> --}}
    </div>
</section>
@endsection
