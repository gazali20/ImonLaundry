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

        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded">
            Simpan Perubahan
        </button>
    </form>
</div>
</x-layout.default>