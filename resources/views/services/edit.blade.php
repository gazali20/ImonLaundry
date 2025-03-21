<x-layout.default>


    <ul class="flex space-x-2 rtl:space-x-reverse mb-5">
        <li>
            <a href="/services" class="text-primary hover:underline">Layanan</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit layanan</span>
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
                <span>Edit Layanan</span>
            </h2>

            <form @submit.prevent="submitForm()">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
   
                    <div class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <div :class="[isSubmitForm ? (form.name_service ? 'has-success' : 'has-error') : '']">
                            <label for="name_service">Nama Layanan</label>
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
    
                  
                    <div class="relative w-64 h-64 border bg-gray-100 border-gray-300 rounded-xl overflow-hidden group">

                        <!-- Label untuk klik file input -->
                        <label for="image" class="absolute inset-0 cursor-pointer z-10">
                            <template x-if="!imagePreview && form.image">
                                <img :src="'/images/services/' + form.image" class="w-full h-full object-cover" />
                            </template>
                    
                            <template x-if="imagePreview">
                                <img :src="imagePreview" class="w-full h-full object-cover" />
                            </template>
                    
                            <!-- Jika belum ada gambar -->
                            <template x-if="!imagePreview && !form.image">
                                <div class="flex items-center justify-center w-full h-full text-gray-400">Pilih Gambar</div>
                            </template>
                        </label>
                    
                        <!-- Input file disembunyikan -->
                        <input type="file" id="image" @change="previewImage($event)" class="hidden" />
                    </div>
                </div>
    
             
                <div class="mt-6">
                    <button type="submit" class="btn bg-purple-600 hover:bg-purple-700 text-white">Simpan perubahan</button>
                </div>
            </form>
        </div>
    </div>
    
    

   
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("formService", () => ({
                form: {
                    name_service: '{{ $service->name_service}}',
                    price: '{{ $service->price }}',
                    id_category: '{{ $service->id_category }}',
                    code: '{{ $service->code}}',
                    image: '{{ $service->image }}',
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
                    formData.append('_method', 'PUT');
                    formData.append('name_service', this.form.name_service);
                    formData.append('price', this.form.price);
                    formData.append('id_category', this.form.id_category);
                    formData.append('code', this.form.code);
                    if (this.image) {
                        formData.append('image', this.image);
                    }

                    fetch("{{ route('services.update', $service->id) }}", {
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
