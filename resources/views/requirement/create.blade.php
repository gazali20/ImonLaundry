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
            <h2 class="text-lg font-semibold mb-4 flex items-center space-x-2">
                <a href="/requirement" class="inline-flex items-center">
                    <svg width="10" height="15" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M10.9415 1.7225C11.387 2.07069 11.4386 2.68226 11.0567 3.08848L3.14939 11.4997L11.0567 19.9109C11.4386 20.3171 11.387 20.9287 10.9415 21.2769C10.4959 21.6251 9.82518 21.578 9.44329 21.1718L0.94329 12.1301C0.602237 11.7674 0.602237 11.232 0.94329 10.8692L9.44329 1.82757C9.82518 1.42135 10.4959 1.37431 10.9415 1.7225Z"
                            fill="#1C274C" stroke="#1C274C" stroke-linecap="round" />
                    </svg>
                </a>
                <span>Tambah Kebutuhan</span>
            </h2>
            
            <form @submit.prevent="submitForm()">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- KIRI: FORM INPUT -->
                    <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nama Kebutuhan -->
                        <div :class="[isSubmitted ? (form.requirement_name ? 'has-success' : 'has-error') : '']">
                            <label class="block font-medium mb-1">Jenis Kebutuhan</label>
                            <input type="text" placeholder="Masukkan nama kebutuhan" class="form-input w-full"
                                x-model="form.requirement_name" />
                                <template x-if="isSubmitted && form.requirement_name">
                                    <p class="text-success mt-1">Nama kebutuhan sudah diisi</p>
                                </template>
                                <template x-if="isSubmitted && !form.requirement_name">
                                    <p class="text-danger mt-1">Harap isi nama kebutuhan!</p>
                                </template>
                        </div>

                        <!-- Stock -->
                        <div :class="[isSubmitted ? (form.stock ? 'has-success' : 'has-error') : '']">
                            <label class="block font-medium mb-1">Stock</label>
                            <input type="number" placeholder="Masukkan jumlah stok" class="form-input w-full"
                                x-model="form.stock" />
                                <template x-if="isSubmitted && form.stock">
                                    <p class="text-success mt-1">Nama kebutuhan sudah diisi</p>
                                </template>
                                <template x-if="isSubmitted && !form.stock">
                                    <p class="text-danger mt-1">Harap isi nama kebutuhan!</p>
                                </template>
                        </div>

                        <!-- Kategori -->
                        <div :class="[isSubmitted ? (form.id_need ? 'has-success' : 'has-error') : '']">
                            <label class="block font-medium mb-1">Kategori</label>
                            <select class="form-input w-full" x-model="form.id_need">
                                <option value="">Pilih Kategori</option>
                                @foreach ($needs as $need)
                                    <option value="{{ $need->id }}">{{ $need->name_category }}</option>
                                @endforeach
                            </select>

                            <template x-if="isSubmitted && form.id_need">
                                <p class="text-success mt-1">Nama kebutuhan sudah diisi</p>
                            </template>
                            <template x-if="isSubmitted && !form.id_need">
                                <p class="text-danger mt-1">Harap isi nama kebutuhan!</p>
                            </template>
                        </div>

                        <!-- Harga per item -->
                        <div :class="[isSubmitted ? (form.price ? 'has-success' : 'has-error') : '']">
                            <label class="block font-medium mb-1">Harga/Item</label>
                            <input type="number" placeholder="Masukkan harga/item" class="form-input w-full"
                                x-model="form.price" />
                                <template x-if="isSubmitted && form.price">
                                    <p class="text-success mt-1">Nama kebutuhan sudah diisi</p>
                                </template>
                                <template x-if="isSubmitted && !form.price">
                                    <p class="text-danger mt-1">Harap isi nama kebutuhan!</p>
                                </template>
                        </div>

                        <!-- Total Harga -->
                        <div class="sm:col-span-2">
                            <label class="block font-medium mb-1">Harga Total</label>
                            <input type="text" class="form-input bg-gray-100 w-64" x-model="grandTotalFormatted"
                                readonly />
                        </div>
                    </div>


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

                <!-- Tombol Simpan -->
                <div class="mt-6 text-left">
                    <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold shadow w-[200px] h-[40px]">
                        Simpan
                    </button>
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
                    return isNaN(total) ?
                        'Rp 0' :
                        total.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        });
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

                    if (this.form.requirement_name && this.form.id_need && this.form.stock && this.form
                        .price) {
                            console.log("Image to send:", this.image); // Tambahan debug
                        this.sendData();
                    }
                },

                sendData() {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');
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
