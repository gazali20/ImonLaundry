
    <x-layout.default>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="/user" class="text-primary hover:underline">Pengguna</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Edit</span>
            </li>
        </ul>

        <div class="pt-5" x-data="form">
            <div class="panel">
                <form @submit.prevent="submitForm()">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div :class="[isSubmitForm ? (form.name ? 'has-success' : 'has-error') : '']">
                            <label for="custoName">Nama</label>
                            <input id="custoName" type="text" placeholder="Contoh: udin" class="form-input" x-model="form.name" />
                            <template x-if="isSubmitForm && form.name">
                                <p class="text-success mt-1">Nama sudah sesuai</p>
                            </template>
                            <template x-if="isSubmitForm && !form.name">
                                <p class="text-danger mt-1">Harap isi nama yang sesuai</p>
                            </template>
                        </div>
                        <div :class="[isSubmitForm ? (form.role ? 'has-success' : 'has-error') : '']">
                            <label for="customRole">Pekerjaan</label>
                            <select id="customRole" class="form-select form-select-lg text-white-dark" x-model="form.role">
                                <option>Pilih Pekerja</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                <option value="cashier" {{ $user->role == 'cashier' ? 'selected' : ''}}>Kasir</option>
                                <option value="mechanic" {{ $user->role == 'mechanic' ? 'selected' : ''}}>Mekanik</option>
                            </select>
                            <template x-if="isSubmitForm && form.role">
                                <p class="text-success mt-1">Pekerjaan sudah sesuai</p>
                            </template>
                            <template x-if="isSubmitForm && !form.role">
                                <p class="text-danger mt-1">Harap pilih pekerjaan</p>
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
                        name: '{{ $user->name }}',
                        role: '{{ $user->role }}',
                    },
                    isSubmitForm: false,
                    submitForm() {
                        this.isSubmitForm = true;
                        if (this.form.name && this.form.role) {
                            this.sendFormData();
                        } else {
                            this.showMessage('Harap isi Form ini', 'error');
                        }
                    },
                    sendFormData() {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const url = "{{ route('user.update', ['user' => $user->id]) }}";

                        const formData = new FormData();
                        formData.append('_token', csrfToken);
                        formData.append('_method', 'PUT');
                        formData.append('name', this.form.name);
                        formData.append('role', this.form.role);

                        fetch(url, {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: formData,
                        }).then(response => {
                            if (response.ok) {
                                this.showMessage("Data berhasil disimpan");
                                window.location.href = "{{ route('user.index') }}";
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
