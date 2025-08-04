@extends('layouts.info')

@section('content')
<main class="p-6 bg-gray-50 flex-1">
  <h1 class="bg-primary mx-auto w-max text-center px-8 py-2 rounded-2xl uppercase text-white font-bold text-base">
      Riwayat Pengajuan
    </h1>

  <div class="bg-white shadow-md rounded-lg p-4">
    <table class="w-full border-collapse mt-6 shadow-md rounded overflow-hidden">
    <thead>
        <tr class="bg-primary text-white text-left">
        <th class="p-3">No</th>
        <th class="p-3">Tanggal Pengajuan</th>
        <th class="p-3">Vendor</th>
        <th class="p-3">Lokasi</th>
        <th class="p-3">Kegiatan</th>
        <th class="p-3">Dokumen</th>
        <th class="p-3">Status</th>
        <th class="p-3">Catatan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($submissions as $sub)
        <tr class="border-b">
            <td class="p-3 text-center">{{ $loop->iteration }}</td>
            <td class="p-3">{{ $sub->apply_date }}</td>
            <td class="p-3">{{ $sub->vendor }}</td>
            <td class="p-3">{{ $sub->location }}</td>
            <td class="p-3">{{ $sub->name_event }}</td>
            <td class="p-3 space-y-1">
            @if($sub->appl_letter)
                <a href="{{ asset('storage/' . $sub->appl_letter) }}" target="_blank" class="text-blue-600 underline block">
                📄 Surat Pengajuan
                </a>
            @endif
            @if($sub->actv_letter)
                <a href="{{ asset('storage/' . $sub->actv_letter) }}" target="_blank" class="text-blue-600 underline block">
                📑 Proposal Kegiatan
                </a>
            @endif
            @if($sub->ktp)
                <a href="{{ asset('storage/' . $sub->ktp) }}" target="_blank" class="text-blue-600 underline block">
                🆔 Scan KTP
                </a>
            @endif
            </td>
            <td class="p-3 text-center font-semibold">
            @if($sub->status == 'pending')
                <span class="text-yellow-600">Pending</span>
            @elseif($sub->status == 'approved')
                <span class="text-green-600">Disetujui</span>
            @else
                <span class="text-red-600">Ditolak</span>
            @endif
            </td>
            <td class="p-3">
            @if($sub->notes)
                <div class="text-gray-700">{{ $sub->notes }}</div>
            @else
                <span class="text-gray-400 italic">-</span>
            @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="p-4 text-center text-gray-500 italic">Belum ada data pengajuan.</td>
        </tr>
        @endforelse
    </tbody>
    </table>
  </div>
</main>
@endsection
