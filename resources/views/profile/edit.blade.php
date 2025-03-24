<x-layout.default>
    <div class="panel w-full h-full ">
        <div class="table-responsive">
            <div class="flex items-center justify-between mb-5">
                <h5 class="flex items-center font-semibold text-xl dark:text-white-light gap-x-2">
                    <a href="">
                        <svg class="mr-2" width="10" height="21" viewBox="0 0 12 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.9415 1.72298C11.387 2.07117 11.4386 2.68275 11.0567 3.08897L3.14939 11.5002L11.0567 19.9114C11.4386 20.3176 11.387 20.9292 10.9415 21.2774C10.4959 21.6256 9.82518 21.5785 9.44329 21.1723L0.94329 12.1306C0.602237 11.7678 0.602237 11.2325 0.94329 10.8697L9.44329 1.82806C9.82518 1.42184 10.4959 1.37479 10.9415 1.72298Z"
                                fill="#1C274C" stroke="#1C274C" stroke-linecap="round" />
                        </svg>
                    </a>
                    Lengkapi Profile
                </h5>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-5">
                <strong>Perhatian!</strong> Ada kesalahan dalam input data.
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid lg:grid-cols-2 grid-cols-1">
                <div class="flex justify-start">
                <img src="{{ asset('assets/images/user.png') }}" width="470" class="ml-20" alt="">
            </div>
                <div class="mr-20">
                <!-- Name -->
                <div class="mt-4">
                    <label class="block text-lg font-semibold text-gray-700 dark:text-white">Nama</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full mt-1 p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white" required>
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <label class="block text-lg font-semibold text-gray-700 dark:text-white">Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="w-full mt-1 p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white" required>
                </div>

                <!-- Nomor Handphone -->
                <div class="mt-4">
                    <label class="block text-lg font-semibold text-gray-700 dark:text-white">Nomor Handphone</label>
                    <input type="text" name="no_handphone"
                        value="{{ old('no_handphone', Auth::user()->no_handphone) }}"
                        class="w-full mt-1 p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white" required>
                </div>

                <!-- Alamat -->
                <div class="mt-4">
                    <label class="block text-lg font-semibold text-gray-700 dark:text-white">Alamat</label>
                    <textarea name="address" class="w-full mt-1 p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white"
                        required>{{ old('address', Auth::user()->address) }}</textarea>
                </div>

                <div class="flex justify-start items-center mt-4">

                    <button type="submit"
                        class="btn bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</x-layout.default>
