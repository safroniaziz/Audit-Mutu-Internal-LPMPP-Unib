@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Auditee
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Auditee</li>
@endsection
@section('content')
<!--begin::Content container-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="w-100 mb-2">
                    <div class="alert alert-danger d-flex align-items-center p-5">
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                            <i class="ki-duotone ki-shield-tick fs-2 text-danger">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>

                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-danger">Perhatian!</h4>
                            <span>Jika Anda ingin menghapus data Auditor, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu.</span>
                        </div>
                    </div>
                </div>
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-auditor-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Auditor" />
                    </div>
                </div>

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-auditor-table-toolbar="base">
                        <button type="button" id="addAuditorButton" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                            <i class="fas fa-plus fa-sm"></i> Tambah Auditor
                        </button>
                    </div>
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-auditor-table-toolbar="selected">
                        <div class="fw-bold me-5">
                        <span class="me-2" data-kt-auditor-table-select="selected_count"></span>Dipilih</div>
                        <button type="button" class="btn btn-danger" data-kt-auditor-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                    </div>

                </div>
            </div>
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-125px">Nama Auditee</th>
                            <th class="min-w-125px">Kategori Auditee</th>
                            <th class="min-w-125px">Username</th>
                            <th class="min-w-125px">Email</th>
                            <th class="min-w-125px">Status</th>
                            <th class="text-end min-w-100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach ($auditees as $auditee)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="{{ $auditee->id }}" />
                                </div>
                            </td>
                            <td class="d-flex align-items-center">
                                <!--begin:: Avatar -->
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="#">
                                        <div class="symbol-label">
                                            @if ($auditee->foto)
                                                <img src="{{ Storage::url($auditee->foto) }}" alt="{{ $auditee->name }}" class="w-100" />
                                            @else
                                                <img src="{{ asset('assets/src/images/profile.png') }}" alt="{{ $auditee->name }}" class="w-100" />
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::User details-->
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $auditee->name }}</a>
                                </div>
                                <!--begin::User details-->
                            </td>
                            <td>{{ optional($auditee->unitKerja)->nama_unit_kerja }}</td>
                            <td>{{ $auditee->username }}</td>
                            <td>{{ $auditee->email }}</td>
                            <td>
                                @if ($auditee->trashed())
                                    <span class="badge badge-light-danger">Tidak Aktif</span>
                                @else
                                    <span class="badge badge-light-success">Aktif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                    @if ($auditee->trashed())
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 restore-item" data-id="{{ $auditee->id }}">Aktifkan</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 delete-permanent-item" data-id="{{ $auditee->id }}">Hapus Permanen</a>
                                        </div>
                                    @else
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 edit-item" data-id="{{ $auditee->id }}">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 delete-item" data-id="{{ $auditee->id }}">Nonaktifkan</a>
                                        </div>
                                        <!--end::Menu item-->
                                    @endif
                                </div>
                                <!--end::Menu-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    </div>
</div>

@include('layouts.partials._modal_auditee')
@endsection

