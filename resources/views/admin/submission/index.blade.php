@extends('layouts.sidebar')

@section('content')
<main class="p-6 bg-gray-50 flex-1">
  <div class="flex justify-between items-center mb-4">
    <h3 class="text-lg font-semibold">Daftar Pengajuan</h3>
    <form action="{{ route('submission.index') }}" method="GET">
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
    <div class="mb-4 text-right">
      <a href="{{ route('submission.create') }}" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg">
        Tambah
      </a>
    </div>

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
                <form action="{{ route('submission.approved', $sub->id) }}" method="POST" class="inline-block form-approve-{{ $sub->id }}">
                    @csrf
                    @method('PUT')
                    <button type="button" onclick="confirmApprove({{ $sub->id }})" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm">
                    Approve
                    </button>
                </form>

                {{-- Reject --}}
               <form action="{{ route('submission.rejected', $sub->id) }}" method="POST" class="hidden" id="form-reject-{{ $sub->id }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="notes" id="notes-{{ $sub->id }}">
                </form>

                <!-- Tombol Trigger -->
                <button 
                    type="button" 
                    onclick="confirmReject({{ $sub->id }})" 
                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm"
                >
                    Reject
                </button>
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
  <script>
      // Fungsi Approve
      function confirmApprove(id) {
          Swal.fire({
              title: 'Setujui Pengajuan?',
              text: "Pastikan data pengajuan sudah benar.",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#28a745',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, setujui'
          }).then((result) => {
              if (result.isConfirmed) {
                  document.querySelector('.form-approve-' + id).submit();
              }
          });
        }

      // Fungsi Reject
      function confirmReject(id) {
          Swal.fire({
              title: 'Tolak Pengajuan?',
              input: 'textarea',
              inputLabel: 'Catatan (Notes)',
              inputPlaceholder: 'Tulis alasan penolakan di sini...',
              inputAttributes: {
                  'aria-label': 'Tulis alasan di sini'
              },
              showCancelButton: true,
              confirmButtonText: 'Selesai',
              cancelButtonText: 'Kembali',
              reverseButtons: false,
              preConfirm: (notes) => {
                  if (!notes) {
                      Swal.showValidationMessage('Catatan wajib diisi')
                  }
                  return notes;
              }
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('notes-' + id).value = result.value;
                  document.getElementById('form-reject-' + id).submit();
                }
              });
            }

      // Jalankan flash alert hanya jika bukan dari back/forward cache
      window.addEventListener('pageshow', function (event) {
          const fromCache = event.persisted || performance.getEntriesByType("navigation")[0]?.type === "back_forward";
          if (fromCache) return;

          // Flash message: error
          @if(session('error'))
          Swal.fire({
              title: "Gagal!",
              text: @json(session('error')),
              icon: "error",
              confirmButtonColor: "#d33"
          });
          @endif

          // Flash message: success
          @if(session('success'))
          Swal.fire({
              title: "Berhasil!",
              text: @json(session('success')),
              icon: "success",
              confirmButtonColor: "#3085d6"
          });
          @endif
      });
  </script>


@endsection
