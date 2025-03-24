<x-layout.default>
    <!-- Breadcrumb -->
    <ul class="flex space-x-2 rtl:space-x-reverse mb-4">
        <li><span>Layanan</span></li>
        <li>
            <a href="/kasir" class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1 text-primary hover:underline">
                Kasir
            </a>
        </li>
    </ul>

    <!-- AlpineJS App -->
    <div x-data="kasirApp()" x-init="init()">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
            <!-- KIRI - KERANJANG + FORM -->
            <div class="space-y-4">
                <!-- TABEL KERANJANG -->
                <div class="panel">
                    <h2 class="text-lg font-semibold mb-4">Keranjang Transaksi</h2>
                    <!-- filepath: d:\Blocdev\ImonLaundry\resources\views\kasir\index.blade.php -->
                    <table class="w-full table-auto border border-gray-200">
                        <thead class="border bg-gray-300">
                            <tr>
                                <th class="px-4 py-2 text-left">Layanan</th>
                                <th class="px-4 py-2 text-left">Kategori</th> <!-- Harga per Kg -->
                                <th class="px-4 py-2 text-left">Berat</th>
                                <th class="px-4 py-2 text-left">Harga/Kg</th>
                                {{-- <th class="px-4 py-2 text-left">Subtotal</th> <!-- Subtotal --> --}}
                                <th class="px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(item, index) in cart" :key="index">
                                <tr class="border-t">
                                    <td class="px-4 py-2" x-text="item.name"></td>
                                    <td class="px-4 py-2" x-text="item.category"></td>



                                    <!-- Input Berat -->
                                    <td class="px-4 py-2">
                                        <div
                                            class="flex items-center justify-center bg-gray-300 rounded-full overflow-hidden h-6 w-fit text-xs">
                                            <button class="w-6 h-6 text-white hover:bg-gray-400 focus:outline-none"
                                                @click="
                                              item.berat = Math.max(0.5, (parseFloat(item.berat) - 0.1).toFixed(1));
                                              updateBerat(index, parseFloat(item.berat));
                                            ">
                                                −
                                            </button>
                                            <div class="bg-gray-100 w-8 h-6 flex items-center justify-center text-gray-800"
                                                x-text="parseFloat(item.berat).toFixed(1).replace('.', ',')">
                                            </div>
                                            <button class="w-6 h-6 text-white hover:bg-gray-400 focus:outline-none"
                                                @click="
                                              item.berat = (parseFloat(item.berat) + 0.1).toFixed(1);
                                              updateBerat(index, parseFloat(item.berat));
                                            ">
                                                +
                                            </button>
                                        </div>
                                    </td>






                                    <!-- Harga per Kg -->
                                    <td class="px-4 py-2" x-text="formatRupiah(item.price)"></td>
                                    <!-- Subtotal -->
                                    {{-- <td class="px-4 py-2" x-text="'Rp ' + formatRupiah(item.subtotal)"></td> --}}

                                    <!-- Aksi -->
                                    <td class="px-4 py-2">
                                        <button @click="hapusLayanan(index)"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.5001 6H3.5" stroke="#1C274C" stroke-width="1.5"
                                                    stroke-linecap="round" />
                                                <path
                                                    d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                                    stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                                                <path opacity="0.5" d="M9.5 11L10 16" stroke="#1C274C"
                                                    stroke-width="1.5" stroke-linecap="round" />
                                                <path opacity="0.5" d="M14.5 11L14 16" stroke="#1C274C"
                                                    stroke-width="1.5" stroke-linecap="round" />
                                                <path opacity="0.5"
                                                    d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                                    stroke="#1C274C" stroke-width="1.5" />
                                            </svg>

                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- FORM -->
                <div class="panel">
                    <form @submit.prevent="submitForm">
                        <div class="mb-4">
                            <label for="customer">Pelanggan</label>
                            <input id="customer" type="text" placeholder="Masukkan nama pelanggan"
                                class="form-input" x-model="customer" />
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            {{-- <div>
                                <label for="berat">Berat/Kg</label>
                                <input type="text" class="form-input" x-model.number="berat" placeholder="1.5kg" />
                            </div> --}}
                            <div>
                                <label for="no_handphone">No. HP</label>
                                <input type="text" class="form-input" placeholder="08xxxxxx" />
                            </div>
                            <div>
                                <label>Pembayaran</label>
                                <select class="form-input" x-model="pembayaran">
                                    <option value="">Pilih Metode</option>
                                    <option value="cash">Tunai</option>
                                    <option value="debit">Debit</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">

                            <div x-show="pembayaran === 'cash'">
                                <label>Uang Tunai</label>
                                <input type="number" class="form-input" x-model.number="hargaTunai" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block font-medium mb-1">Harga Total</label>
                                <input type="text" class="form-input bg-gray-100" :value="grandTotalFormatted"
                                    readonly />
                            </div>
                            <div x-show="pembayaran === 'cash'">
                                <label class="block font-medium mb-1">Kembalian</label>
                                <input type="text" class="form-input bg-gray-100" :value="kembalianFormatted"
                                    readonly />
                            </div>
                        </div>

                        <div class="flex justify-center items-center">
                            <button type="submit"
                                class="btn w-[200px] bg-purple-600 hover:bg-purple-700 text-white">Bayar
                                Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>



            <!-- KANAN - LIST LAYANAN -->
            <div class="panel">


                <div class="mb-4 w-full">
                    <div class="flex items-center bg-white border border-gray-300 rounded-xl px-4 py-1 shadow-sm">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 1.75C5.44365 1.75 1.75 5.44365 1.75 10C1.75 14.5563 5.44365 18.25 10 18.25C14.5563 18.25 18.25 14.5563 18.25 10C18.25 5.44365 14.5563 1.75 10 1.75ZM0.25 10C0.25 4.61522 4.61522 0.25 10 0.25C15.3848 0.25 19.75 4.61522 19.75 10C19.75 15.3848 15.3848 19.75 10 19.75C4.61522 19.75 0.25 15.3848 0.25 10ZM10 7.25C10.4142 7.25 10.75 7.58579 10.75 8V9.25H12C12.4142 9.25 12.75 9.58579 12.75 10C12.75 10.4142 12.4142 10.75 12 10.75H10.75V12C10.75 12.4142 10.4142 12.75 10 12.75C9.58579 12.75 9.25 12.4142 9.25 12V10.75H8C7.58579 10.75 7.25 10.4142 7.25 10C7.25 9.58579 7.58579 9.25 8 9.25H9.25V8C9.25 7.58579 9.58579 7.25 10 7.25ZM19.1579 18.7511C18.9264 18.7335 18.7335 18.9264 18.7511 19.1579C18.7514 19.1592 18.7553 19.1848 18.7746 19.2573C18.7974 19.3424 18.8312 19.4554 18.8828 19.6277C18.9301 19.7857 18.9609 19.8881 18.9862 19.9641C19.0121 20.0419 19.021 20.0568 19.0171 20.0496C19.1225 20.2465 19.3745 20.31 19.5607 20.1867C19.5538 20.1912 19.5688 20.1824 19.6284 20.1261C19.6868 20.0712 19.7624 19.9957 19.8791 19.8791C19.9957 19.7624 20.0712 19.6868 20.1261 19.6284C20.1727 19.579 20.1868 19.5602 20.1877 19.5592C20.3093 19.3736 20.2463 19.1236 20.0511 19.018C20.0499 19.0175 20.0287 19.0077 19.9641 18.9862C19.8881 18.9609 19.7857 18.9301 19.6277 18.8828C19.4554 18.8312 19.3424 18.7974 19.2573 18.7746C19.1848 18.7553 19.1591 18.7514 19.1579 18.7511ZM17.2564 19.2833C17.1612 18.1267 18.1267 17.1612 19.2833 17.2564C19.4833 17.2728 19.7251 17.3457 19.9862 17.4242C20.0101 17.4314 20.0341 17.4387 20.0583 17.4459C20.0801 17.4524 20.1018 17.4589 20.1234 17.4654C20.3632 17.5369 20.5881 17.604 20.7576 17.6948C21.7335 18.2173 22.0485 19.4659 21.4373 20.3889C21.3312 20.5492 21.165 20.715 20.9878 20.8917C20.9719 20.9076 20.9558 20.9236 20.9397 20.9397C20.9236 20.9558 20.9076 20.9719 20.8917 20.9878C20.7149 21.165 20.5492 21.3312 20.3889 21.4373C19.4659 22.0485 18.2173 21.7335 17.6948 20.7576C17.604 20.5881 17.5369 20.3632 17.4654 20.1234C17.4589 20.1018 17.4524 20.0801 17.4459 20.0583C17.4387 20.0341 17.4314 20.0101 17.4242 19.9862C17.3457 19.7252 17.2728 19.4833 17.2564 19.2833Z"
                                fill="#9F9F9F" />
                        </svg>

                        <input type="text" placeholder="Search..."
                            class="form-input w-full border-none focus:ring-0 focus:outline-none placeholder-gray-400"
                            x-model="searchQuery" />
                    </div>
                </div>

                <h1 class="text-lg font-semibold mb-4">Jenis Layanan</h1>
                <div class="overflow-x-auto">
                    <div class="flex gap-2 mb-4 w-max">
                        <template x-for="kategori in kategoriList" :key="kategori">
                            <button @click="activeCategory = kategori"
                                :class="activeCategory === kategori ?
                                    'px-4 py-2 rounded-lg font-semibold transition bg-purple-600 text-white shadow-md border border-white' :
                                    'px-4 py-2 rounded-lg font-semibold transition bg-gray-200 text-gray-700 hover:bg-purple-500 hover:text-white'">
                                <span x-text="kategori"></span>
                            </button>
                        </template>
                    </div>
                </div>


                <!-- Bagian Template -->
                <div class="grid grid-cols-3 gap-2 max-h-[600px] overflow-y-scroll pr-1 max-w-[800px] mx-auto">
                    <template x-for="layanan in filteredServices()" :key="layanan.id">
                        <div x-show="layanan.category === activeCategory"
                            class="p-2 bg-white rounded-xl shadow flex flex-col items-center text-center text-sm max-h-[230px] min-h-[200px] w-[150px] mx-auto">

                            <!-- Gambar -->
                            <img :src="layanan.image" alt="Gambar Layanan"
                                class="h-[130px] w-[130px] object-cover rounded-md mb-2 shadow-sm" />

                            <!-- Info + Tombol -->
                            <div class="w-full flex justify-between items-center">
                                <!-- Teks -->
                                <div class="text-left">
                                    <h3 class="font-semibold text-sm" x-text="layanan.name"></h3>
                                    <p class="text-xs text-gray-600 mb-1">
                                        <span x-text="'Rp ' + layanan.price"></span> /kg
                                    </p>
                                </div>

                                <!-- Tombol -->
                                <button @click="tambahLayanan(layanan)"
                                    class="text-purple-500 hover:text-purple-700 transition mt-1">
                                    <svg width="20" height="17" viewBox="0 0 40 37" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.4021 12.8079C12.4021 12.022 13.0682 11.3848 13.8899 11.3848H19.8407C20.6624 11.3848 21.3284 12.022 21.3284 12.8079C21.3284 13.5938 20.6624 14.231 19.8407 14.231H13.8899C13.0682 14.231 12.4021 13.5938 12.4021 12.8079Z"
                                            fill="#1C274C" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.576748 0.973433C0.836575 0.227832 1.6791 -0.175121 2.45858 0.0734127L3.06236 0.265924C4.30484 0.66204 5.35484 0.996789 6.18049 1.36419C7.05811 1.75472 7.81961 2.23874 8.39704 3.00506C8.97446 3.77137 9.2137 4.61545 9.32349 5.53535C9.32967 5.58708 9.33547 5.6395 9.34093 5.69261L30.7721 5.69261C32.708 5.69254 34.3275 5.69247 35.5662 5.86787C36.8583 6.05086 38.1046 6.47148 38.8906 7.61164C39.6766 8.75181 39.5898 10.0132 39.2566 11.2214C38.9373 12.3795 38.2992 13.8033 37.5366 15.5053L36.6106 17.5721C36.2603 18.354 35.9522 19.0419 35.6319 19.5864C35.2852 20.1759 34.8619 20.7113 34.221 21.1155C33.5801 21.5197 32.899 21.681 32.196 21.7536C31.5465 21.8207 30.7642 21.8206 29.8748 21.8206H10.2272C10.3736 22.0747 10.5421 22.2841 10.7339 22.4676C11.2829 22.9927 12.0537 23.3351 13.5092 23.5223C15.0076 23.715 16.9934 23.718 19.8407 23.718H35.7097C36.5313 23.718 37.1974 24.3551 37.1974 25.1411C37.1974 25.927 36.5313 26.5641 35.7097 26.5641H19.7319C17.0191 26.5641 14.8325 26.5642 13.1128 26.343C11.3273 26.1134 9.82395 25.6222 8.62998 24.4801C7.436 23.338 6.92246 21.9 6.68241 20.1921C6.45119 18.5471 6.45123 16.4556 6.45127 13.8607L6.45127 8.79115C6.45127 7.43831 6.44902 6.54317 6.36727 5.85819C6.28985 5.20957 6.15466 4.89671 5.98324 4.66921C5.81181 4.44171 5.54427 4.2201 4.92546 3.94473C4.27196 3.65393 3.38488 3.36883 2.04315 2.94102L1.51766 2.77347C0.738184 2.52494 0.316922 1.71903 0.576748 0.973433ZM9.53922 18.9745H29.8021C30.7857 18.9745 31.4058 18.9726 31.8766 18.9239C32.3114 18.879 32.4787 18.8053 32.583 18.7394C32.6875 18.6736 32.8242 18.5556 33.0386 18.191C33.2708 17.7962 33.5169 17.2518 33.9044 16.387L34.7545 14.4896C35.5767 12.6544 36.1232 11.4253 36.3796 10.4954C36.6288 9.59183 36.5025 9.31759 36.4066 9.1784C36.3106 9.03921 36.0969 8.82016 35.1304 8.6833C34.1359 8.54247 32.7395 8.53872 30.6522 8.53872H9.4267C9.42671 8.5961 9.42671 8.6539 9.4267 8.71212L9.4267 13.7566C9.4267 15.9803 9.42881 17.6547 9.53922 18.9745Z"
                                            fill="#1C274C" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.898 36.9999C10.4331 36.9999 8.43489 35.0885 8.43489 32.7307C8.43489 30.3729 10.4331 28.4615 12.898 28.4615C15.363 28.4615 17.3612 30.3729 17.3612 32.7307C17.3612 35.0885 15.363 36.9999 12.898 36.9999ZM11.4103 32.7307C11.4103 33.5166 12.0764 34.1537 12.898 34.1537C13.7197 34.1537 14.3858 33.5166 14.3858 32.7307C14.3858 31.9448 13.7197 31.3076 12.898 31.3076C12.0764 31.3076 11.4103 31.9448 11.4103 32.7307Z"
                                            fill="#1C274C" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M26.2875 32.7308C26.2875 35.0886 28.2857 37 30.7506 37C33.2156 37 35.2138 35.0886 35.2138 32.7308C35.2138 30.373 33.2156 28.4617 30.7506 28.4617C28.2857 28.4617 26.2875 30.373 26.2875 32.7308ZM30.7506 34.1539C29.929 34.1539 29.2629 33.5168 29.2629 32.7308C29.2629 31.9449 29.929 31.3078 30.7506 31.3078C31.5723 31.3078 32.2384 31.9449 32.2384 32.7308C32.2384 33.5168 31.5723 34.1539 30.7506 34.1539Z"
                                            fill="#1C274C" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </template>
                </div>



            </div>
        </div>
    </div>

    <script>
        function kasirApp() {
            return {
                activeCategory: 'Cuci Baju',
                kategoriList: ['Cuci Baju', 'Cuci Boneka', 'Cuci Karpet', 'Cuci Gorden', 'Cuci Helm', 'Cuci Sepatu',
                    'Cuci Tas'
                ],
                services: [],
                cart: [],
                pembayaran: '',
                customer: '',
                hargaTunai: 0,
                grandTotal: 0,
                searchQuery: '',

                init() {
                    this.services = [{
                            id: 1,
                            name: 'Cuci Kering',
                            price: 3000,
                            category: 'Cuci Baju',
                            image: '/images/services/1741864165.jpg'
                        },
                        {
                            id: 2,
                            name: 'Cuci Setrika',
                            price: 5000,
                            category: 'Cuci Baju',
                            image: '/images/services/1741864165.jpg'
                        },
                        {
                            id: 3,
                            name: 'Boneka Kecil',
                            price: 8000,
                            category: 'Cuci Boneka',
                            image: '/images/services/1741864165.jpg'
                        },
                        {
                            id: 4,
                            name: 'Karpet Tipis',
                            price: 10000,
                            category: 'Cuci Karpet',
                            image: '/images/services/1741864165.jpg'
                        },
                        {
                            id: 5,
                            name: 'Karpet Komplit',
                            price: 10000,
                            category: 'Cuci Baju',
                            image: '/images/services/1741864165.jpg'
                        },
                        {
                            id: 6,
                            name: 'Cuci Komplit',
                            price: 10000,
                            category: 'Cuci Baju',
                            image: '/images/services/1741864165.jpg'
                        },
                        {
                            id: 7,
                            name: 'Cuci Komplit',
                            price: 10000,
                            category: 'Cuci Gorden',
                            image: '/images/services/1741864165.jpg'
                        },
                        {
                            id: 8,
                            name: 'Cuci Komplit',
                            price: 10000,
                            category: 'Cuci Gorden',
                            image: '/images/services/1741864165.jpg'
                        },
                        {
                            id: 9,
                            name: 'Cuci Komplit',
                            price: 10000,
                            category: 'Cuci Helm',
                            image: '/images/services/1741864165.jpg'
                        },
                        {
                            id: 10,
                            name: 'Cuci Komplit',
                            price: 10000,
                            category: 'Cuci Helm',
                            image: '/images/services/1741864165.jpg'
                        },
                    ];
                },

                filteredServices() {
                    return this.services.filter(service => {
                        const matchCategory = service.category === this.activeCategory;
                        const matchSearch = service.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchCategory && matchSearch;
                    });
                },

                tambahLayanan(layanan) {
                    // Cek apakah layanan sudah ada di keranjang
                    const found = this.cart.find(item => item.id === layanan.id);
                    if (found) {
                        found.berat += 1.0; // tambah berat default
                        found.subtotal = found.price * found.berat;
                    } else {
                        this.cart.push({
                            ...layanan,
                            berat: 1.0,
                            subtotal: layanan.price * 1.0
                        });
                    }
                    this.hitungTotal();
                },

                updateBerat(index, beratBaru) {
                    const item = this.cart[index];
                    item.weight = parseFloat(beratBaru); // Perbarui berat
                    item.subtotal = item.price * item.weight; // Hitung subtotal
                    this.hitungTotal(); // Hitung total harga
                },

                hapusLayanan(index) {
                    this.cart.splice(index, 1);
                    this.hitungTotal();
                },

                hitungTotal() {
                    this.grandTotal = this.cart.reduce((sum, item) => sum + item.subtotal, 0); // Total semua subtotal
                },
                formatRupiah(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(value);
                },

                get grandTotalFormatted() {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(this.grandTotal);
                },

                get kembalian() {
                    if (this.pembayaran === 'cash') {
                        return this.hargaTunai - this.grandTotal;
                    }
                    return 0;
                },

                get kembalianFormatted() {
                    return this.pembayaran === 'cash' ?
                        new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(this.kembalian) : '-';
                },

                submitForm() {
                    if (this.customer === '' || this.cart.length === 0 || this.pembayaran === '') {
                        alert('Lengkapi semua data sebelum menyimpan transaksi yaa 💌');
                        return;
                    }

                    if (this.pembayaran === 'cash' && this.hargaTunai < this.grandTotal) {
                        alert('Uang tunai kurang dari total belanja 😢');
                        return;
                    }

                    // Kalau sudah lengkap
                    alert(`Transaksi berhasil disimpan!\nPelanggan: ${this.customer}\nTotal: ${this.grandTotalFormatted}`);
                    // TODO: Kirim data ke backend Laravel pake Axios atau fetch
                }
            }
        }
    </script>

</x-layout.default>
