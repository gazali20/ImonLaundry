<x-layout.default>
    <div class="panel w-full h-full ">
        <div class="table-responsive">
            <div class="flex items-center justify-between mb-5">
                <h5 class="flex items-center font-semibold text-xl dark:text-white-light gap-x-2">
                    <a href="/profile">
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

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid lg:grid-cols-2 grid-cols-1 gap-10">
                <div class="flex items-center lg:justify-start">
                    <a href="#">
                        <img src="{{ $user->photo ? asset($user->photo) : asset('assets/images/user.png') }}"
                            class="object-cover rounded-full border-gray-300 w-96 h-96 ml-32" id="profile-img">
                    </a>

                    <!-- Tombol Edit Foto di Kiri Bawah -->
                    <label for="photo-upload"
                        class="absolute bottom-4 left-4 bg-white p-2 rounded-full border border-gray-300 shadow-md cursor-pointer hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-600" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M5 16.59V19h2.41l9.13-9.13-2.41-2.41L5 16.59zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0L15 3.46l3.75 3.75 1.96-1.97z" />
                        </svg>
                    </label>

                    <!-- Input File (Hidden) -->
                    <input type="file" id="photo-upload" name="photo" class="hidden" accept="image/*"
                        onchange="previewImage(event)">
                </div>

                <!-- Bagian Form -->
                <div class="mr-32">
                    <!-- Name -->
                    <div class="mt-4">
                        <label class="block text-lg font-semibold text-gray-700 dark:text-white">Nama</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                            class="w-full mt-1 p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <label class="block text-lg font-semibold text-gray-700 dark:text-white">Email</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                            class="w-full mt-1 p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white"
                            required>
                    </div>

                    <!-- Nomor Handphone -->
                    <div class="mt-4">
                        <label class="block text-lg font-semibold text-gray-700 dark:text-white">Nomor Handphone</label>
                        <input type="text" name="no_handphone"
                            value="{{ old('no_handphone', Auth::user()->no_handphone) }}"
                            class="w-full mt-1 p-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white"
                            required>
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
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profile-img');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</x-layout.default>