@push('scripts')
<script>
    "use strict";

    // Class definition
    var KTUsersList = function () {
        // Define shared variables
        var datatable;
        var table;
        var toolbarBase;
        var toolbarSelected;
        var selectedCount;

        // Private functions
        var initUserTable = function () {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');

            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "info": false,
                'order': [],
                "pageLength": 10,
                "lengthChange": false,
                'columnDefs': [
                    { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                    { orderable: false, targets: 6 }, // Disable ordering on column 6 (actions)
                ]
            });

            // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
            datatable.on('draw', function () {
                initToggleToolbar();
                handleDeleteRows();
                toggleToolbars();
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
            filterSearch.addEventListener('keyup', function (e) {
                datatable.search(e.target.value).draw();
            });
        }

        // Filter Datatable
        var handleFilterDatatable = () => {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-user-table-filter="form"]');
            const filterButton = filterForm.querySelector('[data-kt-user-table-filter="filter"]');
            const selectOptions = filterForm.querySelectorAll('select');

            // Filter datatable on submit
            filterButton.addEventListener('click', function () {
                var filterString = '';

                // Get filter values
                selectOptions.forEach((item, index) => {
                    if (item.value && item.value !== '') {
                        if (index !== 0) {
                            filterString += ' ';
                        }

                        // Build filter value options
                        filterString += item.value;
                    }
                });

                // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
                datatable.search(filterString).draw();
            });
        }

        // Delete auditee
        var handleDeleteRows = () => {
            // Select all delete buttons
            const deleteButtons = table.querySelectorAll('[data-kt-user-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');

                    // Get auditee name
                    const userName = parent.querySelectorAll('td')[1].querySelectorAll('a')[1].innerText;

                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Are you sure you want to delete " + userName + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            Swal.fire({
                                text: "You have deleted " + userName + "!.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                // Remove current row
                                datatable.row($(parent)).remove().draw();
                            }).then(function () {
                                // Detect checked checkboxes
                                toggleToolbars();
                            });
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: customerName + " was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                })
            });
        }

        // Init toggle toolbar
        var initToggleToolbar = () => {
            // Toggle selected action toolbar
            // Select all checkboxes
            const checkboxes = table.querySelectorAll('[type="checkbox"]');

            // Select elements
            toolbarBase = document.querySelector('[data-kt-user-table-toolbar="base"]');
            toolbarSelected = document.querySelector('[data-kt-user-table-toolbar="selected"]');
            selectedCount = document.querySelector('[data-kt-user-table-select="selected_count"]');
            const deleteSelected = document.querySelector('[data-kt-user-table-select="delete_selected"]');

            // Toggle delete selected toolbar
            checkboxes.forEach(c => {
                // Checkbox on click event
                c.addEventListener('click', function () {
                    setTimeout(function () {
                        toggleToolbars();
                    }, 50);
                });
            });

            // Deleted selected rows
            deleteSelected.addEventListener('click', function () {
                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete selected customers?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            text: "You have deleted all selected customers!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            // Remove all selected customers
                            checkboxes.forEach(c => {
                                if (c.checked) {
                                    datatable.row($(c.closest('tbody tr'))).remove().draw();
                                }
                            });

                            // Remove header checked box
                            const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                            headerCheckbox.checked = false;
                        }).then(function () {
                            toggleToolbars(); // Detect checked checkboxes
                            initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Selected customers was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            });
        }

        // Toggle toolbars
        const toggleToolbars = () => {
            // Select refreshed checkbox DOM elements
            const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

            // Detect checkboxes state & count
            let checkedState = false;
            let count = 0;

            // Count checked boxes
            allCheckboxes.forEach(c => {
                if (c.checked) {
                    checkedState = true;
                    count++;
                }
            });

            // Toggle toolbars
            if (checkedState) {
                selectedCount.innerHTML = count;
                toolbarBase.classList.add('d-none');
                toolbarSelected.classList.remove('d-none');
            } else {
                toolbarBase.classList.remove('d-none');
                toolbarSelected.classList.add('d-none');
            }
        }

        return {
            // Public functions
            init: function () {
                table = document.getElementById('kt_table_users');

                if (!table) {
                    return;
                }

                initUserTable();
                initToggleToolbar();
                handleSearchDatatable();
                handleFilterDatatable();
                handleDeleteRows();
            }
        }
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTUsersList.init();
    });

    // Class definition
    var KTUsersAddUser = function () {
        // Shared variables
        const element = document.getElementById('kt_modal');
        const form = element.querySelector('#kt_modal_form');
        const modal = new bootstrap.Modal(element);

        // Init add schedule modal
        var initAddUser = () => {

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'name': {
                            validators: {
                                notEmpty: {
                                    message: 'Nama lengkap wajib diisi'
                                }
                            }
                        },
                        'email': {
                            validators: {
                                notEmpty: {
                                    message: 'Email wajib diisi'
                                }
                            }
                        },
                        'username': {
                            validators: {
                                notEmpty: {
                                    message: 'Username wajib diisi'
                                }
                            }
                        },
                        'unit_kerja_id': {
                            validators: {
                                notEmpty: {
                                    message: 'Unit kerja wajib diisi'
                                }
                            }
                        },
                    },

                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
            );

            // Submit button handler
            const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
            submitButton.addEventListener('click', e => {
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function (status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable button to avoid multiple click
                            submitButton.disabled = true;

                            // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            setTimeout(function () {
                                // Remove loading indication
                                submitButton.removeAttribute('data-kt-indicator');

                                // Enable button
                                submitButton.disabled = false;

                                // Show popup confirmation
                                Swal.fire({
                                    text: "Form has been successfully submitted!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        modal.hide();
                                    }
                                });

                                //form.submit(); // Submit form
                            }, 2000);
                        }
                    });
                }
            });

            // Cancel button handler
            const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
            cancelButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        form.reset(); // Reset form
                        modal.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });

            // Close button handler
            const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
            closeButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        form.reset(); // Reset form
                        modal.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });
        }

        return {
            // Public functions
            init: function () {
                initAddUser();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTUsersAddUser.init();
    });

    // Handle edit button
    $('.edit-item').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        // Fetch auditee data
        $.ajax({
            url: `/auditee/${id}/edit`,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    var auditee = response.data;

                    // Set form action and method
                    $('#kt_modal_form').attr('action', `/auditee/${id}`);
                    $('#methodField').val('PUT');
                    $('#auditorId').val(id);

                    // Fill form fields
                    $('input[name="name"]').val(auditee.name);
                    $('input[name="email"]').val(auditee.email);
                    $('input[name="username"]').val(auditee.username);
                    $('select[name="unit_kerja_id"]').val(auditee.unit_kerja_id);

                    // Update modal title
                    $('#modalTitle').text('Edit Auditee');

                    // Show modal
                    $('#kt_modal').modal('show');
                }
            },
            error: function(xhr) {
                // Handle error
                Swal.fire({
                    text: "Terjadi kesalahan!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        });
    });

    // Handle delete button
    $('.delete-item').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            text: "Apakah Anda yakin ingin menonaktifkan auditee ini?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ya, nonaktifkan!",
            cancelButtonText: "Tidak",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light"
            }
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: `/auditee/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            text: "Auditee berhasil dinonaktifkan!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function () {
                            // Reload page
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        // Handle error
                        Swal.fire({
                            text: "Terjadi kesalahan!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });
    });

    // Handle restore button
    $('.restore-item').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            text: "Apakah Anda yakin ingin mengaktifkan kembali auditee ini?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ya, aktifkan!",
            cancelButtonText: "Tidak",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light"
            }
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: `/auditee/${id}/restore`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            text: "Auditee berhasil diaktifkan!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function () {
                            // Reload page
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        // Handle error
                        Swal.fire({
                            text: "Terjadi kesalahan!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });
    });

    // Handle delete permanent button
    $('.delete-permanent-item').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            text: "Apakah Anda yakin ingin menghapus permanen auditee ini? Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ya, hapus permanen!",
            cancelButtonText: "Tidak",
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-active-light"
            }
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: `/auditee/${id}/destroy-permanent`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            text: "Auditee berhasil dihapus permanen!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function () {
                            // Reload page
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        // Handle error
                        Swal.fire({
                            text: "Terjadi kesalahan!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });
    });
</script>
@endpush
