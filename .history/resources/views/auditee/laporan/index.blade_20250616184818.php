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
                                <a href="{{ route('auditee.laporan.detail', $penugasanAuditor->id) }}" class="btn btn-primary w-100">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Lihat Detail
                                </a>
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
    <div class="modal fade" id="evaluasiAmiModal" tabindex="-1" aria-labelledby="evaluasiAmiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="evaluasiAmiModalLabel">Cetak Evaluasi AMI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="evaluasiAmiForm" action="{{ route('auditor.audit.evaluasiAmi',[$pengajuan->id]) }}" method="POST">
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
                        <div class="mb-4">
                            <div class="card bg-light-info border-0 mb-10">
                                <div class="card-header min-h-65px py-5 border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <span class="symbol-label bg-primary">
                                                <i class="fas fa-info-circle text-white fs-1"></i>
                                            </span>
                                        </div>
                                        <h3 class="card-title align-items-start flex-column m-0">
                                            <span class="fw-bold fs-2x mb-1 text-dark">Nilai Tingkat Kesuksesan</span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row g-3">
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="bg-white px-4 py-4 rounded-2 shadow-sm">
                                                <span class="text-success fs-2 d-block mb-1 fw-bold">4</span>
                                                <span class="fw-semibold fs-7">Sangat sesuai</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="bg-white px-4 py-4 rounded-2 shadow-sm">
                                                <span class="text-primary fs-2 d-block mb-1 fw-bold">3</span>
                                                <span class="fw-semibold fs-7">Sesuai</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="bg-white px-4 py-4 rounded-2 shadow-sm">
                                                <span class="text-warning fs-2 d-block mb-1 fw-bold">2</span>
                                                <span class="fw-semibold fs-7">Kurang sesuai</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="bg-white px-4 py-4 rounded-2 shadow-sm">
                                                <span class="text-danger fs-2 d-block mb-1 fw-bold">1</span>
                                                <span class="fw-semibold fs-7">Tidak sesuai</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php $questionNumber = 1; @endphp
                            @foreach($evaluasis as $evaluasi)
                                @if($evaluasi->is_nilai)
                                    <div class="card card-bordered shadow-sm mb-8 hover-elevate-up">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-5">
                                                <div class="d-flex align-items-center justify-content-center bg-light-primary rounded-2 min-w-45px min-h-45px me-3">
                                                    <span class="text-primary fw-bolder fs-3">{{ $questionNumber++ }}</span>
                                                </div>
                                                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ $evaluasi->evaluasi }}</label>
                                            </div>
                                            <div class="ms-12">
                                                <div class="row g-2">
                                                    @for($i = 4; $i >= 1; $i--)
                                                        <div class="col-xl-3 col-sm-6">
                                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-4 h-100 {{ isset($evaluasiSubmissions[$evaluasi->id]) && $evaluasiSubmissions[$evaluasi->id]->nilai == $i ? 'active' : '' }}" for="nilai_{{ $evaluasi->id }}_{{ $i }}">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="nilai[{{ $evaluasi->nomor }}]"
                                                                        id="nilai_{{ $evaluasi->id }}_{{ $i }}"
                                                                        value="{{ $i }}"
                                                                        {{ isset($evaluasiSubmissions[$evaluasi->id]) && $evaluasiSubmissions[$evaluasi->id]->nilai == $i ? 'checked' : '' }}>
                                                                </span>
                                                                <span class="ms-4">
                                                                    <span class="fs-4 fw-bolder text-dark d-block">{{ $i }}</span>
                                                                    <span class="fw-semibold fs-7 text-gray-600">
                                                                        @if($i == 4) Sangat sesuai
                                                                        @elseif($i == 3) Sesuai
                                                                        @elseif($i == 2) Kurang sesuai
                                                                        @else Tidak sesuai
                                                                        @endif
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="separator my-10"></div>
                                    <div class="card bg-light border-0 mb-8">
                                        <div class="card-body py-4">
                                            <div class="d-flex align-items-center">
                                                <span class="bullet bullet-vertical h-40px bg-primary me-5"></span>
                                                <h3 class="card-title fw-bolder text-dark fs-2 mb-0">{{ $evaluasi->evaluasi }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    @php $questionNumber = 1; @endphp
                                @endif
                            @endforeach

                            <div class="separator my-10"></div>
                            <div class="card bg-light border-0 mb-8">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-center">
                                        <span class="bullet bullet-vertical h-40px bg-success me-5"></span>
                                        <h3 class="card-title fw-bolder text-dark fs-2 mb-0">Masukan</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-bordered shadow-sm mb-8 hover-elevate-up">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="d-flex align-items-center justify-content-center bg-light-success rounded-2 min-w-45px min-h-45px me-3">
                                            <span class="text-success fw-bolder fs-3">1</span>
                                        </div>
                                        <label for="materi_instrumen" class="form-label fw-bolder text-dark fs-6 mb-0">Materi/instrumen Audit:</label>
                                    </div>
                                    <div class="ms-12">
                                        <textarea class="form-control form-control-lg form-control-solid" id="materi_instrumen" name="materi_instrumen" rows="3" placeholder="Tuliskan materi/instrumen audit disini...">{{ $evaluasiMasukan->materi_instrumen ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-bordered shadow-sm mb-8 hover-elevate-up">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="d-flex align-items-center justify-content-center bg-light-success rounded-2 min-w-45px min-h-45px me-3">
                                            <span class="text-success fw-bolder fs-3">2</span>
                                        </div>
                                        <label for="pelaksanaan_audit" class="form-label fw-bolder text-dark fs-6 mb-0">Pelaksanaan Audit:</label>
                                    </div>
                                    <div class="ms-12">
                                        <textarea class="form-control form-control-lg form-control-solid" id="pelaksanaan_audit" name="pelaksanaan_audit" rows="3" placeholder="Tuliskan pelaksanaan audit disini...">{{ $evaluasiMasukan->pelaksanaan_audit ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-bordered shadow-sm mb-8 hover-elevate-up">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="d-flex align-items-center justify-content-center bg-light-success rounded-2 min-w-45px min-h-45px me-3">
                                            <span class="text-success fw-bolder fs-3">3</span>
                                        </div>
                                        <label for="saran_teraudit" class="form-label fw-bolder text-dark fs-6 mb-0">Saran untuk teraudit:</label>
                                    </div>
                                    <div class="ms-12">
                                        <textarea class="form-control form-control-lg form-control-solid" id="saran_teraudit" name="saran_teraudit" rows="3" placeholder="Tuliskan saran untuk teraudit disini...">{{ $evaluasiMasukan->saran_teraudit ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitEvaluasi">
                            <span class="indicator-label">
                                <i class="fas fa-print me-2"></i> Simpan
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
@endsection
