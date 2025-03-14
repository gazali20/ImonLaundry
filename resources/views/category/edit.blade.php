<x-layout.default>
    <div class="pt-5" x-data="form">
        <div class="panel">

            

            <form @submit.prevent="submitForm()" method="POST" action="{{ route('category.update', $category->id) }}"
                x-ref="form">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <p>Category: {{ $category->name_category }}</p>

           
                    <div :class="[isSubmitForm ? (form.name_category ? 'has-success' : 'has-error') : '']">
                        <label for="custoName">Nama Kategori</label>
                        <input id="custoName" type="text" placeholder="Masukan Kategori Layanan" class="form-input"
                            x-model="form.name_category" />
                        <template x-if="isSubmitForm && form.name_category">

                            <p class="text-success mt-1">Nama kategori sudah terisi</p>

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
<<<<<<< HEAD
                    name_category: @json($category->name_category),
=======
                    name_category: '',
                    
>>>>>>> 7b76f6b2053cbd718665c58134f853e94b2848a3
                },
                isSubmitForm: false,
                submitForm() {
                    this.isSubmitForm = true;
                    if (this.form.name_category) {
<<<<<<< HEAD
                        this.$refs.form.submit();
                        this.showMessage('Data berhasil disimpan', 'success');
                    } else {
                        this.showMessage('Harap isi semua form', 'error');
                    }
                },
=======
                        this.sendFormData();
                    }
                },
                sendFormData() {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');
                    const url = "{{ route('category.store') }}";

                    const formData = new FormData();
                    formData.append('_token', csrfToken);
                    formData.append('name_category', this.form.name_category);
                   

                    fetch(url, {
                        method: "POST",
                        header: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData,
                    }).then(respone => {
                        if (respone.ok) {
                            this.showMessage("Data berhasil di simpan");
                            window.location.href = "{{ route('category.index') }}";
                        } else {
                            this.showMessage("Data gagal disimpan");
                        }
                    }).catch(error => {
                        this.showMessage("Terjadi kesalahan :" + error.message, "error");
                    });
                },
>>>>>>> 7b76f6b2053cbd718665c58134f853e94b2848a3
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
