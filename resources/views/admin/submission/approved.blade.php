@extends('layouts.sidebar')

@section('content')
<main class="p-6 bg-gray-50 flex-1">
  <div class="flex justify-between items-center mb-4">
    <h3 class="text-lg font-semibold">Daftar Pengajuan Approved</h3>
    <form action="{{ route('submission.approved.list') }}" method="GET">
      <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}"
        placeholder="Search by vendor..." 
        class="border px-4 py-2 rounded-lg w-64"
      >
    </form>
  </div>

  <div class="bg-white shadow-md rounded-lg p-4">
    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-blue-300 text-white">
          <th class="p-3">No</th>
          <th class="p-3">ID</th>
          <th class="p-3">Pihak Pengusul</th>
          <th class="p-3">Pengajuan</th>
          <th class="p-3">Spesifikasi</th>
          <th class="p-3">Lampiran</th>
          <th class="p-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($submissions as $sub)
          <tr class="border-b">
            <td class="p-3 text-center">{{ $loop->iteration }}</td>
            <td class="p-3 text-center">{{ $sub->id }}</td>
            <td class="p-3">{{ $sub->vendor }}</td>
            <td class="p-3">{{ $sub->apply_date }}</td>
            <td class="p-3">{{ $sub->name_event }}</td>
            <td class="p-3">
              @if($sub->appl_letter)
                <a href="{{ asset('storage/' . $sub->appl_letter) }}" target="_blank" class="text-blue-600 underline">
                  📄 Surat Pengajuan
                </a><br>
              @else
                <span class="text-gray-500 italic">Tidak ada</span><br>
              @endif

              @if($sub->actv_letter)
                <a href="{{ asset('storage/' . $sub->actv_letter) }}" target="_blank" class="text-blue-600 underline">
                  📑 Proposal Kegiatan
                </a><br>
              @else
                <span class="text-gray-500 italic">Tidak ada</span><br>
              @endif

              @if($sub->ktp)
                <a href="{{ asset('storage/' . $sub->ktp) }}" target="_blank" class="text-blue-600 underline">
                  🆔 Scan KTP
                </a>
              @else
                <span class="text-gray-500 italic">Tidak ada</span>
              @endif
            </td>
            <td class="p-3 text-center">
              {{-- Approve --}}
                <a class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm">{{$sub->status}}</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="p-4 text-center text-gray-500">Data pengajuan belum tersedia.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</main>
@endsection
