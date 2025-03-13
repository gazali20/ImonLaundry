<x-layout.default>
    <div x-data="striped" class="panel">
        <div class="flex justify-between mb-6">
            <h5 class="font-semibold text-lg dark:text-white-light">List Layanan</h5>
            <a href="/services/create" class="btn btn-primary">Tambah</a>
        </div>
        <table id="tableHover" class="table-hover"></table>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("striped", () => ({
                services: @json($services->toArray()),
                dataTable: null,
                init() {
                    console.log(this.services); // Log data pengguna untuk verifikasi

                    const servicesEditUrl = "{{ route('services.edit', ['services' => ':id']) }}";
                    const tableOptions = {
                        data: {
                            headings: ["ID", "Kode", "Jenis Layanan", "Kategori", "Harga", "Detail"],
                            data: this.services.map((services, index) => {
                                const editServices = servicesEditUrl.replace(':id', services.id);
                                return [
                                    index + 1,
                                    services.code,
                                    services.name_service,
                                    
                                    services.category?.name_category ?? '-',
                                    services.price,
                                    '',
                                ];
                            }),
                        },
                        sortable: false,
                        searchable: true,
                        perPage: 10,
                        perPageSelect: [10, 20, 30, 50, 100],
                        firstLast: true,
                        firstText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        lastText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        prevText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        nextText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        labels: {
                            perPage: "{select}",
                        },
                        layout: {
                            top: "{search}",
                            bottom: "{info}{select}{pager}",
                        },
                    };
                    this.dataTable = new simpleDatatables.DataTable('#tableHover', tableOptions);
                },
                async showConfirmDialog() {
                    return new window.Swal({
                        icon: 'warning',
                        title: 'Anda Yakin?',
                        text: "Data tidak bisa di kembalikan",
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        padding: '2em',
                    }).then((result) => {
                        if (result.value) {
                            new window.Swal('Hapus!', 'Data kamu berhasil terhapus.', 'success');
                            return result.isConfirmed;
                        }
                        return false;
                    });
                },
                async confirmDelete(userId) {
                    const isConfirmed = await this.showConfirmDialog();
                    console.log(isConfirmed);

                    if (isConfirmed) {
                        this.deleteUser(userId);
                    }
                },
                async deleteUser(userId) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const route = "{{ route('user.destroy', ':id') }}";
                    const url = route.replace(':id', userId);

                    try {
                        const response = await fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        });

                        if (response.ok) {
                            this.removeUserFromList(userId);
                        } else {
                            console.error('Failed to delete user', response.statusText);
                        }
                    } catch (e) {
                        console.log('Terjadi kesalahan', e.message);
                    }
                },
                removeUserFromList(userId) {
                    const index = this.users.findIndex(data => data.id === userId);
                    if (index !== -1) {
                        this.users.splice(index, 1);
                        if (this.dataTable) {
                            this.dataTable.destroy();
                            this.init();
                        }
                    }
                },
            }));
        });
    </script>
</x-layout.default>