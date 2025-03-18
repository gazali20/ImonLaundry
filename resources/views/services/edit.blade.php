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
    
                  
                    <div>
                        <label for="image">Foto Layanan</label>
                        <input type="file" @change="previewImage($event)" class="form-input"  />
                        <template x-if="!imagePreview && form.image">
                            <img :src="'/images/services/' + form.image" class="w-32 h-32 mt-4 object-cover rounded-xl shadow" />
                        </template>
                        
                        <!-- Tampilkan gambar preview kalau sudah pilih gambar baru -->
                        <template x-if="imagePreview">
                            <img :src="imagePreview" class="w-32 h-32 mt-4 object-cover rounded-xl shadow" />
                        </template>
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
