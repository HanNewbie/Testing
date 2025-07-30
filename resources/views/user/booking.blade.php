@extends('layouts.info')

@section('content')
 <sectionc class="py-[60px] px-6">
     <h1 class="bg-primary mx-auto w-max text-center mb-16 mt-10 px-8 py-3 rounded-2xl uppercase text-white font-bold text-xl">
        Jadwal Booking
      </h1> 
        <div  class="max-w-5xl mx-auto">
            @forelse($events as $bulan => $items)
                <div class="mt-8 border rounded-lg p-4 relative">
                    <div class="absolute -top-4 left-4 bg-primary text-white font-bold px-4 py-2 rounded-lg">
                        {{ $bulan }}
                    </div>

                    @foreach($items as $ev)
                        <div class="flex justify-between items-center mt-8">
                            <div class="flex items-center gap-4">
                                <span class="bg-gray-100 text-sm px-3 py-1 rounded-full font-semibold">
                                    {{ \Carbon\Carbon::parse($ev->start_date)->translatedFormat('d') }}
                                    -
                                    {{ \Carbon\Carbon::parse($ev->end_date)->translatedFormat('d F Y') }}
                                </span>
                                <span class="font-semibold text-sm">{{ $ev->vendor }}</span>
                            </div>
                        </div>
                    @endforeach

                    <div class="flex justify-end mt-4">
                        <a href="{{ route('booking.detail', ['slug' => $slug, 'bulan' => strtolower($bulan)]) }}">
                            <img src="{{ asset('assets/svg/arrow-next.svg') }}" alt="">
                        </a>
                    </div>
                </div>
            @empty
                <p class="mt-4 text-gray-500 text-center">Belum ada event yang terjadwal.</p>
            @endforelse
        </div>
    </sectionc>
@endsection
