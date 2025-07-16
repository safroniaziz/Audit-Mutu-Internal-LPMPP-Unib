@extends('auditee/dashboard_template')
@section('dashboardProfile')
    <div class="card mb-5 mb-xl-10">
        <div class="card-body p-9">
            <!--begin::Alert-->
            <div class="alert alert-primary d-flex align-items-center p-5 mb-10">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                    <i class="fas fa-file-alt fs-2x text-primary"></i>
                </span>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <!--begin::Title-->
                    <h4 class="mb-1 text-dark">Dokumen Hasil Audit Mutu Internal</h4>
                    <!--end::Title-->

                    <!--begin::Content-->
                    <span class="text-gray-700 fw-semibold">Berikut adalah daftar dokumen hasil audit mutu internal yang telah selesai dilakukan. Anda dapat melihat detail hasil audit untuk setiap unit kerja.</span>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Alert-->

            <div class="row g-5 g-xl-8">
                @forelse ($penugasanAuditors as $penugasanAuditor)
                    <div class="col-xl-4">
                        <div class="card card-xl-stretch mb-xl-8 shadow-sm hover-elevate-up">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <div class="card-title d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="fas fa-building fs-2x text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold fs-4">{{ $penugasanAuditor->auditee->jenjang  . ' ' . $penugasanAuditor->auditee->nama_unit_kerja }}</span>
                                            <span class="text-muted fw-semibold mt-1">
                                                <i class="fas fa-file-signature text-primary me-2"></i>
                                                {{ $penugasanAuditor->periodeAktif->nomor_surat }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <!--begin::Info-->
                                <div class="d-flex flex-column mb-7">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="symbol symbol-35px me-3">
                                            <span class="symbol-label bg-light-info">
                                                <i class="fas fa-calendar-alt text-info"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-7">Tahun AMI</span>
                                            <span class="fw-bold fs-6">{{ $penugasanAuditor->periodeAktif->tahun_ami }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-35px me-3">
                                            <span class="symbol-label bg-light-success">
                                                <i class="fas fa-sync-alt text-success"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-7">Siklus</span>
                                            <span class="fw-bold fs-6">{{ $penugasanAuditor->periodeAktif->siklus }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Info-->

                                <!--begin::Unit Info-->
                                <div class="separator separator-dashed my-4"></div>
                                <div class="d-flex flex-column mb-7">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="symbol symbol-35px me-3">
                                            <span class="symbol-label bg-light-warning">
                                                <i class="fas fa-graduation-cap text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-7">Jenjang</span>
                                            <span class="fw-bold fs-6">{{ $penugasanAuditor->auditee->jenjang }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-35px me-3">
                                            <span class="symbol-label bg-light-danger">
                                                <i class="fas fa-university text-danger"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-muted fw-semibold fs-7">Fakultas</span>
                                            <span class="fw-bold fs-6">{{ $penugasanAuditor->auditee->fakultas ?: '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Unit Info-->

                                <!--begin::Auditors-->
                                <div class="separator separator-dashed my-4"></div>
                                <div class="d-flex flex-column">
                                    <span class="text-muted fw-semibold fs-7 mb-3">Tim Auditor</span>
                                    @forelse ($penugasanAuditor->auditors as $auditor)
                                        @php
                                            $sudahNilai = false;
                                            foreach ($penugasanAuditor->ikssAuditee ?? [] as $ikss) {
                                                if (collect($ikss->nilai)->where('auditor_id', $auditor->user_id)->isNotEmpty()) {
                                                    $sudahNilai = true;
                                                    break;
                                                }
                                            }
                                        @endphp

                                        <div class="d-flex align-items-center mb-5">
                                            <div class="symbol symbol-40px me-4">
                                                @if($auditor->auditor->foto)
                                                    <img src="{{ Storage::url($auditor->auditor->foto) }}" alt="{{ $auditor->auditor->name }}" class="rounded-circle" />
                                                @else
                                                    <span class="symbol-label bg-light-primary">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1">
                                                <span class="text-dark fw-bold">{{ $auditor->auditor->name }}</span>
                                                <span class="text-muted fw-semibold">{{ str_replace('_', ' ', $auditor->role) }}</span>
                                            </div>
                                            @if ($sudahNilai)
                                                <span class="badge badge-light-success">Selesai</span>
                                            @else
                                                <span class="badge badge-light-warning">Dalam Proses</span>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="text-muted fst-italic">Belum ada auditor yang ditugaskan</div>
                                    @endforelse
                                </div>
                                <!--end::Auditors-->
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('auditee.laporan.detail', $penugasanAuditor->id) }}" class="btn btn-primary flex-grow-1">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Lihat Detail
                                    </a>
                                    <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#evaluasiAmiModal" data-pengajuan-id="{{ $penugasanAuditor->id }}">
                                        <i class="fas fa-clipboard-check me-2"></i>
                                        Evaluasi
                                    </button>
                                </div>
                            </div>
                            <!--end::Footer-->
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card card-custom">
                            <div class="card-body text-center p-10">
                                <i class="fas fa-folder-open fs-3x text-gray-400 mb-5"></i>
                                <h4 class="text-gray-800 mb-2">Belum ada data</h4>
                                <p class="text-gray-600">Data audit akan muncul di sini</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="evaluasiAmiModal" tabindex="-1" aria-labelledby="evaluasiAmiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="evaluasiAmiModalLabel">Evaluasi AMI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="evaluasiAmiForm" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert bg-light-primary border border-primary border-dashed rounded-3 p-5 mb-10">
                            <div class="d-flex align-items-center">
                                <i class="ki-duotone ki-information-5 fs-2hx text-primary me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark">Petunjuk Pengisian:</h4>
                                    <ul class="list-unstyled text-gray-600 fs-6 mb-0">
                                        <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Bacalah setiap pertanyaan dengan teliti</li>
                                        <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Pilih salah satu jawaban yang paling sesuai untuk setiap pertanyaan</li>
                                        <li class="mb-1"><i class="fas fa-check text-primary me-2"></i>Pastikan semua pertanyaan telah dijawab sebelum menyimpan</li>
                                        <li><i class="fas fa-check text-primary me-2"></i>Klik tombol "Simpan" setelah selesai mengisi semua pertanyaan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div id="evaluasiContent">
                            <!-- Content will be loaded here -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitEvaluasi">
                            <span class="indicator-label">
                                <i class="fas fa-save me-2"></i> Simpan
                            </span>
                            <span class="indicator-progress">
                                Mohon tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->
@endsection

@push('scripts')
<script>
    // Handle modal open
    $('#evaluasiAmiModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var pengajuanId = button.data('pengajuan-id');
        var modal = $(this);

        // Update form action
        modal.find('#evaluasiAmiForm').attr('action', `/auditee/laporan/${pengajuanId}/evaluasi`);

        // Show loading state
        modal.find('#evaluasiContent').html(`
            <div class="d-flex justify-content-center py-10">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `);

        // Load evaluasi content
        $.get(`/auditee/laporan/${pengajuanId}/evaluasi/form`, function(response) {
            modal.find('#evaluasiContent').html(response);
        });
    });

    // Handle form submit
    $('#evaluasiAmiForm').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var submitBtn = form.find('#submitEvaluasi');

        // Show loading state
        submitBtn.attr('data-kt-indicator', 'on');
        submitBtn.prop('disabled', true);

        // Submit form
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                // Show success message
                Swal.fire({
                    text: "Evaluasi berhasil disimpan!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {
                    // Close modal and reload page
                    $('#evaluasiAmiModal').modal('hide');
                    location.reload();
                });
            },
            error: function(xhr) {
                // Show error message
                Swal.fire({
                    text: xhr.responseJSON?.message || "Terjadi kesalahan saat menyimpan evaluasi",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            },
            complete: function() {
                // Hide loading state
                submitBtn.removeAttr('data-kt-indicator');
                submitBtn.prop('disabled', false);
            }
        });
    });
</script>
@endpush
