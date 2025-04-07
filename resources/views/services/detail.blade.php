<x-layout.default>

    <div class="pt-3">
        <div class="panel">
            <h2 class="text-lg font-semibold mb-4 flex items-center space-x-2">
                <a href="/services" class="inline-flex items-center">
                    <svg width="10" height="15" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M10.9415 1.7225C11.387 2.07069 11.4386 2.68226 11.0567 3.08848L3.14939 11.4997L11.0567 19.9109C11.4386 20.3171 11.387 20.9287 10.9415 21.2769C10.4959 21.6251 9.82518 21.578 9.44329 21.1718L0.94329 12.1301C0.602237 11.7674 0.602237 11.232 0.94329 10.8692L9.44329 1.82757C9.82518 1.42135 10.4959 1.37431 10.9415 1.7225Z"
                            fill="#1C274C" stroke="#1C274C" stroke-linecap="round" />
                    </svg>
                </a>
                <span>Detail Layanan</span>
            </h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Kode Layanan</label>
                    <div class="mt-1 p-2 bg-gray-100 rounded dark:bg-gray-700 dark:text-white">{{ $service->code }}</div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Nama Layanan</label>
                    <div class="mt-1 p-2 bg-gray-100 rounded dark:bg-gray-700 dark:text-white">{{ $service->name_service }}</div>
                </div>

                <div class="mb-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Kategori</label>
                    <div class="mt-1 p-2 bg-gray-100 rounded dark:bg-gray-700 dark:text-white">{{ $service->category->name_category ?? '-' }}</div>
                </div>

                <div class="mb-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Harga / Kg</label>
                    <div class="mt-1 p-2 bg-gray-100 rounded dark:bg-gray-700 dark:text-white">Rp{{ number_format($service->price, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="relative w-64 h-64 border bg-gray-100 border-gray-300 rounded-xl overflow-hidden group">                
                @if($service->image)
                <div class="mb-4">
                    <img src="{{ asset('images/services/' . $service->image) }}" alt="Gambar Layanan" class="  w-full h-full object-contain">
                </div>
                @endif
            </div>
        </div>

        <div class="mt-6 flex justify-start">
            {{-- <a href="{{ route('services.index') }}" class="btn btn-secondary mr-2">Kembali</a> --}}
            <a href="{{ route('services.edit', $service->id) }}" class="btn bg-purple-600 hover:bg-purple-700 text-white mr-4">Edit layanan</a>

            {{-- Hapus layanan --}}
            <form id="form-hapus-{{ $service->id }}" action="{{ route('services.destroy', $service->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete({{ $service->id }})"
                    class="btn bg-red-600 hover:bg-red-700 text-white">
                    Hapus
                </button>
            </form>
            
        </div>
    </div>
    </div>
    
    <script>
        function confirmDelete(serviceId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'YHapus!',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form jika user klik YES
                    document.getElementById(`form-hapus-${serviceId}`).submit();
                }
            });
        }
    </script>
    
</x-layout.default>
