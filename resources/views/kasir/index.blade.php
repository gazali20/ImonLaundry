<x-layout.default>
    <div class="flex justify-between items-center ps w-full px-3">
        <div>
            <h1 class=" text-xl ">Kasir transaksi</h1>
        </div>
        <div class="flex ">
            <a href="" class="btn mr-3 bg-purple-600 hover:bg-purple-700  text-white">Kasir</a>
            <a href="/kasir/detail"
                class="btn  bg-white font-semibold hover:bg-purple-500 hover:text-white text-black shadow-none">Pesanan</a>
        </div>
    </div>
    <div x-data="kasirApp()" x-init="init()" class=" pt-5">
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
                                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.30936 0.249958H11.6908C11.9072 0.24982 12.0957 0.2497 12.2737 0.278127C12.977 0.390433 13.5856 0.829086 13.9146 1.46078C13.9978 1.62067 14.0573 1.79955 14.1256 2.00488L14.2373 2.33978C14.2562 2.39647 14.2616 2.41252 14.2661 2.42516C14.4413 2.90927 14.8953 3.23653 15.4099 3.24958C15.4235 3.24992 15.44 3.24998 15.5001 3.24998H18.5001C18.9143 3.24998 19.2501 3.58576 19.2501 3.99998C19.2501 4.41419 18.9143 4.74998 18.5001 4.74998H1.5C1.08579 4.74998 0.75 4.41419 0.75 3.99998C0.75 3.58576 1.08579 3.24998 1.5 3.24998H4.50008C4.56013 3.24998 4.5767 3.24992 4.59023 3.24958C5.10488 3.23653 5.55891 2.90929 5.73402 2.42518C5.73863 2.41245 5.74392 2.39675 5.76291 2.33978L5.87452 2.0049C5.94281 1.79958 6.00233 1.62067 6.08559 1.46078C6.41453 0.829088 7.02313 0.390433 7.72643 0.278127C7.90445 0.2497 8.09297 0.24982 8.30936 0.249958ZM7.00815 3.24998C7.05966 3.14895 7.10531 3.04398 7.14458 2.93542C7.1565 2.90245 7.1682 2.86736 7.18322 2.82228L7.28302 2.52286C7.37419 2.24935 7.39519 2.19357 7.41601 2.15358C7.52566 1.94301 7.72853 1.7968 7.96296 1.75936C8.00748 1.75225 8.06703 1.74998 8.35535 1.74998H11.6448C11.9331 1.74998 11.9927 1.75225 12.0372 1.75936C12.2716 1.7968 12.4745 1.94301 12.5842 2.15358C12.605 2.19357 12.626 2.24934 12.7171 2.52286L12.8169 2.8221L12.8556 2.93544C12.8949 3.04399 12.9405 3.14896 12.992 3.24998H7.00815Z" fill="#1C274C"/>
                                                <path d="M3.91509 6.45009C3.88754 6.03679 3.53016 5.72409 3.11686 5.75164C2.70357 5.77919 2.39086 6.13657 2.41841 6.54987L2.88186 13.5016C2.96736 14.7843 3.03642 15.8205 3.19839 16.6336C3.36679 17.4789 3.65321 18.1849 4.2448 18.7384C4.8364 19.2919 5.55995 19.5307 6.4146 19.6425C7.23662 19.75 8.27504 19.75 9.5606 19.75H10.4395C11.7251 19.75 12.7635 19.75 13.5856 19.6425C14.4402 19.5307 15.1638 19.2919 15.7554 18.7384C16.347 18.1849 16.6334 17.4789 16.8018 16.6336C16.9638 15.8205 17.0328 14.7844 17.1183 13.5016L17.5818 6.54987C17.6093 6.13657 17.2966 5.77919 16.8833 5.75164C16.47 5.72409 16.1126 6.03679 16.0851 6.45009L15.6251 13.3492C15.5353 14.6971 15.4713 15.6349 15.3307 16.3405C15.1943 17.0249 15.004 17.3872 14.7306 17.643C14.4572 17.8988 14.083 18.0646 13.391 18.1552C12.6776 18.2485 11.7376 18.25 10.3868 18.25H9.6134C8.26256 18.25 7.32255 18.2485 6.60915 18.1552C5.91715 18.0646 5.54299 17.8988 5.26958 17.643C4.99617 17.3872 4.80583 17.0249 4.66948 16.3405C4.52892 15.6349 4.46489 14.6971 4.37503 13.3492L3.91509 6.45009Z" fill="#1C274C"/>
                                                <path d="M7.42546 8.2537C7.83762 8.21248 8.20515 8.51319 8.24637 8.92535L8.74637 13.9253C8.78759 14.3375 8.48688 14.705 8.07472 14.7463C7.66256 14.7875 7.29503 14.4868 7.25381 14.0746L6.75381 9.0746C6.7126 8.66245 7.01331 8.29492 7.42546 8.2537Z" fill="#1C274C"/>
                                                <path d="M12.5747 8.2537C12.9869 8.29492 13.2876 8.66245 13.2464 9.0746L12.7464 14.0746C12.7052 14.4868 12.3376 14.7875 11.9255 14.7463C11.5133 14.705 11.2126 14.3375 11.2538 13.9253L11.7538 8.92535C11.795 8.51319 12.1626 8.21248 12.5747 8.2537Z" fill="#1C274C"/>
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
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-h-82 overflow-y-auto">
                    <template x-for="service in filteredServices" :key="service.id">
                        <div class="p-3 border rounded-lg shadow-md bg-white">
                            <img :src="'/images/services/' + service.image" alt="Service Image"
                                class="w-full h-39 object-cover rounded-lg">
                            <!-- Bungkus nama layanan dan harga dalam div -->
                            <div class="flex justify-between items-center mt-2">
                                <div class="items-center gap-x-2">
                                    <h2 class="font-semibold text-sm" x-text="service.name_service"></h2>
                                    <p class="font-semibold text-gray-700" x-text="'Rp ' + service.price + '/kg'"></p>
                                </div>
                                <!-- Tombol keranjang di kanan -->
                                <button @click="tambahLayanan(service)" class="ml-1 mt-6">
                                    <svg width="20" height="19" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.71403 7.26935C6.71403 6.82328 7.08976 6.46167 7.55325 6.46167H10.9101C11.3736 6.46167 11.7494 6.82328 11.7494 7.26935C11.7494 7.71542 11.3736 8.07703 10.9101 8.07703H7.55325C7.08976 8.07703 6.71403 7.71542 6.71403 7.26935Z" fill="#1C274C"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.0432939 0.552489C0.189863 0.12931 0.665132 -0.099393 1.10484 0.0416667L1.44543 0.15093C2.14632 0.375752 2.73863 0.565745 3.20438 0.774271C3.69945 0.995924 4.12901 1.27064 4.45474 1.70557C4.78046 2.14051 4.91542 2.61958 4.97736 3.14169C4.98084 3.17105 4.98411 3.2008 4.98719 3.23094L17.0766 3.23094C18.1686 3.2309 19.0822 3.23086 19.7809 3.33042C20.5098 3.43427 21.2129 3.673 21.6562 4.32012C22.0996 4.96724 22.0507 5.68318 21.8627 6.36889C21.6826 7.02619 21.3227 7.83432 20.8924 8.80031L20.3701 9.97334C20.1725 10.4171 19.9987 10.8075 19.818 11.1166C19.6224 11.4512 19.3836 11.7551 19.0221 11.9845C18.6606 12.2139 18.2763 12.3054 17.8798 12.3466C17.5134 12.3847 17.0721 12.3847 16.5704 12.3847H5.48716C5.56974 12.5289 5.66479 12.6477 5.77299 12.7519C6.08267 13.0499 6.51747 13.2442 7.33854 13.3505C8.18375 13.4599 9.30397 13.4616 10.9101 13.4616H19.8619C20.3254 13.4616 20.7011 13.8232 20.7011 14.2692C20.7011 14.7153 20.3254 15.0769 19.8619 15.0769H10.8488C9.31848 15.077 8.08499 15.077 7.11489 14.9514C6.1077 14.8211 5.25967 14.5423 4.58614 13.8941C3.91262 13.2459 3.62293 12.4297 3.48751 11.4604C3.35708 10.5268 3.3571 9.33966 3.35713 7.8669L3.35713 4.98957C3.35713 4.22174 3.35586 3.71369 3.30974 3.32492C3.26607 2.95678 3.18981 2.77921 3.09311 2.65009C2.99641 2.52097 2.84549 2.39519 2.49641 2.2389C2.12777 2.07385 1.62737 1.91204 0.870493 1.66923L0.574066 1.57413C0.13436 1.43307 -0.103275 0.975668 0.0432939 0.552489ZM5.09905 10.7693H16.5294C17.0843 10.7693 17.434 10.7682 17.6996 10.7406C17.9449 10.7151 18.0392 10.6733 18.0981 10.6359C18.157 10.5985 18.2342 10.5316 18.3551 10.3246C18.4861 10.1006 18.6249 9.79158 18.8435 9.30074L19.3231 8.22383C19.7869 7.18225 20.0951 6.48462 20.2398 5.95687C20.3804 5.44401 20.3091 5.28836 20.255 5.20936C20.2009 5.13036 20.0803 5.00604 19.5351 4.92836C18.9741 4.84843 18.1864 4.8463 17.0089 4.8463H5.03557C5.03558 4.87887 5.03558 4.91168 5.03558 4.94472L5.03558 7.8078C5.03558 9.06991 5.03676 10.0202 5.09905 10.7693Z" fill="#1C274C"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.99377 20.9999C5.60329 20.9999 4.47609 19.9151 4.47609 18.5769C4.47609 17.2387 5.60329 16.1538 6.99377 16.1538C8.38424 16.1538 9.51144 17.2387 9.51144 18.5769C9.51144 19.9151 8.38424 20.9999 6.99377 20.9999ZM6.15454 18.5769C6.15454 19.0229 6.53028 19.3846 6.99377 19.3846C7.45726 19.3846 7.83299 19.0229 7.83299 18.5769C7.83299 18.1308 7.45726 17.7692 6.99377 17.7692C6.53028 17.7692 6.15454 18.1308 6.15454 18.5769Z" fill="#1C274C"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5468 18.577C14.5468 19.9152 15.674 21 17.0645 21C18.4549 21 19.5821 19.9152 19.5821 18.577C19.5821 17.2387 18.4549 16.1539 17.0645 16.1539C15.674 16.1539 14.5468 17.2387 14.5468 18.577ZM17.0645 19.3846C16.601 19.3846 16.2252 19.023 16.2252 18.577C16.2252 18.1309 16.601 17.7693 17.0645 17.7693C17.528 17.7693 17.9037 18.1309 17.9037 18.577C17.9037 19.023 17.528 19.3846 17.0645 19.3846Z" fill="#1C274C"/>
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
                            console.log('Response dari server:', data);

                            if (data.code_invoice) {
                                // Tampilkan notifikasi berhasil
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Transaksi Berhasil!',
                                    text: `Kode Invoice: ${data.code_invoice}`,
                                    showConfirmButton: false,
                                    timer: 2000, // tampil selama 2 detik
                                    didClose: () => {
                                        // Setelah notif tertutup, redirect
                                        window.location.href = `/kasir/detail`;
                                    }
                                });

                                // Reset data (boleh juga ditaruh setelah redirect)
                                this.cart = [];
                                this.customer = '';
                                this.noHandphone = '';
                                this.pembayaran = '';
                                this.hargaTunai = 0;

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Kode invoice tidak ditemukan.',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat menyimpan transaksi.',
                            });
                        });


                }
            };
        }
    </script>
</x-layout.default>
