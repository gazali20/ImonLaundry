<x-layout.default>
    <div class="panel w-full h-96">
        <div class="table-responsive">
            <div class="flex items-center justify-between mb-5">
                <h5 class="flex items-center font-semibold text-lg dark:text-white-light gap-x-2">
                    <a href="">
                        <svg class="mr-2" width="10" height="21" viewBox="0 0 12 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.9415 1.72298C11.387 2.07117 11.4386 2.68275 11.0567 3.08897L3.14939 11.5002L11.0567 19.9114C11.4386 20.3176 11.387 20.9292 10.9415 21.2774C10.4959 21.6256 9.82518 21.5785 9.44329 21.1723L0.94329 12.1306C0.602237 11.7678 0.602237 11.2325 0.94329 10.8697L9.44329 1.82806C9.82518 1.42184 10.4959 1.37479 10.9415 1.72298Z"
                                fill="#1C274C" stroke="#1C274C" stroke-linecap="round" />
                        </svg>
                    </a>
                    Profile
                </h5>
            </div>
        </div>
        <div class="grid lg:grid-cols-2 grid-cols-1 ">
            <div class="flex justify-center ">
                <img src="{{ asset('assets/images/user.png') }}" class="w-60" alt="">
            </div>
            <div class="justify-start relative right-28">
                <p class=" text-4xl  justify-center font-bold pt-4">Muhammad Ghazali Risfanto </p>
                <h1 class=" text-3xl ml-2 font-bold grid relative pt-8 bottom-7 text-gray-600 ">Status: Cashier</p>
                <h1 class=" text-xl ml-2 justify-bottom grid relative pt-7 bottom-12 text-gray-600">Alamat: Lorem ipdipisicing elit. Odio est maxime quae na quiliquid, ea.</h1>
                <div class="flex relative bottom-5 ">
                     <a href="/services/create" class="btn bg-purple-600 hover:bg-purple-700 text-white mr-4">Edit Profile</a>
                     <a href="" class="btn  bg-purple-600 hover:bg-purple-700 text-white">Ubah Password</a>
                </div>
            </div>
        </div>
    </div>
</x-layout.default>
