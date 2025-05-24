@extends('auditee/dashboard_template')

@section('dashboardProfile')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-7">
            <!--begin::details View-->
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                            <i class="bi bi-person-check-fill fs-1"></i> Selamat Datang Kaprodi, <span class="fw-bold">{{ Auth::user()->name }}</span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <span class="badge badge-light-primary fs-7 fw-bold">Data Auditee</span>
                    </div>
                </div>
                <!--begin::Card header-->


            </div>
            <!--end::details View-->
        </div>
    </div>
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <!--begin::Card header-->
            <div class="card-header cursor-pointer">
                <div class="card-title m-0">
                    <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                        <i class="bi bi-person-check-fill fs-1"></i> Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <span class="badge badge-light-primary fs-7 fw-bold">Data Auditor</span>
                </div>
            </div>
            <!--begin::Card header-->
            <!--begin::Card body-->

            <!--end::Card body-->
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#kt_account_profile_details_form').submit(function(event) {
                event.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Jika berhasil
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Profil berhasil diperbarui!',
                            }).then(() => {
                                window.location.href = response.redirect_url;
                            });
                        } else {
                            // Handle jika sukses
                            console.log(response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '';

                            // Menyusun pesan error dengan pembatas halus antar pesan
                            $.each(errors, function(field, messages) {
                                $.each(messages, function(index, message) {
                                    errorMessage += `<div style="font-size: 16px; color: #ff0000; margin-bottom: 10px;">
                                                        ${message}
                                                    </div>
                                                    <hr style="border-top: 1px solid #ff0000; margin-top: 5px; margin-bottom: 5px;">`;
                                });
                            });

                            // Menampilkan SweetAlert dengan pesan error yang lebih rapi
                            Swal.fire({
                                icon: 'error',
                                title: 'Terdapat Kesalahan!',
                                html: errorMessage, // Menggunakan HTML untuk menampilkan pesan
                                confirmButtonText: 'Perbaiki'
                            });
                        } else {
                            // Error lain (misalnya masalah koneksi)
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan!',
                                text: 'Ada masalah dalam pengiriman data. Silakan coba lagi.',
                                confirmButtonText: 'Tutup'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
