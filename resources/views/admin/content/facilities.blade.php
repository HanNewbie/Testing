@extends('layouts.sidebar')

@section('content')

<main>
  <div class="bg-white p-5 rounded-lg shadow max-w-6xl mx-auto mt-6">
    <h4 class="text-xl font-semibold mb-4">
        Tambah Fasilitas untuk: <span class="font-bold">{{ $content->name }}</span>
    </h4>

    <form action="{{ route('features.store') }}" method="POST">
        @csrf
        <input type="hidden" name="location" value="{{ $content->id }}">

        {{-- Pricelist --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">Penyewaan</label>
            <div class="overflow-x-auto">
                <table class="min-w-full border rounded-lg">
                    <thead>
                      <tr class="bg-gray-100">
                        <th class="px-3 py-2 text-left">Bagian</th>
                        <th class="px-3 py-2 text-left">Luas</th>
                        <th class="px-3 py-2 text-left">Harga (Rp)</th>
                        <th class="px-3 py-2"></th>
                      </tr>
                    </thead>
                    <tbody id="price-rows">
                      <tr class="border-b">
                        <td class="px-3 py-2">
                          <input type="text" name="features[0][bagian]" class="border w-full px-3 py-2 rounded" placeholder="Depan / Belakang / Samping">
                          <input type="hidden" name="features[0][type]" value="price">
                        </td>
                        <td class="px-3 py-2">
                          <input type="text" name="features[0][luas]" class="border w-full px-3 py-2 rounded" placeholder="10x10 / 20x20">
                        </td>
                        <td class="px-3 py-2">
                          <input type="number" name="features[0][price]" class="border w-full px-3 py-2 rounded" min="0" placeholder="1000000">
                        </td>
                        <td class="px-3 py-2 text-right">
                          <button type="button" class="remove-price-row text-red-600 hover:underline" disabled>Hapus</button>
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <button type="button" id="add-price-rows"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    + Tambah Baris
                </button>
            </div>
        </div>

        {{-- Fasilitas --}}
        <div class="mb-6">
          <label class="block font-semibold mb-2">Fasilitas</label>
          <div class="overflow-x-auto">
            <table class="min-w-full border rounded-lg">
              <thead>
                <tr class="bg-gray-100">
                  <th class="px-3 py-2 text-left">Nama Fasilitas</th>
                  <th class="px-3 py-2 text-left">Icon (opsional)</th>
                  <th class="px-3 py-2"></th>
                </tr>
              </thead>
              <tbody id="facility-rows">
                <tr class="border-b">
                  <td class="px-3 py-2">
                    <input type="text" name="features[100][facility_name]" class="border w-full px-3 py-2 rounded" placeholder="Misal: Area Parkir">
                    <input type="hidden" name="features[100][type]" value="facility">
                  </td>
                  <td class="px-3 py-2">
                    <input type="text" name="features[100][icon]" class="border w-full px-3 py-2 rounded" placeholder="ex: fa-car">
                  </td>
                  <td class="px-3 py-2 text-right">
                    <button type="button" class="remove-facility-row text-red-600 hover:underline" disabled>Hapus</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="mt-3">
            <button type="button" id="add-facility-rows"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                + Tambah Fasilitas
            </button>
          </div>
        </div>
        <div class="flex justify-between mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md">
                Simpan Fasilitas
            </button>
        </div>
    </form>
</div>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    let index = {
      price: 1,
      facility: 101 
    };

    const config = {
      price: {
        tbody: document.getElementById('price-rows'),
        button: document.getElementById('add-price-rows'),
        html: (i) => `
          <td class="px-3 py-2">
            <input type="text" name="features[${i}][bagian]" class="border w-full px-3 py-2 rounded" placeholder="Depan / Belakang / Samping">
            <input type="hidden" name="features[${i}][type]" value="price">
          </td>
          <td class="px-3 py-2">
            <input type="text" name="features[${i}][luas]" class="border w-full px-3 py-2 rounded" placeholder="10x10 / 20x20">
          </td>
          <td class="px-3 py-2">
            <input type="number" name="features[${i}][price]" class="border w-full px-3 py-2 rounded" min="0" placeholder="1000000">
          </td>
          <td class="px-3 py-2 text-right">
            <button type="button" class="remove-row text-red-600 hover:underline">Hapus</button>
          </td>
        `
      },
      facility: {
        tbody: document.getElementById('facility-rows'),
        button: document.getElementById('add-facility-rows'),
        html: (i) => `
          <td class="px-3 py-2">
            <input type="text" name="features[${i}][facility_name]" class="border w-full px-3 py-2 rounded" placeholder="Misal: Toilet Umum">
            <input type="hidden" name="features[${i}][type]" value="facility">
          </td>
          <td class="px-3 py-2">
            <input type="text" name="features[${i}][icon]" class="border w-full px-3 py-2 rounded" placeholder="fa-icon">
          </td>
          <td class="px-3 py-2 text-right">
            <button type="button" class="remove-row text-red-600 hover:underline">Hapus</button>
          </td>
        `
      }
    };

    function addRow(type) {
      const tr = document.createElement('tr');
      tr.className = 'border-b';
      tr.innerHTML = config[type].html(index[type]);
      config[type].tbody.appendChild(tr);
      index[type]++;
      refreshRemoveButtons();
    }

    function refreshRemoveButtons() {
      document.querySelectorAll('.remove-row').forEach((btn) => {
        btn.disabled = false;
        btn.onclick = () => btn.closest('tr').remove();
      });
    }

    config.price.button.addEventListener('click', () => addRow('price'));
    config.facility.button.addEventListener('click', () => addRow('facility'));

    if (config.price.tbody.children.length === 0) addRow('price');
    if (config.facility.tbody.children.length === 0) addRow('facility');

    refreshRemoveButtons();
  });
</script>

@endsection