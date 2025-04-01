<x-layout.default>

        <div class="flex justify-between items-center w-full">
            <div>
                <ul class="flex space-x-2 rtl:space-x-reverse mb-4">
                    <li><span>Layanan</span></li>
                    <li>
                        <a href="/kasir"
                            class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1 text-primary hover:underline">
                            Kasir
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex">
                <a href="/kasir"
                    class="btn mr-3 bg-white font-semibold hover:bg-purple-500 hover:text-white text-black shadow-none">Kasir</a>
                <a href="#" class="btn bg-purple-600 hover:bg-purple-700 text-white">Tambah</a>
            </div>
        </div>

        <div x-data="{ activeTab: 'dicuci' }" class="pt-5">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="panel h-36 bg-cover bg-center bg-no-repeat flex flex-col justify-end p-4"
                    style="background-image: url('{{ asset('assets/images/1742552634.png') }}');">
                    <div class="flex justify-end">
                        <a href="#" @click="activeTab = 'dicuci'" class="btn border-none"
                            :class="activeTab === 'dicuci' ? 'bg-purple-600 hover:bg-purple-700 text-white' :
                                'bg-white font-semibold hover:bg-purple-500 hover:text-white text-black'">
                            Sedang Dicuci
                        </a>
                    </div>
                </div>

                <div class="panel h-36 bg-cover bg-center bg-no-repeat flex flex-col justify-end p-4"
                    style="background-image: url('{{ asset('assets/images/1742251719.jpg') }}');">
                    <div class="flex justify-end">
                        <a href="#" @click="activeTab = 'siap'" class="btn border-none"
                            :class="activeTab === 'siap' ? 'bg-purple-600 hover:bg-purple-700 text-white' :
                                'bg-white font-semibold hover:bg-purple-500 hover:text-white text-black'">
                            Siap Diambil
                        </a>
                    </div>
                </div>

                <div class="panel h-36 bg-cover bg-center bg-no-repeat flex flex-col justify-end p-4"
                    style="background-image: url('{{ asset('assets/images/1741861594.jpg') }}');">
                    <div class="flex justify-end">
                        <a href="#" @click="activeTab = 'selesai'" class="btn border-none"
                            :class="activeTab === 'selesai' ? 'bg-purple-600 hover:bg-purple-700 text-white' :
                                'bg-white font-semibold hover:bg-purple-500 hover:text-white text-black'">
                            Selesai
                        </a>
                    </div>
                </div>
            </div>
    </x-layout.default>
