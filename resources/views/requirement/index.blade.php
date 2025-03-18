<x-layout.default>
    <div x-data="striped" class="panel">
        <div class="flex justify-between mb-6">
            <h5 class="font-semibold text-lg dark:text-white-light">List Kebutuhan</h5>
            <a href="/requirement/create" class="btn bg-purple-600 hover:bg-purple-700 text-white">Tambah</a>
        </div>
        <table id="tableHover" class="table-hover"></table>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("striped", () => ({
                requirements: @json($requirements->toArray()),
                dataTable: null,
                init() {
                    console.log(this.requirement); // Log data pengguna untuk verifikasi

                    const requirementsEditUrl = "{{ route('requirement.edit', ['requirement' => ':id']) }}";
                    const tableOptions = {
                        data: {
                            headings: ["ID", "Kode", "Jenis kebutuhan", "Kategori", "Harga/kg",
                                "Detail"
                            ],
                            data: this.requirements.map((requirement, index) => {
                                const editServices = requirementEditUrl.replace(':id', requirement
                                    .id);
                                return [
                                    index + 1,
                                    
                                    requirement.stock,
                                    requirement.name_service,

                                    requirement.category?.requirement_name ?? '-',
                                    requirement.price,
                                    `<div>
                                        <a href="/services/${requirement.id}/detail">
                                            <div class="bg-purple-200 p-2 rounded-md inline-block">
                                            <svg width="20" height="23" viewBox="0 0 27 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0373 4.48763e-07H14.9627C17.5073 -2.16743e-05 19.5228 -3.92944e-05 21.1002 0.213677C22.7235 0.433623 24.0375 0.897042 25.0737 1.94127C26.1099 2.9855 26.5697 4.30961 26.788 5.94555C27 7.53515 27 9.56627 27 12.1306V17.8694C27 20.4337 27 22.4648 26.788 24.0545C26.5697 25.6904 26.1099 27.0145 25.0737 28.0587C24.0375 29.103 22.7235 29.5664 21.1002 29.7863C19.5228 30 17.5073 30 14.9627 30H12.0373C9.49269 30 7.47719 30 5.89981 29.7863C4.27646 29.5664 2.96253 29.103 1.92634 28.0587C0.890142 27.0145 0.430288 25.6904 0.212033 24.0545C-3.89963e-05 22.4648 -2.15075e-05 20.4337 4.45311e-07 17.8694V12.1306C-2.15075e-05 9.56627 -3.89963e-05 7.53515 0.212033 5.94555C0.430288 4.30961 0.890142 2.9855 1.92634 1.94127C2.96253 0.897042 4.27646 0.433623 5.89982 0.213677C7.47719 -3.92944e-05 9.49268 -2.16743e-05 12.0373 4.48763e-07ZM6.17656 2.28804C4.78351 2.47678 3.98093 2.83074 3.39494 3.42126C2.80896 4.01179 2.45773 4.8206 2.27044 6.22444C2.07913 7.65839 2.07692 9.54862 2.07692 12.2093V17.7907C2.07692 20.4514 2.07913 22.3416 2.27044 23.7756C2.45773 25.1794 2.80896 25.9882 3.39494 26.5787C3.98093 27.1693 4.78351 27.5232 6.17656 27.712C7.59948 27.9048 9.47517 27.907 12.1154 27.907H14.8846C17.5248 27.907 19.4005 27.9048 20.8234 27.712C22.2165 27.5232 23.0191 27.1693 23.6051 26.5787C24.191 25.9882 24.5423 25.1794 24.7296 23.7756C24.9209 22.3416 24.9231 20.4514 24.9231 17.7907V12.2093C24.9231 9.54862 24.9209 7.65839 24.7296 6.22444C24.5423 4.8206 24.191 4.01179 23.6051 3.42126C23.0191 2.83074 22.2165 2.47678 20.8234 2.28804C19.4005 2.09525 17.5248 2.09302 14.8846 2.09302H12.1154C9.47517 2.09302 7.59948 2.09525 6.17656 2.28804ZM6.92308 9.41861C6.92308 8.84063 7.38801 8.37209 7.96154 8.37209H19.0385C19.612 8.37209 20.0769 8.84063 20.0769 9.41861C20.0769 9.99658 19.612 10.4651 19.0385 10.4651H7.96154C7.38801 10.4651 6.92308 9.99658 6.92308 9.41861ZM6.92308 15C6.92308 14.422 7.38801 13.9535 7.96154 13.9535H19.0385C19.612 13.9535 20.0769 14.422 20.0769 15C20.0769 15.578 19.612 16.0465 19.0385 16.0465H7.96154C7.38801 16.0465 6.92308 15.578 6.92308 15ZM6.92308 20.5814C6.92308 20.0034 7.38801 19.5349 7.96154 19.5349H14.8846C15.4581 19.5349 15.9231 20.0034 15.9231 20.5814C15.9231 21.1594 15.4581 21.6279 14.8846 21.6279H7.96154C7.38801 21.6279 6.92308 21.1594 6.92308 20.5814Z" fill="#1C274C"/>
                                            </svg>
                                            </div>
                                        </a>
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