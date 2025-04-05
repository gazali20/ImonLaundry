<x-layout.default>
    <div class="bg-white p-4 rounded-lg shadow mt-6">
        <h3 class="text-lg font-semibold mb-4">Rincian Pesanan</h3>
    
        <form action="{{ route('kasir.updateStatus', $kasir->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium">Nama Pelanggan</label>
                    <p>{{ $kasir->customer }}</p>
                </div>
                <div>
                    <label class="block font-medium">No HP</label>
                    <p>{{ $kasir->no_handphone }}</p>
                </div>
                <div>
                    <label class="block font-medium">Tanggal</label>
                    <p>{{ $kasir->date }}</p>
                </div>
                <div>
                    <label class="block font-medium">Pembayaran</label>
                    <p>{{ $kasir->payment }}</p>
                </div>
            </div>
    
            <div class="mb-4">
                <label for="status" class="block font-medium mb-1">Status Pesanan</label>
                <select name="status" id="status" class="w-full border rounded p-2">
                    <option value="sedang_dicuci" {{ $kasir->status == 'sedang_dicuci' ? 'selected' : '' }}>Dicuci</option>
                    <option value="siap_diambil" {{ $kasir->status == 'siap_diambil' ? 'selected' : '' }}>Siap Diambil</option>
                    <option value="selesai" {{ $kasir->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
    
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded mb-6">
                Simpan Perubahan
            </button>
        </form>
    
        {{-- Daftar Pesanan --}}
        <h4 class="text-md font-semibold mb-2">Layanan yang Dipesan</h4>
        @if ($kasir->kasirService->count() > 0)
            <table class="w-full border-collapse items-center">
                <thead>
                    <tr class="bg-gray-100 text-left font-bold">
                        <th>No</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Berat (kg)</th>
                        <th class="p-3">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kasir->kasirService as $item)
                        <tr class="border-b">
                            <td class="p-3">{{ $loop->iteration }}</td> <!-- Nomor urut -->
                          
                            <td class="p-3">{{ $item->weight }} kg</td>
                            <td class="p-3">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td> 
                            <td class="p-3">{{ $item->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">Tidak ada layanan yang dipesan.</p>
        @endif
    </div>
    </x-layout.default>
    