@extends('auditee/dashboard_template')
@push('styles')
    <style>
        /* Add these styles to your CSS file */
        .form-disabled {
            position: relative;
            opacity: 0.85;
            pointer-events: none;
        }

        .form-disabled input[type="radio"],
        .form-disabled button {
            cursor: not-allowed;
        }

        /* Style for the already submitted notice */
        .notice {
            border-left: 4px solid #FFA800 !important;
        }
    </style>
@endpush
@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
                </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                <div class="me-4">
                    <i class="bi bi-info-circle-fill fs-2 text-primary"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">📢 Informasi Penting</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>Catatan:</strong>
                            <span class="text-gray-800">
                                Silakan unggah siklus AMI di bawah ini secara menyeluruh
                                untuk menyelesaikan proses pengajuan <strong>Instrumen Audit</strong>.
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">
            <div class="d-flex flex-wrap mb-8">
                <ul class="nav nav-pills nav-line-pills border-0 fs-5 fw-semibold flex-nowrap overflow-auto">
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ikss_tab" role="tabpanel">
                    <div class="timeline timeline-border-dashed">
                        <form id="formPemilihanIkss" action="{{ route('auditee.saveIkss') }}" method="POST">
                            @csrf
                            <input type="hidden" name="auditee_id" value="{{ Auth::user()->unit_kerja_id }}">


                            <div class="d-flex justify-content-end p-5">
                                <button type="submit" class="btn btn-primary">Unggah File</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--end::details View-->
@endsection

@push('scripts')
    <script>
    </script>
@endpush
