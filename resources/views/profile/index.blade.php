<x-layout.default>
    <div class="panel w-full p-6">
        <div class="table-responsive">
            <div class="flex items-center justify-between mb-5">
                <h5 class="flex items-center font-semibold text-lg dark:text-white-light gap-x-2">
                    <a href="/">
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

        @php
            $user = Auth::user();
            $isProfileIncomplete =
                empty($user->name) || empty($user->email) || empty($user->no_handphone) || empty($user->address);
        @endphp

        @if ($isProfileIncomplete)
            <div class="bg-red-500 text-white p-2 rounded mb-5 text-sm">
                <strong>Perhatian!</strong> Profil Anda belum lengkap. Silakan lengkapi data Anda.
            </div>
        @endif

        <div class="grid lg:grid-cols-2 grid-cols-1 items-center mt-5 gap-6">
            <div class="flex justify-center">
                @if ($user->photo)
                    <img src="{{ asset($user->photo) }}" alt="User Photo" class=" w-48 h-48 object-cover rounded-full border">
                @else
                    <img src="{{ asset('assets/images/user.png') }}" alt="Default User Photo" class="w-40 h-40 object-cover rounded-full border">
                @endif
            </div>

            <div>
                <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $user->name ?? 'Data Tidak Lengkap!!' }}</p>
                <p class="text-lg text-gray-500 dark:text-gray-300 mt-1">Status: <span class="capitalize">{{ $user->role }}</span></p>
                <p class="text-sm text-gray-500 dark:text-gray-300 mt-2">Alamat: {{ $user->address ?? 'Data Tidak Lengkap!!' }}</p>

                <div class="flex mt-4 gap-2">
                    <a href="/profile/edit" class="btn bg-purple-600 hover:bg-purple-700 text-white text-sm px-4 py-2">
                        {{ $isProfileIncomplete ? 'Lengkapi Profil' : 'Edit Profile' }}
                    </a>
                    <a href="" class="btn bg-purple-600 hover:bg-purple-700 text-white text-sm px-4 py-2">Ubah Password</a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full  mb-5 pt-10 text-sm">
            <div>
                <label class="block font-medium text-gray-700 dark:text-white mb-1">Nama</label>
                <div class="p-2 bg-gray-100 border rounded-md dark:bg-gray-700 dark:text-white">
                    @empty(Auth::user()->name)
                        Data belum lengkap!
                    @else
                        {{ Auth::user()->name }}
                    @endempty
                </div>
            </div>
            <div>
                <label class="block font-medium text-gray-700 dark:text-white mb-1">Email</label>
                <div class="p-2 bg-gray-100 border rounded-md dark:bg-gray-700 dark:text-white">
                    @empty(Auth::user()->email)
                        Data belum lengkap!
                    @else
                        {{ Auth::user()->email }}
                    @endempty
                </div>
            </div>
            <div>
                <label class="block font-medium text-gray-700 dark:text-white mb-1">Nomor Handphone</label>
                <div class="p-2 bg-gray-100 border rounded-md dark:bg-gray-700 dark:text-white">
                    @empty(Auth::user()->no_handphone)
                        Data belum lengkap!
                    @else
                        {{ Auth::user()->no_handphone }}
                    @endempty
                </div>
            </div>
            <div>
                <label class="block font-medium text-gray-700 dark:text-white mb-1">Alamat</label>
                <div class="p-2 bg-gray-100 border rounded-md dark:bg-gray-700 dark:text-white">
                    @empty(Auth::user()->address)
                        Data belum lengkap!
                    @else
                        {{ Auth::user()->address }}
                    @endempty
                </div>
            </div>
        </div>
    </div>
</x-layout.default>