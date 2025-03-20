<x-layout.default>

    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="/requirement" class="text-primary hover:underline">List kebutuhan</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Detail</span>
        </li>
    </ul>

    <div class="pt-5">
        <div class="panel">
        <h4 class="text-xl font-semibold mb-4 dark:text-white-light">Detail Kebutuhan</h4>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Nama kebutuhan</label>
                    <div class="mt-1 p-2 bg-gray-100 rounded dark:bg-gray-700 dark:text-white">{{ $requirement->requirement_name }}</div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Kategori kebutuhan</label>
                    <div class="mt-1 p-2 bg-gray-100 rounded dark:bg-gray-700 dark:text-white">{{ $requirement->need->name_category ?? '_' }}</div>
                </div>

                <div class="mb-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Harga/item</label>
                    <div class="mt-1 p-2 bg-gray-100 rounded dark:bg-gray-700 dark:text-white">{{ $requirement->price }}</div>
                </div>

                <div class="mb-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Harga / Kg</label>
                    <div class="mt-1 p-2 bg-gray-100 rounded dark:bg-gray-700 dark:text-white">Rp{{ number_format($requirement->price, 0, ',', '.') }}</div>
                </div>
            </div>

            <div>                
                @if($requirement->image)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Gambar</label>
                    <img src="{{ asset('images/services/' . $requirement->image) }}" alt="Gambar Layanan" class="mt-2 rounded-lg shadow-md w-full max-h-40 object-cover">
                </div>
                @endif
            </div>
        </div>

        <div class="mt-6 flex justify-start">
            {{-- <a href="{{ route('services.index') }}" class="btn btn-secondary mr-2">Kembali</a> --}}
            <a href="{{ route('requirement.edit', $requirement->id) }}" class="btn bg-purple-600 hover:bg-purple-700 text-white">Edit kebutuhan</a>
        </div>
    </div>
    </div>
    
</x-layout.default>
