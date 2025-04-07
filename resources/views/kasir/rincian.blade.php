<x-layout.default>
    <div class="bg-white p-4 rounded-lg shadow ">
        <div class="grid items-center justify-between mb-5">
            <h5 class="font-bold text-lg dark:text-white-light flex items-center">
                <a href="/kasir/detail" class="flex items-center">
                    <svg class="mr-2" width="10" height="21" viewBox="0 0 12 23" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M10.9415 1.72298C11.387 2.07117 11.4386 2.68275 11.0567 3.08897L3.14939 11.5002L11.0567 19.9114C11.4386 20.3176 11.387 20.9292 10.9415 21.2774C10.4959 21.6256 9.82518 21.5785 9.44329 21.1723L0.94329 12.1306C0.602237 11.7678 0.602237 11.2325 0.94329 10.8697L9.44329 1.82806C9.82518 1.42184 10.4959 1.37479 10.9415 1.72298Z"
                            fill="#1C274C" stroke="#1C274C" stroke-linecap="round" />
                    </svg>
                    Detail Pesanan
                </a>
            </h5>
        </div>
        

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12 mb-6">
            <div>
                <p class="text-gray-500 text-sm">Nama Pelanggan</p>
                <p class="text-base font-medium text-gray-800">{{ $kasir->customer }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">No HP</p>
                <p class="text-base font-medium text-gray-800">{{ $kasir->no_handphone }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Tanggal</p>
                <p class="text-base font-medium text-gray-800">{{ $kasir->date }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Pembayaran</p>
                <p class="text-base font-medium text-gray-800 capitalize">{{ $kasir->payment }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Status Pesanan</p>
                <p class="text-base font-medium text-gray-800 capitalize">{{ str_replace('_', ' ', $kasir->status) }}</p>
            </div>
        </div>
        

        {{-- Daftar Pesanan --}}
        <h4 class="font-bold text-lg dark:text-white-light flex items-center mb-3">Layanan Yang Dipesan</h4>
        @if ($kasir->kasirService->count() > 0)
            <table class="w-full border-collapse items-center">
                <thead>
                    <tr class="bg-gray-100 text-left font-bold">
                        <th>No</th>
                        <th class="p-3">Berat</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Layanan</th>
                        <th class="p-3">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kasir->kasirService as $item)
                        <tr class="border-b">
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">{{ $item->weight }} kg</td>
                            <td class="p-3">{{ $item->service->category->name_category ?? 'Kategori tidak ditemukan' }}</td>
                            <td class="p-3">{{ $item->service->name_service ?? 'Service tidak ditemukan' }}</td>
                            <td class="p-3">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">Tidak ada layanan yang dipesan.</p>
        @endif
        <div class="mb-4 pt-8">
            @if ($kasir->status === 'sedang_dicuci')
                <form action="{{ route('kasir.updateStatus', $kasir->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="siap_diambil">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        Tandai Siap Diambil
                    </button>
                </form>
            @elseif ($kasir->status === 'siap_diambil')
                <form action="{{ route('kasir.updateStatus', $kasir->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="selesai">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                        Tandai Selesai
                    </button>
                </form>
            @elseif ($kasir->status === 'selesai')
                <span class="text-green-600 font-semibold">Pesanan Selesai</span>
            @endif
        </div>

    </div>

</x-layout.default>
