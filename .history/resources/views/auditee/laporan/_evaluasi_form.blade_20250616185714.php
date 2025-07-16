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
                                                name="nilai[{{ $evaluasi->id }}]"
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
