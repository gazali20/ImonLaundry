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
                            headings: ["ID", "Kode", "Jenis Layanan", "Kategori", "Harga/kg",
                                "Detail"
                            ],
                            data: this.services.map((services, index) => {
                                const editServices = servicesEditUrl.replace(':id', services
                                    .id);
                                return [
                                    index + 1,
                                    services.code,
                                    services.name_service,

                                    services.category?.name_category ?? '-',
                                    services.price,
                                    `<div>
                                        <a href="/services/${services.id}/detail">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 4.45962C9.91153 4.16968 10.9104 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C3.75612 8.07914 4.32973 7.43025 5 6.82137" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                            <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="#1C274C" stroke-width="1.5"/>
                                            </svg>
                                        </a>
                                        <button @click.prevent="confirmDelete(${services.id})" type="button">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.5" d="M11.3456 22H12.1544C14.9371 22 16.3285 22 17.2331 21.0936C18.1378 20.1873 18.2303 18.7005 18.4154 15.727L18.6821 11.4425C18.7826 9.82908 18.8328 9.02238 18.3789 8.51119C17.9251 8 17.1587 8 15.626 8H7.87405C6.34127 8 5.57488 8 5.12105 8.51119C4.66722 9.02238 4.71744 9.82908 4.81788 11.4425L5.08459 15.727C5.2697 18.7005 5.36225 20.1873 6.26689 21.0936C7.17153 22 8.56289 22 11.3456 22Z" fill="#1C274C"/>
                                                    <path d="M2.75 6.16667C2.75 5.70644 3.09538 5.33335 3.52143 5.33335L6.18567 5.3329C6.71502 5.31841 7.18202 4.95482 7.36214 4.41691C7.36688 4.40277 7.37232 4.38532 7.39185 4.32203L7.50665 3.94993C7.5769 3.72179 7.6381 3.52303 7.72375 3.34536C8.06209 2.64349 8.68808 2.1561 9.41147 2.03132C9.59457 1.99973 9.78848 1.99987 10.0111 2.00002H13.4891C13.7117 1.99987 13.9056 1.99973 14.0887 2.03132C14.8121 2.1561 15.4381 2.64349 15.7764 3.34536C15.8621 3.52303 15.9233 3.72179 15.9935 3.94993L16.1083 4.32203C16.1279 4.38532 16.1333 4.40277 16.138 4.41691C16.3182 4.95482 16.8778 5.31886 17.4071 5.33335H19.9786C20.4046 5.33335 20.75 5.70644 20.75 6.16667C20.75 6.62691 20.4046 7 19.9786 7H3.52143C3.09538 7 2.75 6.62691 2.75 6.16667Z" fill="#1C274C"/>
                                                </svg>
                                            </button>
                                        </div>`,
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
                            new window.Swal('Hapus!', 'Data kamu berhasil terhapus.',
                                'success');
                            return result.isConfirmed;
                        }
                        return false;
                    });
                },
                async confirmDelete(servicesId) {
                    const isConfirmed = await this.showConfirmDialog();
                    console.log(isConfirmed);

                    if (isConfirmed) {
                        this.deleteServices(servicesId);
                    }
                },
                async deleteServices(servicesId) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');
                    const route = "{{ route('services.destroy', ':id') }}";
                    const url = route.replace(':id', servicesId);

                    try {
                        const response = await fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        });

                        if (response.ok) {
                            this.removeServicesFromList(servicesId);
                        } else {
                            console.error('Failed to delete user', response.statusText);
                        }
                    } catch (e) {
                        console.log('Terjadi kesalahan', e.message);
                    }
                },
                removeServicesFromList(servicesId) {
                    const index = this.users.findIndex(data => data.id === servicesId);
                    if (index !== -1) {
                        this.services.splice(index, 1);
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
