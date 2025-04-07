<x-layout.default>

    <div class="pt-3" x-data="form">
        <div class="panel">
            <h2 class="text-lg font-semibold mb-4 flex items-center space-x-2">
                <a href="/need" class="inline-flex items-center">
                    <svg width="10" height="15" viewBox="0 0 12 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M10.9415 1.7225C11.387 2.07069 11.4386 2.68226 11.0567 3.08848L3.14939 11.4997L11.0567 19.9109C11.4386 20.3171 11.387 20.9287 10.9415 21.2769C10.4959 21.6251 9.82518 21.578 9.44329 21.1718L0.94329 12.1301C0.602237 11.7674 0.602237 11.232 0.94329 10.8692L9.44329 1.82757C9.82518 1.42135 10.4959 1.37431 10.9415 1.7225Z"
                            fill="#1C274C" stroke="#1C274C" stroke-linecap="round" />
                    </svg>
                </a>
                <span>Tambah Kategori Layanan</span>
            </h2>
            <form @submit.prevent="submitForm()">
                <div class="grid grid-cols-1 sm:grid-cols-2 pt-3 gap-5">
                    <div :class="[isSubmitForm ? (form.name_category ? 'has-success' : 'has-error') : '']">
                        <label for="custoName">Nama Kategori</label>
                        <input id="custoName" type="text" placeholder="Masukan Kategori Kebutuhan" class="form-input"
                            x-model="form.name_category" />
                        <template x-if="isSubmitForm && form.name_category">
                            <p class="text-success mt-1">Kategori terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.name_category">
                            <p class="text-danger mt-1">Harap isi nama pekerja yang sesuai!</p>
                        </template>
                    </div>
                </div>
                <button type="submit"
                    class=" bg-purple-600 hover:bg-purple-700 mt-6 rounded-lg font-semibold text-white w-[100px] h-[40px]">Simpan</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                form: {
                    name_category: '',

                },
                isSubmitForm: false,
                submitForm() {
                    this.isSubmitForm = true;
                    if (this.form.name_category) {
                        this.sendFormData();
                    }
                },
                sendFormData() {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');
                    const url = "{{ route('need.store') }}";

                    const formData = new FormData();
                    formData.append('_token', csrfToken);
                    formData.append('name_category', this.form.name_category);


                    fetch(url, {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData,
                    }).then(respone => {
                        if (respone.ok) {
                            this.showMessage("Data berhasil di simpan");
                            window.location.href = "{{ route('need.index') }}";
                        } else {
                            this.showMessage("Data gagal disimpan");
                        }
                    }).catch(error => {
                        this.showMessage("Terjadi kesalahan :" + error.message, "error");
                    });
                },
                showMessage(msg = '', type = 'success') {
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
            }));
        });
    </script>
</x-layout.default>
