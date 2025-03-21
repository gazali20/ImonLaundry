<x-layout.default>
    <ul class="flex space-x-2 rtl:space-x-reverse mb-5">
        <li>
            <a href="/need" class="text-primary hover:underline">list kategori layanan</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit Kategori Layanan</span>
        </li>
    </ul>

    <div class="pt-5" x-data="form">
        <div class="panel">

            <form @submit.prevent="submitForm()" x-ref="form">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div :class="[isSubmitForm ? (form.name_category ? 'has-success' : 'has-error') : '']">
                        <label for="custoName">Nama Kategori Layanan</label>
                        <input id="custoName" type="text" placeholder="Masukan Kategori Layanan" class="form-input"
                            x-model="form.name_category" />
                        
                        <template x-if="isSubmitForm && form.name_category">
                            <p class="text-success mt-1">Nama kategori layanan sudah terisi</p>
                        </template>

                        <template x-if="isSubmitForm && !form.name_category">
                            <p class="text-danger mt-1">Harap isi nama kategori layanan</p>
                        </template>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-6">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                form: {
                    name_category: @json($category->name_category),
                },
                isSubmitForm: false,
                
                submitForm() {
                    this.isSubmitForm = true;
                    if (this.form.name_category) {
                        this.sendFormData();
                    } else {
                        this.showMessage('Harap isi semua form', 'error');
                    }
                },

                sendFormData() {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const url = "{{ route('category.update', $category->id) }}";

                    const formData = new FormData();
                    formData.append('_token', csrfToken);
                    formData.append('_method', 'PUT'); 
                    formData.append('name_category', this.form.name_category);

                    fetch(url, {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData,
                    }).then(response => {
                        if (response.ok) {
                            this.showMessage("Data berhasil disimpan", "success");
                            setTimeout(() => {
                                window.location.href = "{{ route('category.index') }}";
                            }, 1000); 
                        } else {
                            this.showMessage("Data gagal disimpan", "error");
                        }
                    }).catch(error => {
                        this.showMessage("Terjadi kesalahan: " + error.message, "error");
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
