@extends('layouts.info')
@section('content')

<div class="relative w-full h-[400px]">
    <img src="{{ asset('assets/img/bg-hero.png') }}" alt="hero" class="w-full h-full object-cover brightness-75" />
    <div class="absolute inset-0 flex items-center justify-center">
      <h1 class="text-white text-center text-xl md:text-3xl font-bold px-4">
        Selamat Datang,<br />
        <span class="font-extrabold">Bersama BLUD Pariwisata, Eksplorasi Banyumas Lebih Dekat!</span>
      </h1>
    </div>
  </div>
  
@endsection