<x-layout.default>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('transaction.index') }}" class="text-primary hover:underline">Transaksi</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Tambah</span>
        </li>
    </ul>
    <div class="pt-5" x-data="form">
        <div class="panel">
            <form @submit.prevent="submitForm()" method="POST" action="{{ route('transaction.store') }}" x-ref="form">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div :class="[isSubmitForm ? (form.mechanic_id ? 'has-success' : 'has-error') : '']">
                        <label for="customMechanic">Mekanik</label>
                        <select id="customMechanic" class="form-select text-white-dark" x-model="form.mechanic_id"
                            name="mechanic_id">
                            <option value="">Pilih Mekanik!</option>
                            @foreach ($mechanics as $mechanic)
                                <option value="{{ $mechanic->id }}">{{ $mechanic->name }}</option>
                            @endforeach
                        </select>
                        <template x-if="isSubmitForm && form.mechanic_id">
                            <p class="text-success mt-1">Mekanik sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.mechanic_id">
                            <p class="text-danger mt-1">Harap pilih mekanik yang sesuai!</p>
                        </template>
                    </div>
                    <div :class="[isSubmitForm ? (form.customer_id ? 'has-success' : 'has-error') : '']">
                        <label for="customCustomer">Pelanggan</label>
                        <select id="customCustomer" class="form-select text-white-dark" x-model="form.customer_id"
                            name="customer_id">
                            <option value="">Pilih Pelanggan!</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <template x-if="isSubmitForm && form.customer_id">
                            <p class="text-success mt-1">Pelanggan sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.customer_id">
                            <p class="text-danger mt-1">Harap pilih pelanggan yang sesuai!</p>
                        </template>
                    </div>
                    <div :class="[isSubmitForm ? (form.vehicle_id ? 'has-success' : 'has-error') : '']">
                        <label for="customVehicle">Kendaraan</label>
                        <select id="customVehicle" class="form-select text-white-dark" x-model="form.vehicle_id"
                            name="vehicle_id">
                            <option value="">Pilih Kendaraan!</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->brand }}</option>
                            @endforeach
                        </select>
                        <template x-if="isSubmitForm && form.vehicle_id">
                            <p class="text-success mt-1"> Kendaraan sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.vehicle_id">
                            <p class="text-danger mt-1">Harap pilih kendaraan yang sesuai</p>
                        </template>
                    </div>
                    <div :class="[isSubmitForm ? (form.cashier_id ? 'has-success' : 'has-error') : '']">
                        <label for="customCashier">Kasir</label>
                        <select id="customCashier" class="form-select text-white-dark" x-model="form.cashier_id"
                            name="cashier_id">
                            <option value="">Pilih Kasir!</option>
                            @foreach ($cashiers as $cashier)
                                <option value="{{ $cashier->id }}">{{ $cashier->name }}</option>
                            @endforeach
                        </select>
                        <template x-if="isSubmitForm && form.cashier_id">
                            <p class="text-success mt-1">Kasir sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.cashier_id">
                            <p class="text-danger mt-1">Harap pilih kasir yang sesuai!</p>
                        </template>
                    </div>
                    <div :class="[isSubmitForm ? (form.spare_parts ? 'has-success' : 'has-error') : '']">
                        <label for="customSparePart">Suku Cadang</label>
                        <select id="customSparePart" class="form-select text-white-dark" x-model="form.spare_parts"
                            name="spare_parts" @change="calculateGrandTotal">
                            <option value="">Pilih Suku Cadang!</option>
                            @foreach ($spareParts as $sparePart)
                                <option value="{{ $sparePart->id }}" data-price="{{ $sparePart->price }}">
                                    {{ $sparePart->name }}</option>
                            @endforeach
                        </select>
                        <template x-if="isSubmitForm && form.spare_parts">
                            <p class="text-success mt-1">Suku cadang sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.spare_parts">
                            <p class="text-danger mt-1">Harap pilih suku cadang yang sesuai!</p>
                        </template>
                    </div>
                    <div :class="[isSubmitForm ? (form.quantity ? 'has-success' : 'has-error') : '']">
                        <label for="customQuantity">Jumlah</label>
                        <input id="customQuantity" type="number" placeholder="Masukkan Jumlahnya!" class="form-input"
                            x-model="form.quantity" name="quantity" @input="calculateGrandTotal" />
                        <template x-if="isSubmitForm && form.quantity">
                            <p class="text-success mt-1">Jumlah sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.quantity">
                            <p class="text-danger mt-1">Harap isi Jumlah yang sesuai!</p>
                        </template>
                    </div>
                    <div :class="[isSubmitForm ? (form.date ? 'has-success' : 'has-error') : '']">
                        <label for="customDate">Tanggal</label>
                        <input id="customDate" type="date" class="form-input" x-model="form.date" name="date" />
                        <template x-if="isSubmitForm && form.date">
                            <p class="text-success mt-1"> Tanggal sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.date">
                            <p class="text-danger mt-1">Harap isi tanggal yang sesuai</p>
                        </template>
                    </div>
                    <div :class="[isSubmitForm ? (form.grand_total ? 'has-success' : 'has-error') : '']">
                        <label for="customGrandTotal">Total Harga</label>
                        <input id="customGrandTotal" type="number" placeholder="Total Harga" class="form-input"
                            x-model="form.grand_total" name="grand_total" readonly />
                        <template x-if="isSubmitForm && form.grand_total">
                            <p class="text-success mt-1">Total harga sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.grand_total">
                            <p class="text-danger mt-1">Harap isi jumlah untuk menghitung total!</p>
                        </template>
                    </div>
                </div>
                <div class="pt-5">
                    <div :class="[isSubmitForm ? (form.description ? 'has-success' : 'has-error') : '']">
                        <label for="customDescription">Deskripsi</label>
                        <textarea id="customDescription" rows="4" class="form-textarea ltr:rounded-l-none rtl:rounded-r-none"
                            x-model="form.description" name="description"></textarea>
                        <template x-if="isSubmitForm && form.description">
                            <p class="text-success mt-1">Deskripsi sudah terisi</p>
                        </template>
                        <template x-if="isSubmitForm && !form.description">
                            <p class="text-danger mt-1">Harap isi deskripsi!</p>
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
                    mechanic_id: '',
                    customer_id: '',
                    vehicle_id: '',
                    cashier_id: '',
                    spare_parts: '',
                    quantity: '',
                    date: '',
                    grand_total: '',
                    description: '',
                },

                isSubmitForm: false,
                submitForm() {
                    this.isSubmitForm = true;
                    if (this.form.mechanic_id && this.form.vehicle_id && this.form.customer_id && this
                        .form.cashier_id && this.form.spare_parts && this.form.quantity && this.form
                        .date && this.form.grand_total && this.form.description) {
                        this.$refs.form.submit();
                        this.showMessage('Data berhasil disimpan', 'success');
                    } else {
                        this.showMessage('Harap isi semua form', 'error');
                    }
                },

                calculateGrandTotal() {
                    const sparePartElement = document.getElementById('customSparePart');
                    const selectedOption = sparePartElement.options[sparePartElement.selectedIndex];
                    const price = selectedOption.getAttribute('data-price');
                    const quantity = this.form.quantity;

                    if (price && quantity) {
                        this.form.grand_total = price * quantity;
                    } else {
                        this.form.grand_total = '';
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
