<x-layout.default>

    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="/user" class="text-primary hover:underline">List layanan</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Detail</span>
        </li>
    </ul>

    <div class="pt-5">
        <div class="panel">
        <h4 class="text-xl font-semibold mb-4 dark:text-white-light">Detail Layanan</h4>

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

            <div>                
                @if($service->image)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Gambar</label>
                    <img src="{{ asset('images/services/' . $service->image) }}" alt="Gambar Layanan" class="mt-2 rounded-lg shadow-md w-full max-h-40 object-cover">
                </div>
                @endif
            </div>
        </div>

        <div class="mt-6 flex justify-start">
            {{-- <a href="{{ route('services.index') }}" class="btn btn-secondary mr-2">Kembali</a> --}}
            <a href="{{ route('services.edit', $service->id) }}" class="btn bg-purple-600 hover:bg-purple-700 text-white">Edit layanan</a>
        </div>
    </div>
    </div>
    
</x-layout.default>
