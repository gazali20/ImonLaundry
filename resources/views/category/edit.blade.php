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
                    name_category: @json($category->name_category),
                },
                isSubmitForm: false,
                submitForm() {
                    this.isSubmitForm = true;
                    if (this.form.name_category) {
                        this.$refs.form.submit();
                        this.showMessage('Data berhasil disimpan', 'success');
                    } else {
                        this.showMessage('Harap isi semua form', 'error');
                    }
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
