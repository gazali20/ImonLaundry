<x-layout.default>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('user.index') }}" class="text-primary hover:underline">Pengguna</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>

    <div class="pt-5" x-data="form">
        <div class="panel">
            <form @submit.prevent="submitForm()" method="POST" action="{{ route('user.update', $user->id) }}"
                x-ref="form">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div :class="[isSubmitForm ? (form.name ? 'has-success' : 'has-error') : '']">
                        <label for="custoName">Nama</label>
                        <input id="custoName" type="text" placeholder="Masukan Nama Pengguna!" class="form-input"
                            x-model="form.name" name="name" />
                        <template x-if="isSubmitForm && form.name">
                            <p class="text-success mt-1">Nama pekerja sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.name">
                            <p class="text-danger mt-1">Harap isi nama pekerja yang sesuai!</p>
                        </template>
                    </div>
                    <div :class="[isSubmitForm ? (form.role ? 'has-success' : 'has-error') : '']">
                        <label for="customRole">Pekerjaan</label>
                        <select id="customRole" class="form-select  text-white-dark" x-model="form.role"
                            name="role">
                            <option value="">Pilih Pekerja!</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="cashier" {{ old('role', $user->role) == 'cashier' ? 'selected' : '' }}>Kasir
                            </option>
                            <option value="mechanic" {{ old('role', $user->role) == 'mechanic' ? 'selected' : '' }}>
                                Mekanik</option>
                        </select>
                        <template x-if="isSubmitForm && form.role">
                            <p class="text-success mt-1">Pekerjaan sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.role">
                            <p class="text-danger mt-1">Harap pilih pekerjaan yang sesuai!</p>
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
