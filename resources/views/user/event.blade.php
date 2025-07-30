@extends('layouts.info')

@section('content')
<section class="py-6 px-3">
  <div>
    <h1 class="bg-primary mx-auto w-max text-center px-8 py-2 rounded-2xl uppercase text-white font-bold text-base">
      Jadwal Event
    </h1>
    <div class="grid grid-cols-1 gap-6 mt-10 lg:grid-cols-4 lg:gap-8">
      @forelse ($contents as $item)
          <div class="flex flex-col items-center bg-primary shadow-lg rounded-lg overflow-hidden">
            <img class="w-full h-[230px] object-cover" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
            <div class="p-4 text-left w-full">
              <h2 class="font-bold text-white text-xl mb-2">{{$item->name}}</h2>
              <div class="flex justify-between items-center">
                <p class="font-semibold text-white">Jelajah Sekarang</p>
                <a href="{{ route('booking', $item->slug) }}">
                  <img src="../assets/svg/arrow-next-putih.svg" alt="">
                </a>
              </div>
            </div>
          </div>
      @empty
        <p class="text-gray-500 italic">Belum ada event tersedia.</p>
      @endforelse
    </div>
</section>

@endsection
