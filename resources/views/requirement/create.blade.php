<x-layout.default>

    <ul class="flex space-x-2 rtl:space-x-reverse mb-5">
        <li>
            <a href="/requirement" class="text-primary hover:underline">Kebutuhan</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Tambah Kebutuhan</span>
        </li>
    </ul>

    <div class="pt-5" x-data="requirementForm">
        <div class="panel">
            <form @submit.prevent="submitForm()">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                    <div class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <div :class="[isSubmitted ? (form.requirement_name ? 'has-success' : 'has-error') : '']">
                            <label for="requirement_name">Nama Kebutuhan</label>
                            <input id="requirement_name" type="text" placeholder="Masukkan nama kebutuhan" class="form-input" x-model="form.requirement_name" />
                            <template x-if="isSubmitted && form.requirement_name">
                                <p class="text-success mt-1">Nama kebutuhan sudah diisi</p>
                            </template>
                            <template x-if="isSubmitted && !form.requirement_name">
                                <p class="text-danger mt-1">Harap isi nama kebutuhan!</p>
                            </template>
                        </div>

                        <div :class="[isSubmitted ? (form.id_need ? 'has-success' : 'has-error') : '']">
                            <label for="id_need">Kategori</label>
                            <select id="id_need" class="form-input" x-model="form.id_need">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($needs as $need)
                                    <option value="{{ $need->id }}">{{ $need->name_category }}</option>
                                @endforeach
                            </select>
                            <template x-if="isSubmitted && form.id_need">
                                <p class="text-success mt-1">Nama kategori sudah diisi</p>
                            </template>
                            <template x-if="isSubmitted && !form.id_need">
                                <p class="text-danger mt-1">Harap isi nama kategori!</p>
                            </template>
                        </div>

                        <div :class="[isSubmitted ? (form.stock ? 'has-success' : 'has-error') : '']">
                            <label for="stock">Stok</label>
                            <input id="stock" type="number" placeholder="Masukkan jumlah stok" class="form-input" x-model="form.stock" />
                            <template x-if="isSubmitted && form.stock">
                                <p class="text-success mt-1">stock sudah diisi</p>
                            </template>
                            <template x-if="isSubmitted && !form.stock">
                                <p class="text-danger mt-1">Harap isi stock!</p>
                            </template>
                        </div>

                        <div :class="[isSubmitted ? (form.price ? 'has-success' : 'has-error') : '']">
                            <label for="price">Harga/item</label>
                            <input id="price" type="number" placeholder="Masukkan harga" class="form-input" x-model="form.price" />
                            <template x-if="isSubmitted && form.price">
                                <p class="text-success mt-1">harga sudah diisi</p>
                            </template>
                            <template x-if="isSubmitted && !form.requirement_name">
                                <p class="text-danger mt-1">Harap isi harga!</p>
                            </template>
                        </div>

                        <div>
                            <label for="grand_total">Total Harga</label>
                            <input id="grand_total" type="text" class="form-input bg-gray-100" x-model="grandTotalFormatted" readonly />
                            
                        </div>
                    </div>

                    <div>
                        <label for="image">Gambar</label>
                        <input type="file" @change="previewImage($event)" class="form-input" x-model="form.image"/>
                        <template x-if="imagePreview">
                            <img :src="imagePreview" class="w-32 h-32 mt-4 object-cover rounded-xl shadow" />
                        </template>
                    </div>

                </div>

                <div class="mt-6">
                    <button type="submit" class="btn bg-purple-600 hover:bg-purple-700 text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("requirementForm", () => ({
                form: {
                    requirement_name: '',
                    id_need: '',
                    stock: '',
                    price: '',
                },
                image: null,
                imagePreview: null,
                isSubmitted: false,

                get grandTotalFormatted() {
                    const total = this.form.stock * this.form.price;
                    return isNaN(total)
                        ? 'Rp 0'
                        : total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                },

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
                    this.isSubmitted = true;

                    if (this.form.requirement_name && this.form.id_need && this.form.stock && this.form.price) {
                        this.sendData();
                    }
                },

                sendData() {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const formData = new FormData();

                    formData.append('_token', csrfToken);
                    formData.append('requirement_name', this.form.requirement_name);
                    formData.append('id_need', this.form.id_need);
                    formData.append('stock', this.form.stock);
                    formData.append('price', this.form.price);
                    formData.append('grand_total', this.form.stock * this.form.price);
                    if (this.image) {
                        formData.append('image', this.image);
                    }

                    fetch("{{ route('requirement.store') }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: formData
                    }).then(res => {
                        if (res.ok) {
                            this.showMessage("Kebutuhan berhasil disimpan!");
                            window.location.href = "{{ route('requirement.index') }}";
                        } else {
                            this.showMessage("Gagal menyimpan kebutuhan.", "error");
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
