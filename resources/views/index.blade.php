<x-layout.default>
    <script defer src="/assets/js/apexcharts.js"></script>
    <div x-data="sales">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Sales</span>
            </li>
        </ul>



        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-6 pt-5">
            {{-- i --}}
            <div class="panel h-36 bg-gradient-to-t from-blue-200 via-blue-400 to-blue-400">
                <div class="grid sm:grid-cols-1 xl:grid-cols-2">
                    <div class=" sm:grid-cols-3 xl:grid-cols-1  text-white pt-1 justify-center items-center">
                        <div>
                            <h1 class="text-xl font-semibold">Total Pendapatan</h1>
                            <h1 class="text-2xl font-extrabold py-1 font">Rp6.000.000</h1>
                            <h1>Pertahun 25%</h1>
                        </div>
                    </div>
                    <div class=" flex justify-center items-center ">
                        <a href="">
                            <svg class="pt-3" width="112" height="92" viewBox="0 0 102 82" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M83.6668 40.9998C83.6668 43.5772 81.5775 45.6665 79.0002 45.6665C76.4228 45.6665 74.3335 43.5772 74.3335 40.9998C74.3335 38.4225 76.4228 36.3332 79.0002 36.3332C81.5775 36.3332 83.6668 38.4225 83.6668 40.9998Z"
                                    fill="#213A7E" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M41.4036 0.166505H55.9301C64.5063 0.166431 71.2993 0.166372 76.6156 0.881135C82.0869 1.61673 86.5153 3.16661 90.0077 6.65897C94.3215 10.9728 95.6962 16.7501 96.1953 24.2469C98.8892 25.4323 100.923 27.9392 101.147 31.1149C101.167 31.3958 101.167 31.6986 101.167 31.9792C101.167 32.0048 101.167 32.0302 101.167 32.0554V49.9443C101.167 49.9695 101.167 49.9949 101.167 50.0205C101.167 50.3011 101.167 50.6039 101.147 50.8848C100.923 54.0604 98.8892 56.5674 96.1953 57.7528C95.6962 65.2496 94.3215 71.0269 90.0077 75.3407C86.5153 78.8331 82.0869 80.3829 76.6156 81.1185C71.2993 81.8333 64.5063 81.8332 55.9301 81.8332H41.4036C32.8274 81.8332 26.0344 81.8333 20.7181 81.1185C15.2468 80.3829 10.8183 78.8331 7.32597 75.3407C3.8336 71.8483 2.28372 67.4199 1.54813 61.9486C0.833365 56.6323 0.833424 49.8393 0.833498 41.2631V40.7366C0.833424 32.1604 0.833365 25.3674 1.54813 20.0511C2.28372 14.5798 3.8336 10.1513 7.32596 6.65898C10.8183 3.16661 15.2468 1.61673 20.7181 0.881135C26.0344 0.166372 32.8273 0.166431 41.4036 0.166505ZM89.1171 58.4998H80.0771C70.0661 58.4998 61.5002 50.9046 61.5002 40.9998C61.5002 31.0951 70.0661 23.4998 80.0771 23.4998H89.1171C88.5859 17.2397 87.3844 13.9352 85.0579 11.6087C83.083 9.63374 80.378 8.44995 75.6829 7.81871C70.8871 7.17394 64.5653 7.16651 55.6668 7.16651H41.6668C32.7683 7.16651 26.4466 7.17394 21.6508 7.81871C16.9557 8.44995 14.2507 9.63374 12.2757 11.6087C10.3007 13.5837 9.11694 16.2887 8.48571 20.9838C7.84093 25.7796 7.8335 32.1013 7.8335 40.9998C7.8335 49.8983 7.84093 56.2201 8.48571 61.0159C9.11694 65.711 10.3007 68.416 12.2757 70.391C14.2507 72.3659 16.9557 73.5497 21.6508 74.181C26.4466 74.8257 32.7683 74.8332 41.6668 74.8332H55.6668C64.5653 74.8332 70.8871 74.8257 75.6829 74.181C80.3779 73.5497 83.083 72.3659 85.0579 70.391C87.3844 68.0645 88.5859 64.76 89.1171 58.4998ZM19.5002 22.3332C19.5002 20.4002 21.0672 18.8332 23.0002 18.8332H41.6668C43.5998 18.8332 45.1668 20.4002 45.1668 22.3332C45.1668 24.2662 43.5998 25.8332 41.6668 25.8332H23.0002C21.0672 25.8332 19.5002 24.2662 19.5002 22.3332ZM92.6433 30.5009C92.5484 30.4999 92.4242 30.4998 92.2224 30.4998H80.0771C73.4345 30.4998 68.5002 35.4406 68.5002 40.9998C68.5002 46.5591 73.4345 51.4998 80.0771 51.4998H92.2224C92.4242 51.4998 92.5484 51.4998 92.6433 51.4988C92.7014 51.4982 92.7323 51.4973 92.7467 51.4968L92.7573 51.4963C93.7192 51.4378 94.133 50.7885 94.1643 50.398C94.1643 50.398 94.1652 50.3686 94.1657 50.3265C94.1668 50.2437 94.1668 50.1333 94.1668 49.9443V32.0554C94.1668 31.8664 94.1668 31.756 94.1657 31.6732C94.1652 31.631 94.1643 31.6016 94.1643 31.6016C94.1329 31.2111 93.7191 30.5619 92.7573 30.5034C92.7573 30.5034 92.7342 30.5019 92.6433 30.5009Z"
                                    fill="#213A7E" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
            {{-- o --}}
            <div class="panel h-36 bg-gradient-to-t from-purple-200 via-purple-400 to-purple-400">
                <div class="grid sm:grid-cols-1 xl:grid-cols-2">
                    <div class=" sm:grid-cols-3 xl:grid-cols-1  text-white pt-1 justify-center items-center">
                        <div>
                            <h1 class="text-xl font-semibold">Total Pengeluaran</h1>
                            <h1 class="text-2xl font-extrabold py-1">Rp6.000.000</h1>
                            <h1>Pertahun 25%</h1>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <a href=""><svg class="pt-2" width="100" height="100" viewBox="0 0 96 95"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M48.0002 6.646C25.437 6.646 7.146 24.937 7.146 47.5002C7.146 70.0633 25.437 88.3543 48.0002 88.3543C70.5633 88.3543 88.8543 70.0633 88.8543 47.5002C88.8543 24.937 70.5633 6.646 48.0002 6.646ZM0.520996 47.5002C0.520996 21.2781 21.7781 0.0209961 48.0002 0.0209961C74.2222 0.0209961 95.4793 21.2781 95.4793 47.5002C95.4793 73.7222 74.2222 94.9793 48.0002 94.9793C21.7781 94.9793 0.520996 73.7222 0.520996 47.5002ZM48.0002 17.6877C49.8296 17.6877 51.3127 19.1707 51.3127 21.0002V22.3991C58.5137 23.6884 64.5627 29.0986 64.5627 36.4585C64.5627 38.2879 63.0796 39.771 61.2502 39.771C59.4207 39.771 57.9377 38.2879 57.9377 36.4585C57.9377 33.462 55.4462 30.2901 51.3127 29.1599V44.4824C58.5137 45.7718 64.5627 51.1819 64.5627 58.5418C64.5627 65.9017 58.5137 71.3119 51.3127 72.6013V74.0002C51.3127 75.8296 49.8296 77.3127 48.0002 77.3127C46.1707 77.3127 44.6877 75.8296 44.6877 74.0002V72.6013C37.4866 71.3119 31.4377 65.9017 31.4377 58.5418C31.4377 56.7124 32.9207 55.2293 34.7502 55.2293C36.5796 55.2293 38.0627 56.7124 38.0627 58.5418C38.0627 61.5384 40.5541 64.7102 44.6877 65.8405V50.5179C37.4866 49.2285 31.4377 43.8184 31.4377 36.4585C31.4377 29.0986 37.4866 23.6884 44.6877 22.3991V21.0002C44.6877 19.1707 46.1707 17.6877 48.0002 17.6877ZM44.6877 29.1599C40.5541 30.2901 38.0627 33.462 38.0627 36.4585C38.0627 39.455 40.5541 42.6268 44.6877 43.7571V29.1599ZM51.3127 51.2432V65.8405C55.4462 64.7102 57.9377 61.5384 57.9377 58.5418C57.9377 55.5453 55.4462 52.3735 51.3127 51.2432Z"
                                    fill="#52266E" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            {{-- p --}}
            <div class="panel h-36 bg-gradient-to-t from-green-200 via-green-400 to-green-400">
                <div class="grid sm:grid-cols-1 xl:grid-cols-2">
                    <div class=" sm:grid-cols-3 xl:grid-cols-1  text-white pt-1 justify-center items-center">
                        <div>
                            <h1 class="text-xl font-semibold">Total Pencucian</h1>
                            <h1 class="text-2xl font-extrabold py-1">2.000 Pesanan</h1>
                            <h1>Pertahun 25%</h1>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <a href=""><svg class="pt-3" width="111" height="94" viewBox="0 0 105 82"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M32.7325 0.718753H57.6425C64.3095 0.718652 69.6833 0.718571 73.9098 1.2868C78.2978 1.87676 81.9925 3.13887 84.9268 6.07321C87.6296 8.776 88.9137 12.1238 89.5605 16.0644C93.5016 16.711 96.8499 17.9953 99.5531 20.6985C102.487 23.6328 103.75 27.3274 104.339 31.7155C104.908 35.9419 104.908 41.3158 104.908 47.9828V48.5177C104.908 55.1848 104.908 60.5586 104.339 64.785C103.75 69.1731 102.487 72.8677 99.5531 75.8021C96.6187 78.7364 92.9241 79.9985 88.536 80.5885C84.3096 81.1567 78.9357 81.1566 72.2687 81.1565H47.3588C40.6918 81.1566 35.3179 81.1567 31.0915 80.5885C26.7034 79.9985 23.0088 78.7364 20.0744 75.8021C17.3716 73.0992 16.0873 69.7513 15.4406 65.8107C11.4995 65.1639 8.15127 63.8799 5.44821 61.1768C2.51387 58.2425 1.25176 54.5478 0.661804 50.1598C0.093571 45.9333 0.0936521 40.5595 0.0937527 33.8925V33.3575C0.0936521 26.6905 0.093571 21.3167 0.661804 17.0902C1.25176 12.7022 2.51387 9.00755 5.44821 6.07321C8.38255 3.13887 12.0772 1.87676 16.4652 1.2868C20.6917 0.718571 26.0655 0.718652 32.7325 0.718753ZM23.0341 66.4417C23.5454 68.4056 24.2737 69.6599 25.2452 70.6313C26.5944 71.9806 28.4887 72.8602 32.0658 73.3412C35.7482 73.8362 40.6286 73.844 47.6262 73.844H72.0012C78.9989 73.844 83.8793 73.8362 87.5617 73.3412C91.1388 72.8602 93.0331 71.9806 94.3823 70.6313C95.7316 69.2821 96.6112 67.3878 97.0922 63.8107C97.5872 60.1283 97.595 55.2479 97.595 48.2503C97.595 41.2526 97.5872 36.3722 97.0922 32.6898C96.6112 29.1127 95.7316 27.2184 94.3823 25.8692C93.4107 24.8976 92.1561 24.1692 90.1917 23.6578C90.2814 26.5287 90.2813 29.7542 90.2813 33.3575V33.8925C90.2814 40.5595 90.2815 45.9333 89.7132 50.1598C89.1233 54.5478 87.8612 58.2425 84.9268 61.1768C81.9925 64.1111 78.2978 65.3733 73.9098 65.9632C69.6833 66.5314 64.3095 66.5314 57.6425 66.5313H32.7325C29.1297 66.5313 25.9046 66.5314 23.0341 66.4417ZM17.4396 8.5341C13.8624 9.01503 11.9681 9.89471 10.6189 11.2439C9.26971 12.5931 8.39003 14.4874 7.9091 18.0646C7.41402 21.7469 7.40626 26.6274 7.40626 33.625C7.40626 40.6227 7.41402 45.5031 7.9091 49.1854C8.39003 52.7626 9.26971 54.6569 10.6189 56.0061C11.9681 57.3553 13.8624 58.235 17.4396 58.7159C21.1219 59.211 26.0024 59.2188 33 59.2188H57.375C64.3727 59.2188 69.2531 59.211 72.9354 58.7159C76.5126 58.235 78.4069 57.3553 79.7561 56.0061C81.1053 54.6569 81.985 52.7626 82.4659 49.1854C82.961 45.5031 82.9688 40.6227 82.9688 33.625C82.9688 26.6274 82.961 21.7469 82.4659 18.0646C81.985 14.4874 81.1053 12.5931 79.7561 11.2439C78.4069 9.89471 76.5126 9.01503 72.9354 8.5341C69.2531 8.03902 64.3727 8.03126 57.375 8.03126H33C26.0024 8.03126 21.1219 8.03902 17.4396 8.5341ZM45.1875 25.0938C40.4758 25.0938 36.6563 28.9133 36.6563 33.625C36.6563 38.3367 40.4758 42.1563 45.1875 42.1563C49.8992 42.1563 53.7188 38.3367 53.7188 33.625C53.7188 28.9133 49.8992 25.0938 45.1875 25.0938ZM29.3438 33.625C29.3438 24.8747 36.4372 17.7813 45.1875 17.7813C53.9378 17.7813 61.0313 24.8747 61.0313 33.625C61.0313 42.3753 53.9378 49.4688 45.1875 49.4688C36.4372 49.4688 29.3438 42.3753 29.3438 33.625ZM18.375 20.2188C20.3943 20.2188 22.0313 21.8557 22.0313 23.875V43.375C22.0313 45.3943 20.3943 47.0313 18.375 47.0313C16.3557 47.0313 14.7188 45.3943 14.7188 43.375L14.7188 23.875C14.7188 21.8557 16.3557 20.2188 18.375 20.2188ZM72 20.2188C74.0193 20.2188 75.6563 21.8557 75.6563 23.875V43.375C75.6563 45.3943 74.0193 47.0313 72 47.0313C69.9807 47.0313 68.3438 45.3943 68.3438 43.375V23.875C68.3438 21.8557 69.9807 20.2188 72 20.2188Z"
                                    fill="#184C38" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="grid xl:grid-cols-3 gap-6 mb-6">
                <div class="panel h-full xl:col-span-2">
                    <div class="flex items-center dark:text-white-light mb-5">
                        <h5 class="font-semibold text-lg">Pendapatan</h5>
                        <div x-data="dropdown" @click.outside="open = false"
                            class="dropdown ltr:ml-auto rtl:mr-auto">
                            <a href="javascript:;" @click="toggle">
                                <svg class="w-5 h-5 text-black/70 dark:text-white/70 hover:!text-primary"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0">
                                <li><a href="javascript:;" @click="toggle">Perminggu</a></li>
                                <li><a href="javascript:;" @click="toggle">Perbulan</a></li>
                                <li><a href="javascript:;" @click="toggle">Pertahun</a></li>
                            </ul>
                        </div>
                    </div>
                    <p class="text-lg dark:text-white-light/90">Total Keuntungan <span
                            class="text-primary ml-2">Rp.16.000.000</span></p>
                    <div class="relative overflow-hidden">
                        <div x-ref="revenueChart" class="bg-white dark:bg-black rounded-lg">
                            <!-- loader -->
                            <div
                                class="min-h-[325px] grid place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] ">
                                <span
                                    class="animate-spin border-2 border-black dark:border-white !border-l-transparent  rounded-full w-5 h-5 inline-flex"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel h-full">
                    <div class="flex flex-col items-start mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Penjualan Berdasarkan</h5>
                        <h5 class="font-semibold text-lg  dark:text-white-light">Kategori</h5>
                    </div>
                    <div class="overflow-hidden">
                        <div x-ref="salesByCategory" class="bg-white dark:bg-black rounded-lg">
                            <!-- loader -->
                            <div
                                class="min-h-[353px] grid place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] ">
                                <span
                                    class="animate-spin border-2 border-black dark:border-white !border-l-transparent  rounded-full w-5 h-5 inline-flex"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
                <div class="panel h-full w-full">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Top 5 Pesanan Jasa</h5>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="ltr:rounded-l-md rtl:rounded-r-md text-white bg-purple-500">No</th>
                                    <th class="text-white bg-purple-500">Jasa</th>
                                    <th class="text-white bg-purple-500">Kategori</th>
                                    <th class="text-white bg-purple-500">Pesanan</th>
                                    <th class="ltr:rounded-r-md rtl:rounded-l-md text-white bg-purple-500">Keuntungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-black ">
                                    <td class=" text-black dark:text-white">1</td>
                                    <td>Cuci Kering</td>
                                    <td>Cuci Baju</td>
                                    <td>60</td>
                                    <td>Rp1.000.000</td>
                                </tr>
                                <tr class="text-black ">
                                    <td class=" text-black dark:text-white">2</td>
                                    <td>Cuci Kering</td>
                                    <td>Cuci Baju</td>
                                    <td>60</td>
                                    <td>Rp1.000.000</td>
                                </tr>
                                <tr class="text-black ">
                                    <td class=" text-black dark:text-white">3</td>
                                    <td>Cuci Kering</td>
                                    <td>Cuci Baju</td>
                                    <td>60</td>
                                    <td>Rp1.000.000</td>
                                </tr>
                                <tr class="text-black ">
                                    <td class=" text-black dark:text-white">4</td>
                                    <td>Cuci Kering</td>
                                    <td>Cuci Baju</td>
                                    <td>60</td>
                                    <td>Rp1.000.000</td>
                                </tr>
                                <tr class="text-black ">
                                    <td class=" text-black dark:text-white">5</td>
                                    <td>Cuci Kering</td>
                                    <td>Cuci Baju</td>
                                    <td>60</td>
                                    <td>Rp1.000.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel h-full w-full">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Top 5 Pelanggan Teratas Tahun ini</h5>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr class="border-b-0 text-white">
                                    <th class="ltr:rounded-l rtl:rounded-r bg-purple-500">No</th>
                                    <th class="bg-purple-500">Pelanggan</th>
                                    <th class="bg-purple-500">Terakhir Order</th>
                                    <th class="bg-purple-500">Total Harga</th>
                                    <th class="ltr:rounded-r-md rtl:rounded-l-md bg-purple-500 ">Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-black ">
                                    <td class=" text-black dark:text-white">1</td>
                                    <td>Wahyu</td>
                                    <td>20-01-2025</td>
                                    <td>Rp1.000.000</td>
                                    <td>30x</td>
                                </tr>
                                <tr class="text-black ">
                                    <td class=" text-black dark:text-white">2</td>
                                    <td>Ramosudin</td>
                                    <td>30-01-2025</td>
                                    <td>Rp950.000</td>
                                    <td>28x</td>
                                </tr>
                                <tr class="text-black ">
                                    <td class=" text-black dark:text-white">3</td>
                                    <td>Randawir</td>
                                    <td>20-02-2025</td>
                                    <td>Rp900.000</td>
                                    <td>21x</td>
                                </tr>
                                <tr class="text-black ">
                                    <td class=" text-black dark:text-white">4</td>
                                    <td>EWijaya</td>
                                    <td>21-02-2025</td>
                                    <td>Rp800.000</td>
                                    <td>18x</td>
                                </tr>
                                <tr class="text-black ">
                                    <td class=" text-black dark:text-white">5</td>
                                    <td>Gayus</td>
                                    <td>30-02-2025</td>
                                    <td>Rp700.000</td>
                                    <td>14x</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("sales", () => ({
                init() {
                    isDark = this.$store.app.theme === "dark" || this.$store.app.isDarkMode ? true :
                        false;
                    isRtl = this.$store.app.rtlClass === "rtl" ? true : false;

                    const revenueChart = null;
                    const salesByCategory = null;
                    const dailySales = null;
                    const totalOrders = null;

                    // revenue
                    setTimeout(() => {
                        this.revenueChart = new ApexCharts(this.$refs.revenueChart, this
                            .revenueChartOptions)
                        this.$refs.revenueChart.innerHTML = "";
                        this.revenueChart.render()

                        // sales by category
                        this.salesByCategory = new ApexCharts(this.$refs.salesByCategory, this
                            .salesByCategoryOptions)
                        this.$refs.salesByCategory.innerHTML = "";
                        this.salesByCategory.render()

                        // daily sales
                        this.dailySales = new ApexCharts(this.$refs.dailySales, this
                            .dailySalesOptions)
                        this.$refs.dailySales.innerHTML = "";
                        this.dailySales.render()

                        // total orders
                        this.totalOrders = new ApexCharts(this.$refs.totalOrders, this
                            .totalOrdersOptions)
                        this.$refs.totalOrders.innerHTML = "";
                        this.totalOrders.render()
                    }, 300);

                    this.$watch('$store.app.theme', () => {
                        isDark = this.$store.app.theme === "dark" || this.$store.app
                            .isDarkMode ? true : false;

                        this.revenueChart.updateOptions(this.revenueChartOptions);
                        this.salesByCategory.updateOptions(this.salesByCategoryOptions);
                        this.dailySales.updateOptions(this.dailySalesOptions);
                        this.totalOrders.updateOptions(this.totalOrdersOptions);
                    });

                    this.$watch('$store.app.rtlClass', () => {
                        isRtl = this.$store.app.rtlClass === "rtl" ? true : false;
                        this.revenueChart.updateOptions(this.revenueChartOptions);
                    });

                },

                // revenue
                get revenueChartOptions() {
                    return {
                        series: [{
                                name: 'Pendapatan',
                                data: [16800, 16800, 15500, 17800, 15500, 17000, 19000, 16000,
                                    15000, 17000, 14000, 17000
                                ]
                            },
                            {
                                name: 'Pengeluaran',
                                data: [16500, 17500, 16200, 17300, 16000, 19500, 16000, 17000,
                                    16000, 19000, 18000, 19000
                                ]
                            }
                        ],
                        chart: {
                            height: 325,
                            type: "area",
                            fontFamily: 'Nunito, sans-serif',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            curve: 'smooth',
                            width: 2,
                            lineCap: 'square'
                        },
                        dropShadow: {
                            enabled: true,
                            opacity: 0.2,
                            blur: 10,
                            left: -7,
                            top: 22
                        },
                        colors: isDark ? ['#2196f3', '#e7515a'] : ['#1b55e2', '#e7515a'],
                        markers: {
                            discrete: [{
                                    seriesIndex: 0,
                                    dataPointIndex: 6,
                                    fillColor: '#1b55e2',
                                    strokeColor: 'transparent',
                                    size: 7
                                },
                                {
                                    seriesIndex: 1,
                                    dataPointIndex: 5,
                                    fillColor: '#e7515a',
                                    strokeColor: 'transparent',
                                    size: 7
                                },
                            ],
                        },
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep',
                            'Okt', 'Nov', 'Des'
                        ],
                        xaxis: {
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            crosshairs: {
                                show: true
                            },
                            labels: {
                                offsetX: isRtl ? 2 : 0,
                                offsetY: 5,
                                style: {
                                    fontSize: '12px',
                                    cssClass: 'apexcharts-xaxis-title'
                                }
                            },
                        },
                        yaxis: {
                            tickAmount: 7,
                            labels: {
                                formatter: (value) => {
                                    return value / 1000 + 'K';
                                },
                                offsetX: isRtl ? -30 : -10,
                                offsetY: 0,
                                style: {
                                    fontSize: '12px',
                                    cssClass: 'apexcharts-yaxis-title'
                                },
                            },
                            opposite: isRtl ? true : false,
                        },
                        grid: {
                            borderColor: isDark ? '#191e3a' : '#e0e6ed',
                            strokeDashArray: 5,
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            },
                            yaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: 0,
                                right: 0,
                                bottom: 0,
                                left: 0
                            }
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            fontSize: '16px',
                            markers: {
                                width: 10,
                                height: 10,
                                offsetX: -2,
                            },
                            itemMargin: {
                                horizontal: 10,
                                vertical: 5
                            },
                        },
                        tooltip: {
                            marker: {
                                show: true
                            },
                            x: {
                                show: false
                            }
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: isDark ? 0.19 : 0.28,
                                opacityTo: 0.05,
                                stops: isDark ? [100, 100] : [45, 100],
                            },
                        },
                    }
                },

                // sales by category
                get salesByCategoryOptions() {
                    return {
                        series: [985, 737, 270],
                        chart: {
                            type: 'donut',
                            height: 460,
                            fontFamily: 'Nunito, sans-serif',
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 25,
                            colors: isDark ? '#0e1726' : '#fff'
                        },
                        colors: isDark ? ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'] : ['#e2a03f',
                            '#5c1ac3', '#e7515a'
                        ],
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center',
                            fontSize: '14px',
                            markers: {
                                width: 10,
                                height: 10,
                                offsetX: -2,
                            },
                            height: 50,
                            offsetY: 20,
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '65%',
                                    background: 'transparent',
                                    labels: {
                                        show: true,
                                        name: {
                                            show: true,
                                            fontSize: '29px',
                                            offsetY: -10
                                        },
                                        value: {
                                            show: true,
                                            fontSize: '26px',
                                            color: isDark ? '#bfc9d4' : undefined,
                                            offsetY: 16,
                                            formatter: (val) => {
                                                return val;
                                            },
                                        },
                                        total: {
                                            show: true,
                                            label: 'Total',
                                            color: '#888ea8',
                                            fontSize: '29px',
                                            formatter: (w) => {
                                                return w.globals.seriesTotals.reduce(function(a,
                                                    b) {
                                                    return a + b;
                                                }, 0);
                                            },
                                        },
                                    },
                                },
                            },
                        },
                        labels: ['Cuci Baju', 'Cuci Karpet', 'Cuci Gorden'],
                        states: {
                            hover: {
                                filter: {
                                    type: 'none',
                                    value: 0.15,
                                }
                            },
                            active: {
                                filter: {
                                    type: 'none',
                                    value: 0.15,
                                }
                            },
                        }
                    }
                },

                // daily sales
                get dailySalesOptions() {
                    return {
                        series: [{
                                name: 'Sales',
                                data: [44, 55, 41, 67, 22, 43, 21]
                            },
                            {
                                name: 'Last Week',
                                data: [13, 23, 20, 8, 13, 27, 33]
                            },
                        ],
                        chart: {
                            height: 160,
                            type: 'bar',
                            fontFamily: 'Nunito, sans-serif',
                            toolbar: {
                                show: false
                            },
                            stacked: true,
                            stackType: '100%'
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 1
                        },
                        colors: ['#e2a03f', '#e0e6ed'],
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                legend: {
                                    position: 'bottom',
                                    offsetX: -10,
                                    offsetY: 0
                                }
                            }
                        }],
                        xaxis: {
                            labels: {
                                show: false
                            },
                            categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat']
                        },
                        yaxis: {
                            show: false
                        },
                        fill: {
                            opacity: 1
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '25%'
                            }
                        },
                        legend: {
                            show: false
                        },
                        grid: {
                            show: false,
                            xaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: 10,
                                right: -20,
                                bottom: -20,
                                left: -20
                            },
                        },
                    }
                },

                // total orders
                get totalOrdersOptions() {
                    return {
                        series: [{
                            name: 'Sales',
                            data: [28, 40, 36, 52, 38, 60, 38, 52, 36, 40]
                        }],
                        chart: {
                            height: 290,
                            type: "area",
                            fontFamily: 'Nunito, sans-serif',
                            sparkline: {
                                enabled: true
                            }
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        colors: isDark ? ['#00ab55'] : ['#00ab55'],
                        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                        yaxis: {
                            min: 0,
                            show: false
                        },
                        grid: {
                            padding: {
                                top: 125,
                                right: 0,
                                bottom: 0,
                                left: 0
                            }
                        },
                        fill: {
                            opacity: 1,
                            type: 'gradient',
                            gradient: {
                                type: 'vertical',
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: 0.3,
                                opacityTo: 0.05,
                                stops: [100, 100],
                            },
                        },
                        tooltip: {
                            x: {
                                show: false
                            },
                        },
                    }
                }
            }));
        });
    </script>
</x-layout.default>
