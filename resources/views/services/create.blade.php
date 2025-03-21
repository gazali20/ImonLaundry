<x-layout.default>


    <ul class="flex space-x-2 rtl:space-x-reverse mb-5">
        <li>
            <a href="/services" class="text-primary hover:underline">Layanan</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Tambah layanan</span>
        </li>
    </ul>

 
    <div class="pt-5" x-data="formService">
        <div class="panel">
            <h2 class="text-lg font-semibold mb-4 flex items-center space-x-2">
                <a href="/services" class="inline-flex items-center">
                    <svg width="10" height="15" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M10.9415 1.7225C11.387 2.07069 11.4386 2.68226 11.0567 3.08848L3.14939 11.4997L11.0567 19.9109C11.4386 20.3171 11.387 20.9287 10.9415 21.2769C10.4959 21.6251 9.82518 21.578 9.44329 21.1718L0.94329 12.1301C0.602237 11.7674 0.602237 11.232 0.94329 10.8692L9.44329 1.82757C9.82518 1.42135 10.4959 1.37431 10.9415 1.7225Z"
                            fill="#1C274C" stroke="#1C274C" stroke-linecap="round" />
                    </svg>
                </a>
                <span>Tambah Layanan</span>
            </h2>
            <form @submit.prevent="submitForm()">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                    <!-- Kiri: Form Input -->
                    <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <div :class="[isSubmitForm ? (form.name_service ? 'has-success' : 'has-error') : '']">
                            <label for="name_service">Jenis Layanan</label>
                            <input id="name_service" type="text" placeholder="Masukkan nama layanan" class="form-input" x-model="form.name_service" />
                            <template x-if="isSubmitForm && form.name_service">
                                <p class="text-success mt-1">Nama layanan sudah diisi</p>
                            </template>
                            <template x-if="isSubmitForm && !form.name_service">
                                <p class="text-danger mt-1">Harap isi nama layanan!</p>
                            </template>
                        </div>
    
                        <div :class="[isSubmitForm ? (form.id_category ? 'has-success' : 'has-error') : '']">
                            <label for="id_category">Kategori</label>
                            <select id="id_category" name="id_category" class="form-input" x-model="form.id_category">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div :class="[isSubmitForm ? (form.price ? 'has-success' : 'has-error') : '']">
                            <label for="price">Harga/Kg</label>
                            <input id="price" type="number" step="0.01" placeholder="Masukkan harga per Kg" class="form-input" x-model="form.price" />
                            <template x-if="isSubmitForm && form.price">
                                <p class="text-success mt-1">Harga sudah diisi</p>
                            </template>
                            <template x-if="isSubmitForm && !form.price">
                                <p class="text-danger mt-1">Harap isi harga!</p>
                            </template>
                        </div>
    
                        <div :class="[isSubmitForm ? (form.code ? 'has-success' : 'has-error') : '']">
                            <label for="code">Kode Layanan</label>
                            <input id="code" type="text" placeholder="Masukkan Kode Layanan" class="form-input" x-model="form.code" />
                            <template x-if="isSubmitForm && form.code">
                                <p class="text-success mt-1">Kode layanan sudah diisi</p>
                            </template>
                            <template x-if="isSubmitForm && !form.code">
                                <p class="text-danger mt-1">Kode belum diisi!</p>
                            </template>
                        </div>
                    </div>
    
                    <!-- Kanan: Gambar -->
                    <div class="relative w-64 h-64 border bg-gray-100 border-gray-300 rounded-xl overflow-hidden">
                        <!-- Jika belum ada gambar -->
                        <template x-if="!imagePreview">
                            <label
                                class="w-full h-full flex flex-col items-center justify-center text-gray-500 cursor-pointer">
                                <svg width="178" height="178" viewBox="0 0 178 178" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M121.804 45.8786C116.142 45.8786 111.553 50.4682 111.553 56.1297C111.553 61.7913 116.142 66.3809 121.804 66.3809C127.465 66.3809 132.055 61.7913 132.055 56.1297C132.055 50.4682 127.465 45.8786 121.804 45.8786ZM99.2513 56.1297C99.2513 43.6743 109.348 33.5772 121.804 33.5772C134.259 33.5772 144.356 43.6743 144.356 56.1297C144.356 68.5852 134.259 78.6823 121.804 78.6823C109.348 78.6823 99.2513 68.5852 99.2513 56.1297Z" fill="#1C274C" fill-opacity="0.51"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M88.5295 0.773439H89.4706C108.402 0.773334 123.237 0.77325 134.813 2.32954C146.661 3.92248 156.01 7.24665 163.349 14.5849C170.687 21.9232 174.011 31.2725 175.604 43.1206C177.16 54.6961 177.16 69.5319 177.16 88.4629V89.4039C177.16 108.335 177.16 123.171 175.604 134.746C174.011 146.594 170.687 155.944 163.349 163.282C156.01 170.62 146.661 173.944 134.813 175.537C123.237 177.094 108.402 177.094 89.4706 177.093H88.5296C69.5986 177.094 54.7628 177.094 43.1873 175.537C31.3391 173.944 21.9898 170.62 14.6516 163.282C7.3133 155.944 3.98913 146.594 2.39619 134.746C0.8399 123.171 0.839984 108.335 0.84009 89.404V88.4629C0.839984 69.5319 0.8399 54.6961 2.39619 43.1206C3.98913 31.2725 7.3133 21.9232 14.6516 14.5849C21.9898 7.24665 31.3391 3.92248 43.1873 2.32954C54.7628 0.77325 69.5986 0.773334 88.5295 0.773439ZM23.35 154.584C18.6783 149.912 15.9974 143.591 14.5879 133.107C13.3292 123.745 13.1658 111.802 13.1446 95.8233L25.4057 85.095C30.442 80.6882 38.0325 80.941 42.7645 85.673L77.9443 120.853C85.6937 128.602 97.8924 129.659 106.859 123.357L109.304 121.639C116.342 116.692 125.864 117.266 132.258 123.02L158.694 146.812C158.982 147.071 159.287 147.298 159.606 147.493C158.28 150.289 156.647 152.587 154.65 154.584C149.978 159.255 143.658 161.936 133.174 163.346C122.513 164.779 108.504 164.792 89.0001 164.792C69.4964 164.792 55.4874 164.779 44.8264 163.346C34.3423 161.936 28.0217 159.255 23.35 154.584ZM44.8264 14.5212C34.3423 15.9308 28.0217 18.6116 23.35 23.2833C18.6783 27.955 15.9974 34.2757 14.5879 44.7598C13.3977 53.6126 13.1868 64.7741 13.1495 79.4734L17.3052 75.8372C27.2154 67.1658 42.1515 67.6632 51.4629 76.9746L86.6427 112.154C90.1651 115.677 95.71 116.157 99.7856 113.293L102.231 111.574C113.961 103.331 129.831 104.286 140.487 113.876L163.236 134.351C163.297 133.943 163.356 133.528 163.412 133.107C164.846 122.446 164.859 108.437 164.859 88.9334C164.859 69.4298 164.846 55.4208 163.412 44.7598C162.003 34.2757 159.322 27.955 154.65 23.2833C149.978 18.6116 143.658 15.9308 133.174 14.5212C122.513 13.0879 108.504 13.0748 89.0001 13.0748C69.4964 13.0748 55.4874 13.0879 44.8264 14.5212Z" fill="#1C274C" fill-opacity="0.51"/>
                                    </svg>
                                    
                                <p class="text-sm text-gray-500">Pilih foto untuk ditampilkan!</p>
                                <input type="file" x-ref="fileInput" @change="previewImage($event)" class="hidden" />
                            </label>
                        </template>

                        <!-- Jika sudah ada gambar -->
                        <template x-if="imagePreview">
                            <label class="cursor-pointer block w-full h-full">
                                <img :src="imagePreview" class="w-full h-full object-cover" />
                                <input type="file" x-ref="fileInput" @change="previewImage($event)" class="hidden" />
                            </label>
                        </template>

                        <!-- Tombol ganti -->
                        <template x-if="imagePreview">
                            <button type="button" @click="resetImage"
                                class="absolute top-2 right-2 bg-white bg-opacity-75 text-gray-700 text-xs px-2 py-1 rounded hover:bg-opacity-100 shadow">
                                Ganti
                            </button>
                        </template>
                    </div>
                </div>
    
                <div class="mt-6">
                    <button type="submit" class="btn bg-purple-600 hover:bg-purple-700 text-white w-40">Tambah Layanan</button>
                </div>
            </form>
        </div>
    </div>
    
    
    

   
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("formService", () => ({
                form: {
                    name_service: '',
                    price: '',
                    id_category: '',
                    code: '',
                },
                image: null,
                imagePreview: null,
                isSubmitForm: false,

                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.image = file;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                submitForm() {
                    this.isSubmitForm = true;

                  
                    if (this.form.name_service && this.form.price && this.form.id_category && this.form
                        .code) {
                        this.sendData();
                    }
                },

                sendData() {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');
                    const formData = new FormData();

                    formData.append('_token', csrfToken);
                    formData.append('name_service', this.form.name_service);
                    formData.append('price', this.form.price);
                    formData.append('id_category', this.form.id_category);
                    formData.append('code', this.form.code);
                    if (this.image) {
                        formData.append('image', this.image);
                    }

                    fetch("{{ route('services.store') }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: formData
                    }).then(res => {
                        if (res.ok) {
                            this.showMessage("Layanan berhasil ditambahkan!");
                            window.location.href = "{{ route('services.index') }}";
                        } else {
                            this.showMessage("Gagal menambahkan layanan.", "error");
                        }
                    }).catch(error => {
                        this.showMessage("Terjadi kesalahan: " + error.message, "error");
                    });
                },

                showMessage(msg, type = 'success') {
                    const toast = window.Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    toast.fire({
                        icon: type,
                        title: msg,
                        padding: '10px 20px',
                    });
                },
            }))
        });
    </script>
</x-layout.default>
