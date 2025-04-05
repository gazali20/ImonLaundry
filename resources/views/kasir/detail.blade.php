<x-layout.default>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="/assets/js/simple-datatables.js"></script>

    {{-- Tambahkan CSS untuk x-cloak --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <div class="flex justify-between items-center w-full px-3">
        <div>
            <h1 class=" text-xl ">Status Layanan</h1>
        </div>
        <div class="flex">
            <a href="/kasir"
                class="btn mr-3 bg-white font-semibold hover:bg-purple-500 hover:text-white text-black shadow-none">Kasir</a>
            <a href="#" class="btn bg-purple-600 hover:bg-purple-700 text-white">Pesanan</a>
        </div>
    </div>

    <div x-data="{ activeTab: 'dicuci' }" class="pt-5">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="panel h-36 bg-cover bg-center bg-no-repeat flex flex-col justify-end p-4"
                style="background-image: url('{{ asset('assets/images/1742552634.png') }}');">
                <div class="flex justify-end">
                    <a href="#" @click.prevent="activeTab = 'dicuci'" class="btn border-none"
                        :class="activeTab === 'dicuci' ? 'bg-purple-600 hover:bg-purple-700 text-white' :
                            'bg-white font-semibold hover:bg-purple-500 hover:text-white text-black'">
                        Sedang Dicuci
                    </a>
                </div>
            </div>

            <div class="panel h-36 bg-cover bg-center bg-no-repeat flex flex-col justify-end p-4"
                style="background-image: url('{{ asset('assets/images/1742251719.jpg') }}');">
                <div class="flex justify-end">
                    <a href="#" @click.prevent="activeTab = 'siap'" class="btn border-none"
                        :class="activeTab === 'siap' ? 'bg-purple-600 hover:bg-purple-700 text-white' :
                            'bg-white font-semibold hover:bg-purple-500 hover:text-white text-black'">
                        Siap Diambil
                    </a>
                </div>
            </div>

            <div class="panel h-36 bg-cover bg-center bg-no-repeat flex flex-col justify-end p-4"
                style="background-image: url('{{ asset('assets/images/1741861594.jpg') }}');">
                <div class="flex justify-end">
                    <a href="#" @click.prevent="activeTab = 'selesai'" class="btn border-none"
                        :class="activeTab === 'selesai' ? 'bg-purple-600 hover:bg-purple-700 text-white' :
                            'bg-white font-semibold hover:bg-purple-500 hover:text-white text-black'">
                        Selesai
                    </a>
                </div>
            </div>
        </div>

        {{-- Konten untuk masing-masing tab --}}
        <div class="mt-6" x-show="activeTab === 'dicuci'" x-cloak>
            @include('kasir.detail.dicuci')
        </div>

        <div class="mt-6" x-show="activeTab === 'siap'" x-cloak>
            @include('kasir.detail.diambil', ['siap' => $siap])
        </div>

        <div class="mt-6" x-show="activeTab === 'selesai'" x-cloak>
            @include('kasir.detail.selesai')
        </div>

    </div>

</x-layout.default>
