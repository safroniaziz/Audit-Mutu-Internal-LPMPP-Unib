@extends('dataauditor/dashboard_template')

@section('dashboardProfile')
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer bg-light">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-primary d-flex align-items-center gap-2">
                    <i class="bi bi-person-check-fill me-1"></i> Selamat Datang, <span class="fw-bolder">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <form id="kt_account_profile_details_form_2" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <div class="alert alert-info d-flex align-items-center p-5 position-relative border border-info border-dashed bg-light-info rounded-3">
                    <div class="d-flex align-items-center justify-content-center bg-info text-white rounded-circle p-3 me-4" style="width: 40px; height: 40px;">
                        <i class="bi bi-info-circle-fill fs-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bolder text-dark mb-3"><i class="bi bi-megaphone-fill me-2"></i>Proses Selanjutnya: Unduh Dokumen Audit</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mb-2">
                                <strong class="text-dark">Catatan:</strong>
                                <span class="fw-semibold text-primary">
                                    Silakan unduh dokumen hasil audit di bawah ini. Pastikan Anda telah memeriksa isi dokumen dan memastikan kesesuaiannya.
                                </span>
                            </p>
                        </div>
                    </div>
                    @php
                        $user = Auth::user();
                        $completionPercentage = $user->getProfileCompletionPercentage();
                    @endphp
                </div>

                <!--begin::Input group-->
                <div class="row mb-6 mt-6">
                    <div class="col-12">
                        <div class="card border-0">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-row-dashed fs-6 gy-4 mb-0">
                                        <thead>
                                            <tr class="fw-bold text-gray-800 bg-light border-bottom border-gray-300">
                                                <th class="ps-4 min-w-200px">Nama Dokumen</th>
                                                <th class="text-end pe-4">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-bottom border-gray-200 hover-bg-light">
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-file-alt text-primary me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">Berita Acara</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#beritaAcaraModal">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom border-gray-200 hover-bg-light">
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-clipboard-check text-success me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <button type="button" class="btn btn-sm btn-primary px-4" data-bs-toggle="modal" data-bs-target="#evaluasiAmiModal">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom border-gray-200 hover-bg-light">
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-list-ul text-warning me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">Daftar Pertanyaan</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <a href="{{ route('auditor.audit.daftarPertanyaan',[$pengajuan->id]) }}" class="btn btn-sm btn-primary px-4">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="hover-bg-light">
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-file-signature text-danger me-3 fs-4"></i>
                                                        <span class="fw-semibold text-gray-800">Laporan Audit Mutu Internal</span>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <a href="{{ route('auditor.audit.laporanAmi',[$pengajuan->id]) }}" class="btn btn-sm btn-primary px-4">
                                                        <i class="fas fa-print me-2"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->
            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::details View-->

    <!-- Modal Berita Acara -->
    <div class="modal fade" id="beritaAcaraModal" tabindex="-1" aria-labelledby="beritaAcaraModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="beritaAcaraModalLabel">Cetak Berita Acara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('auditor.audit.beritaAcara',[$pengajuan->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="catatan_visitasi" class="form-label fw-bold">Tuliskan catatan Visitasi disini</label>
                            <textarea class="form-control" id="catatan_visitasi" name="catatan_visitasi" rows="5" placeholder="Isi catatan visitasi disini..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-print me-2"></i> Cetak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Evaluasi AMI -->
    <div class="modal fade" id="evaluasiAmiModal" tabindex="-1" aria-labelledby="evaluasiAmiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="evaluasiAmiModalLabel">Cetak Evaluasi AMI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('auditor.audit.evaluasiAmi',[$pengajuan->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <h6 class="fw-bold">Nilai Tingkat Kesuksesan</h6>
                            <ul class="list-unstyled text-muted small ms-2">
                                <li>1 : Sangat sesuai</li>
                                <li>2 : Sesuai</li>
                                <li>3 : Kurang sesuai</li>
                                <li>4 : Tidak sesuai</li>
                            </ul>
                        </div>

                        <div class="card mb-4 border-0 bg-light-primary">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tujuan pengembangan audit bermanfaat bagi pengembangan mutu institusi</label>
                                    <div class="d-flex gap-3 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tujuan_pengembangan" id="tujuan1" value="1">
                                            <label class="form-check-label" for="tujuan1">1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tujuan_pengembangan" id="tujuan2" value="2">
                                            <label class="form-check-label" for="tujuan2">2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tujuan_pengembangan" id="tujuan3" value="3">
                                            <label class="form-check-label" for="tujuan3">3</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tujuan_pengembangan" id="tujuan4" value="4">
                                            <label class="form-check-label" for="tujuan4">4</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Lingkup audit bermanfaat bagi mengembangkan mutu institusi</label>
                                    <div class="d-flex gap-3 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lingkup_audit" id="lingkup1" value="1">
                                            <label class="form-check-label" for="lingkup1">1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lingkup_audit" id="lingkup2" value="2">
                                            <label class="form-check-label" for="lingkup2">2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lingkup_audit" id="lingkup3" value="3">
                                            <label class="form-check-label" for="lingkup3">3</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lingkup_audit" id="lingkup4" value="4">
                                            <label class="form-check-label" for="lingkup4">4</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Materi/instrumen audit mendukung tercapainya tujuan audit</label>
                                    <div class="d-flex gap-3 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_tujuan" id="materi1" value="1">
                                            <label class="form-check-label" for="materi1">1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_tujuan" id="materi2" value="2">
                                            <label class="form-check-label" for="materi2">2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_tujuan" id="materi3" value="3">
                                            <label class="form-check-label" for="materi3">3</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_tujuan" id="materi4" value="4">
                                            <label class="form-check-label" for="materi4">4</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Materi/instrumen audit mudah dipahami oleh auditor</label>
                                    <div class="d-flex gap-3 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_dipahami" id="dipahami1" value="1">
                                            <label class="form-check-label" for="dipahami1">1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_dipahami" id="dipahami2" value="2">
                                            <label class="form-check-label" for="dipahami2">2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_dipahami" id="dipahami3" value="3">
                                            <label class="form-check-label" for="dipahami3">3</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_dipahami" id="dipahami4" value="4">
                                            <label class="form-check-label" for="dipahami4">4</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Materi/instrumen audit mudah disiapkan oleh auditor</label>
                                    <div class="d-flex gap-3 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_disiapkan" id="disiapkan1" value="1">
                                            <label class="form-check-label" for="disiapkan1">1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_disiapkan" id="disiapkan2" value="2">
                                            <label class="form-check-label" for="disiapkan2">2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_disiapkan" id="disiapkan3" value="3">
                                            <label class="form-check-label" for="disiapkan3">3</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="materi_disiapkan" id="disiapkan4" value="4">
                                            <label class="form-check-label" for="disiapkan4">4</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Teknik pelaksanaan audit mendukung tercapainya tujuan audit</label>
                                    <div class="d-flex gap-3 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="teknik_audit" id="teknik1" value="1">
                                            <label class="form-check-label" for="teknik1">1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="teknik_audit" id="teknik2" value="2">
                                            <label class="form-check-label" for="teknik2">2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="teknik_audit" id="teknik3" value="3">
                                            <label class="form-check-label" for="teknik3">3</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="teknik_audit" id="teknik4" value="4">
                                            <label class="form-check-label" for="teknik4">4</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Waktu pelaksanaan audit sesuai kebutuhan</label>
                                    <div class="d-flex gap-3 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="waktu_audit" id="waktu1" value="1">
                                            <label class="form-check-label" for="waktu1">1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="waktu_audit" id="waktu2" value="2">
                                            <label class="form-check-label" for="waktu2">2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="waktu_audit" id="waktu3" value="3">
                                            <label class="form-check-label" for="waktu3">3</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="waktu_audit" id="waktu4" value="4">
                                            <label class="form-check-label" for="waktu4">4</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold">Kinerja Teraudit:</h6>

                            <div class="card mb-3 border-0 bg-light-warning">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">a. Obyektif</label>
                                        <div class="d-flex gap-3 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="obyektif" id="obyektif1" value="1">
                                                <label class="form-check-label" for="obyektif1">1</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="obyektif" id="obyektif2" value="2">
                                                <label class="form-check-label" for="obyektif2">2</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="obyektif" id="obyektif3" value="3">
                                                <label class="form-check-label" for="obyektif3">3</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="obyektif" id="obyektif4" value="4">
                                                <label class="form-check-label" for="obyektif4">4</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">b. Komunikatif</label>
                                        <div class="d-flex gap-3 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="komunikatif" id="komunikatif1" value="1">
                                                <label class="form-check-label" for="komunikatif1">1</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="komunikatif" id="komunikatif2" value="2">
                                                <label class="form-check-label" for="komunikatif2">2</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="komunikatif" id="komunikatif3" value="3">
                                                <label class="form-check-label" for="komunikatif3">3</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="komunikatif" id="komunikatif4" value="4">
                                                <label class="form-check-label" for="komunikatif4">4</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">c. Terbuka</label>
                                        <div class="d-flex gap-3 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="terbuka" id="terbuka1" value="1">
                                                <label class="form-check-label" for="terbuka1">1</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="terbuka" id="terbuka2" value="2">
                                                <label class="form-check-label" for="terbuka2">2</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="terbuka" id="terbuka3" value="3">
                                                <label class="form-check-label" for="terbuka3">3</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="terbuka" id="terbuka4" value="4">
                                                <label class="form-check-label" for="terbuka4">4</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">d. Profesional</label>
                                        <div class="d-flex gap-3 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profesional" id="profesional1" value="1">
                                                <label class="form-check-label" for="profesional1">1</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profesional" id="profesional2" value="2">
                                                <label class="form-check-label" for="profesional2">2</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profesional" id="profesional3" value="3">
                                                <label class="form-check-label" for="profesional3">3</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profesional" id="profesional4" value="4">
                                                <label class="form-check-label" for="profesional4">4</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold">Masukan</h6>

                            <div class="mb-3">
                                <label for="materi_instrumen" class="form-label">1. Materi/instrumen Audit:</label>
                                <textarea class="form-control" id="materi_instrumen" name="materi_instrumen" rows="3" placeholder="Isi disini..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="pelaksanaan_audit" class="form-label">2. Pelaksanaan Audit:</label>
                                <textarea class="form-control" id="pelaksanaan_audit" name="pelaksanaan_audit" rows="3" placeholder="Isi disini..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="saran_teraudit" class="form-label">3. Saran untuk teraudit:</label>
                                <textarea class="form-control" id="saran_teraudit" name="saran_teraudit" rows="3" placeholder="Isi disini..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-print me-2"></i> Cetak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="laporanAmiModal" tabindex="-1" aria-labelledby="laporanAmiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="laporanAmiModalLabel">Cetak </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('auditor.audit.beritaAcara',[$pengajuan->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="catatan_visitasi" class="form-label fw-bold">Tuliskan catatan Visitasi disini</label>
                            <textarea class="form-control" id="catatan_visitasi" name="catatan_visitasi" rows="5" placeholder="Isi catatan visitasi disini..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-print me-2"></i> Cetak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Script untuk handle form submission
    document.addEventListener('DOMContentLoaded', function() {
        // Berita Acara Form
        // const beritaAcaraForm = document.querySelector('#beritaAcaraModal form');
        // if (beritaAcaraForm) {
        //     beritaAcaraForm.addEventListener('submit', function(e) {
        //         e.preventDefault();
        //         const formData = new FormData(this);

        //         fetch(this.action, {
        //             method: 'POST',
        //             body: formData,
        //             headers: {
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //             }
        //         })
        //         .then(response => response.blob())
        //         .then(blob => {
        //             // Tutup modal
        //             const beritaAcaraModal = bootstrap.Modal.getInstance(document.getElementById('beritaAcaraModal'));
        //             beritaAcaraModal.hide();

        //             // Download file
        //             const url = window.URL.createObjectURL(blob);
        //             const a = document.createElement('a');
        //             a.href = url;
        //             a.download = 'BeritaAcara.pdf';
        //             document.body.appendChild(a);
        //             a.click();
        //             a.remove();
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //             alert('Terjadi kesalahan saat mencetak dokumen');
        //         });
        //     });
        // }

        const evaluasiAmiForm = document.querySelector('#evaluasiAmiForm');
        if (evaluasiAmiForm) {
            evaluasiAmiForm.addEventListener('submit', function(e) {
                if (!validateForm(this)) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Scroll to the first error
                    const firstError = this.querySelector('.is-invalid, .text-danger');
                    if (firstError) {
                        firstError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });
        }

        // Add real-time validation for textareas
        document.querySelectorAll('textarea[required]').forEach(textarea => {
            textarea.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                } else {
                    this.classList.add('is-invalid');
                }
            });
        });

        // Add real-time validation for radio groups
        document.querySelectorAll('.form-check-input[required]').forEach(radio => {
            radio.addEventListener('change', function() {
                const name = this.name;
                const container = this.closest('.mb-3');
                const errorMsg = container.querySelector('.text-danger');

                if (document.querySelector(`input[name="${name}"]:checked`)) {
                    if (errorMsg) {
                        errorMsg.remove();
                    }
                }
            });
        });
    });
</script>
