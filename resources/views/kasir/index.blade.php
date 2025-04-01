<x-layout.default>
    <div class="flex justify-between items-center ps w-full">
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
        <div class="flex ">
            <a href="" class="btn mr-3 bg-purple-600 hover:bg-purple-700  text-white">Kasir</a>
            <a href="/kasir/detail"
                class="btn  bg-white font-semibold hover:bg-purple-500 hover:text-white text-black shadow-none">Pesanan</a>
        </div>
    </div>
    <div x-data="kasirApp()" x-init="init()">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
            <!-- KIRI - KERANJANG + FORM -->
            <div class="space-y-4">
                <!-- TABEL KERANJANG -->
                <div class="panel">
                    <h2 class="text-lg font-semibold mb-4">Keranjang Transaksi</h2>
                    <table class="w-full table-auto border border-gray-200">
                        <thead class="border bg-gray-300">
                            <tr>
                                <th class="px-4 py-2 text-left">Layanan</th>
                                <th class="px-4 py-2 text-left">Kategori</th>
                                <th class="px-4 py-2 text-left">Berat</th>
                                <th class="px-4 py-2 text-left">Harga/Kg</th>
                                <th class="px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(item, index) in cart" :key="index">
                                <tr class="border-t">
                                    <td class="px-4 py-2" x-text="item.name_service"></td>
                                    <td class="px-4 py-2" x-text="item.category?.name_category"></td>
                                    <!-- Input Berat -->
                                    <td class="px-4 py-2">
                                        <div
                                            class="flex items-center justify-center bg-gray-300 rounded-full overflow-hidden h-6 w-fit text-xs">
                                            <button class="w-6 h-6 text-white hover:bg-gray-400 focus:outline-none"
                                                @click="
                                              item.weight = Math.max(0.5, (parseFloat(item.weight) - 0.1).toFixed(1));
                                              updateWeight(index, parseFloat(item.weight));
                                            ">
                                                −
                                            </button>
                                            <div class="bg-gray-100 w-8 h-6 flex items-center justify-center text-gray-800"
                                                x-text="parseFloat(item.weight).toFixed(1).replace('.', ',')">
                                            </div>
                                            <button class="w-6 h-6 text-white hover:bg-gray-400 focus:outline-none"
                                                @click="
                                              item.weight = (parseFloat(item.weight) + 0.1).toFixed(1);
                                              updateWeight(index, parseFloat(item.weight));
                                            ">
                                                +
                                            </button>
                                        </div>
                                    </td>
                                    <!-- Harga per Kg -->
                                    <td class="px-4 py-2" x-text="formatRupiah(item.price)"></td>
                                    <!-- Aksi -->
                                    <td class="px-4 py-2">
                                        <button @click="hapusLayanan(index)"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            hps
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
                            <div>
                                <label for="weight">Total Berat/kg</label>
                                <input id="weight" type="text" class="form-input bg-gray-100"
                                    :value="totalWeight.toFixed(1) + ' Kg'" readonly />
                            </div>
                            <div>
                                <label for="no_handphone">No. HP</label>
                                <input id="no_handphone" type="text" class="form-input" placeholder="08xxxxxx"
                                    x-model="noHandphone" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label>Pembayaran</label>
                                <select class="form-input" x-model="pembayaran">
                                    <option value="">Pilih Metode</option>
                                    <option value="cash">Tunai</option>
                                    <option value="debit">Debit</option>
                                </select>
                            </div>
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
                <!-- Kategori -->
                <div class="flex space-x-2 mb-4 overflow-auto flex-nowrap">
                    <button @click="selectCategory('')"
                        :class="{ 'bg-purple-500 text-white': selectedCategory === '', 'bg-gray-200': selectedCategory !== '' }"
                        class="px-4 py-2 rounded whitespace-nowrap font-semibold">Semua</button>
                    <template x-for="category in categories" :key="category">
                        <button @click="selectCategory(category)"
                            :class="{
                                'bg-purple-500 text-white': selectedCategory ===
                                    category,
                                'bg-gray-200': selectedCategory !== category
                            }"
                            class="px-4 py-2 rounded whitespace-nowrap font-semibold" x-text="category">
                        </button>
                    </template>
                </div>
                <!-- Layanan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-h-78 overflow-y-auto">
                    <template x-for="service in filteredServices" :key="service.id">
                        <div class="p-4 border rounded-lg shadow-md bg-white">
                            <img :src="'/images/services/' + service.image" alt="Service Image"
                                class="w-40 h-38 object-cover rounded-lg">
                            <!-- Bungkus nama layanan dan harga dalam div -->
                            <div class="flex justify-between items-center mt-2">
                                <div class="items-center gap-x-2">
                                    <h2 class="font-semibold text-sm" x-text="service.name_service"></h2>
                                    <p class="font-semibold text-gray-700" x-text="'Rp ' + service.price + '/kg'"></p>
                                </div>
                                <!-- Tombol keranjang di kanan -->
                                <button @click="tambahLayanan(service)" class="p-2">
                                    tmbh
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
                customer: '',
                noHandphone: '', 
                cart: [],
                pembayaran: '',
                hargaTunai: 0,
                searchQuery: '',
                services: [],
                categories: [],
                selectedCategory: '',

                init() {
                    fetch('/api/services')
                        .then(response => response.json())
                        .then(data => {
                            this.services = data;
                            this.categories = [...new Set(data.map(service => service.category?.name_category))];
                        });
                },
                tambahLayanan(service) {
                    let item = this.cart.find(i => i.id === service.id);
                    if (item) {
                        item.weight += 1.0;
                    } else {
                        this.cart.push({
                            ...service,
                            weight: 1.0
                        });
                    }
                },
                hapusLayanan(index) {
                    this.cart.splice(index, 1);
                },
                updateWeight(index, weight) {
                    this.cart[index].weight = weight;
                },
                formatRupiah(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(value);
                },
                get totalWeight() {
                    return this.cart.reduce((total, item) => total + item.weight, 0);
                },
                get grandTotal() {
                    return this.cart.reduce((total, item) => total + (item.price * item.weight), 0);
                },
                get grandTotalFormatted() {
                    return this.formatRupiah(this.grandTotal);
                },
                get kembalian() {
                    return Math.max(0, this.hargaTunai - this.grandTotal);
                },
                get kembalianFormatted() {
                    return this.formatRupiah(this.kembalian);
                },
                get filteredServices() {
                    return this.services.filter(service => {
                        const matchesCategory = this.selectedCategory ?
                            service.category?.name_category === this.selectedCategory :
                            true;
                        const matchesSearch = service.name_service.toLowerCase().includes(this.searchQuery
                            .toLowerCase());
                        return matchesCategory && matchesSearch;
                    });
                },
                selectCategory(category) {
                    this.selectedCategory = category;
                },
                submitForm() {
                    const payload = {
                        customer: this.customer,
                        no_handphone: this.noHandphone,
                        payment: this.pembayaran,
                        grand_total: this.grandTotal,
                        cart: this.cart, 
                    };
                    fetch('/kasir', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                            },
                            body: JSON.stringify(payload),
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(`Transaksi berhasil! Kode Invoice: ${data.code_invoice}`);
                            // Reset data
                            this.cart = [];
                            this.customer = '';
                            this.noHandphone = ''; // Reset nomor HP
                            this.pembayaran = '';
                            this.hargaTunai = 0;

                            // Redirect ke halaman detail
                            window.location.href = `/kasir/detail`;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menyimpan transaksi.');
                        });
                }
            };
        }
    </script>
</x-layout.default>
