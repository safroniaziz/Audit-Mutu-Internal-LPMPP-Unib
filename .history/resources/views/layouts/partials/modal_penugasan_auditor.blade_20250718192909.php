<!--begin::Modal - Penugasan Auditor-->
<div class="modal fade" id="modalPenugasanAuditor" tabindex="-1" aria-labelledby="modalPenugasanAuditorLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <h3 class="modal-title" id="modalPenugasanAuditorLabel">
                    <i class="fas fa-user-plus fs-2 text-primary me-2"></i>
                    Penugasan Tim Auditor
                </h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times fs-1"></i>
                </div>
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-lg-10 px-lg-10">
                <form id="formPenugasanAuditor">
                    <input type="hidden" id="pengajuan_ami_id" name="pengajuan_ami_id">

                    <!--begin::Ketua Auditor-->
                    <div class="mb-8">
                        <label for="auditor1" class="form-label fw-bold fs-6 text-gray-700">
                            <i class="fas fa-user-tie fs-2 text-danger me-2"></i>
                            Ketua Auditor <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-select-solid" id="auditor1" name="auditor1" required>
                            <option value="">Pilih Ketua Auditor</option>
                        </select>
                        <div class="form-text text-muted">Ketua auditor bertanggung jawab atas keseluruhan proses audit</div>
                    </div>
                    <!--end::Ketua Auditor-->

                    <!--begin::Anggota Auditor-->
                    <div class="mb-8">
                        <label for="auditor2" class="form-label fw-bold fs-6 text-gray-700">
                            <i class="fas fa-user fs-2 text-info me-2"></i>
                            Anggota Auditor <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-select-solid" id="auditor2" name="auditor2" required>
                            <option value="">Pilih Anggota Auditor</option>
                        </select>
                        <div class="form-text text-muted">Anggota auditor membantu ketua dalam pelaksanaan audit</div>
                    </div>
                    <!--end::Anggota Auditor-->

                    <!--begin::Anggota Kedua (Opsional)-->
                    <div class="mb-8">
                        <label for="auditor3" class="form-label fw-bold fs-6 text-gray-700">
                            <i class="fas fa-user fs-2 text-success me-2"></i>
                            Anggota Kedua <span class="text-muted">(Opsional)</span>
                        </label>
                        <select class="form-select form-select-solid" id="auditor3" name="auditor3">
                            <option value="">Pilih Anggota Kedua (Opsional)</option>
                        </select>
                        <div class="form-text text-muted">Anggota kedua dapat ditambahkan jika diperlukan untuk audit yang kompleks</div>
                    </div>
                    <!--end::Anggota Kedua (Opsional)-->

                    <!--begin::Waktu Visitasi-->
                    <div class="mb-8">
                        <label for="waktu_visitasi" class="form-label fw-bold fs-6 text-gray-700">
                            <i class="fas fa-calendar fs-2 text-warning me-2"></i>
                            Waktu Visitasi
                        </label>
                        <input type="datetime-local" class="form-control form-control-solid" id="waktu_visitasi" name="waktu_visitasi">
                        <div class="form-text text-muted">Jadwalkan waktu visitasi audit (opsional)</div>
                    </div>
                    <!--end::Waktu Visitasi-->

                    <!--begin::Info Alert-->
                    <div class="alert alert-info d-flex align-items-center p-5">
                        <i class="fas fa-info-circle fs-2hx text-info me-4"></i>
                        <div class="d-flex flex-column">
                            <h5 class="mb-1 text-info">Penting!</h5>
                            <span>Pastikan ketua auditor dan minimal satu anggota auditor telah dipilih sebelum menyimpan penugasan.</span>
                        </div>
                    </div>
                    <!--end::Info Alert-->
                </form>
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="fas fa-times fs-2 me-1"></i>
                    Batal
                </button>
                <button type="button" class="btn btn-primary" id="btnSimpanPenugasan">
                    <i class="fas fa-check fs-2 me-1"></i>
                    Simpan Penugasan
                </button>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<!--end::Modal - Penugasan Auditor-->
