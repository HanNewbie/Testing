@extends('layouts.info')

@section('content')
<section class="py-6 px-3">
  <div>
    <h1 class="bg-primary mx-auto w-max text-center px-8 py-2 rounded-2xl uppercase text-white font-bold text-base">
      Objek Wisata
    </h1>
    <div class="grid grid-cols-1 gap-6 mt-10 lg:grid-cols-4 lg:gap-8">
      @forelse ($contents as $item)
          <div class="flex flex-col items-center shadow-lg rounded-lg overflow-hidden">
            <img class="w-full h-[230px] object-cover" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
            <div class="p-4 text-left w-full">
              <h2 class="font-bold text-black text-xl mb-2">{{$item->name}}</h2>
              <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <img src="../assets/svg/location.svg" alt="Location" />
                    <p class="font-semibold">{{$item->location}}</p>
                </div>
              </div>
                <div class="flex justify-end mt-auto">
                    <a href="{{ route('wisata.detail', ['slug' => $item->slug]) }}"
                    class="bg-primary text-white font-bold py-2 px-4 rounded-lg">
                        Lihat Detail
                    </a>
                </div>
          </div>
      @empty
        <p class="text-gray-500 italic">Belum ada event tersedia.</p>
      @endforelse
    </div>
</section>

@endsection
