<x-layout.default>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="/customer" class="text-primary hover:underline">Pelanggan</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Tambah</span>
        </li>
    </ul>

    <div class="pt-5" x-data="form">
        <div class="panel">
            <form @submit.prevent="submitForm()" method="POST" action="{{ route('customer.store') }}" x-ref="form">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-5">
                    <div :class="[isSubmitForm ? (form.name ? 'has-success' : 'has-error') : '']">
                        <label for="customName">Nama</label>
                        <input id="customName" type="text" placeholder="Masukkan Nama Pelanggan!" class="form-input"
                            x-model="form.name" name="name" />
                        <template x-if="isSubmitForm && form.name">
                            <p class="text-success mt-1">Nama pelanggan sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.name">
                            <p class="text-danger mt-1">Harap isi nama yang sesuai!</p>
                        </template>
                    </div>
                    <div :class="[isSubmitForm ? (form.email ? 'has-success' : 'has-error') : '']">
                        <label for="customEmail">Email</label>
                        <input id="customEmail" type="email" placeholder="Masukkan Email Pelanggan!"
                            class="form-input" x-model="form.email" name="email" />
                        <template x-if="isSubmitForm && form.email">
                            <p class="text-success mt-1"> Email pelanggan sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.email">
                            <p class="text-danger mt-1">Harap isi email yang sesuai!</p>
                        </template>
                    </div>
                </div>
                <div class="pt-5">
                    <div :class="[isSubmitForm ? (form.address ? 'has-success' : 'has-error') : '']">
                        <label for="customAddress">Alamat</label>
                        <textarea id="customAddress" rows="3" class="form-textarea" placeholder="Masukkan Alamat Pelanggan!"
                            x-model="form.address" name="address"></textarea>
                        <template x-if="isSubmitForm && form.address">
                            <p class="text-success mt-1">Alamat pelanggan sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.address">
                            <p class="text-danger mt-1">Harap isi alamat yang sesuai!</p>
                        </template>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-6">Simpan</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data('form', () => ({
                form: {
                    name: '',
                    email: '',
                    address: '',
                },

                isSubmitForm: false,
                submitForm() {
                    this.isSubmitForm = true;
                    if (this.form.name && this.form.email && this.form.address) {
                        this.sendFormData();
                    } else {
                        this.showMessage('Harap isi semua form', 'error');
                    }
                },

                sendFormData() {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');
                    const url = "{{ route('customer.store') }}";

                    const formData = new FormData();
                    formData.append('_token', csrfToken);
                    formData.append('name', this.form.name);
                    formData.append('email', this.form.email);
                    formData.append('address', this.form.address);

                    fetch(url, {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData,
                    }).then(response => {
                        if (response.ok) {
                            this.showMessage("Data berhasil disimpan");
                            window.location.href = "{{ route('customer.index') }}";
                        } else {
                            response.json().then(data => {
                                this.showMessage(data.message || "Data gagal disimpan",
                                    "error");
                            }).catch(() => {
                                this.showMessage("Data gagal disimpan", "error");
                            });
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
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    toast.fire({
                        icon: type,
                        title: msg,
                    });
                },
            }));
        });
    </script>
</x-layout.default>
