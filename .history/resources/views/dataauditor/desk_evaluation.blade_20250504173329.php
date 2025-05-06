@extends('dataauditor/dashboard_template')

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
        <!--begin::Card header-->
        <div class="flex-lg-row-fluid ms-lg-15">
            <div class="d-flex flex-wrap mb-8">
                <h2 class="fw-bold text-dark me-5 my-2">📋 Instrumen Kinerja Satuan/Sistem (IKSS)</h2>
                <ul class="nav nav-pills nav-line-pills border-0 fs-5 fw-semibold flex-nowrap overflow-auto">
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ikss_tab" role="tabpanel">
                    <div class="timeline timeline-border-dashed">
                        @if($dataIkssProdi->isNotEmpty())
                            <form action="{{ route('auditee.submitAllInstrumen') }}" method="POST" enctype="multipart/form-data" id="formInstrumen">
                                @csrf
                                <input type="hidden" name="periode_id" value="{{ $periodeAktif->id }}">

                                @foreach ($dataIkssProdi as $unit)
                                    @foreach ($unit->indikatorKinerjas as $indikator)
                                        @if($indikator->instrumen->isNotEmpty())
                                            <div class="card mb-5">
                                                <div class="card-header bg-light pt-8">
                                                    <h4>ID IKSS: {{ $indikator->kode_ikss }} – {{ $indikator->tujuan }}</h4>
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($indikator->instrumen as $instrumen)
                                                        <div class="mb-5">
                                                            <input type="hidden" name="instrumen_ids[]" value="{{ $instrumen->id }}">

                                                            <h5 class="border-bottom pb-2 mb-4">{{ $loop->iteration }}. {{ $instrumen->indikator }}</h5>

                                                            <div class="mb-4">
                                                                <h6>Referensi</h6>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <td width="30%">Indikator Kinerja RSB</td>
                                                                            <td>{{ $instrumen->indikator }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Sumber data/bukti</td>
                                                                            <td>
                                                                                {{ $instrumen->sumber }}
                                                                                @if(isset($ikssAuditeeData[$instrumen->id]) && $ikssAuditeeData[$instrumen->id]->file_sumber)
                                                                                    <div class="mb-2">
                                                                                        <a href="{{ asset('storage/'.$ikssAuditeeData[$instrumen->id]->file_sumber) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                                                            <i class="fas fa-file-alt"></i> Lihat File Bukti
                                                                                        </a>
                                                                                    </div>
                                                                                @endif

                                                                                <div class="mt-2">
                                                                                    <input type="file" name="bukti_file[{{ $instrumen->id }}]" class="form-control" id="buktiFile_{{ $instrumen->id }}">
                                                                                    <div class="form-text">Upload file bukti disini</div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Target</td>
                                                                            <td>{{ $instrumen->target }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Realisasi</td>
                                                                            <td>
                                                                                <input type="text" class="form-control" name="realisasi[{{ $instrumen->id }}]"
                                                                                    value="{{ isset($ikssAuditeeData[$instrumen->id]) ? $ikssAuditeeData[$instrumen->id]->realisasi : '' }}"
                                                                                    placeholder="Isi disini...">
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h6>Pengukuran</h6>
                                                                <h6 class="text-muted fs-7">Akar Penyebab (target tidak tercapai)/ Akar Penunjang (target tercapai)</h6>
                                                                <textarea class="form-control" name="akar_penyebab[{{ $instrumen->id }}]" rows="4">{{ isset($ikssAuditeeData[$instrumen->id]) ? $ikssAuditeeData[$instrumen->id]->akar : '' }}</textarea>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h6>Rencana Perbaikan dan Tindak lanjut</h6>
                                                                <textarea class="form-control" name="rencana_perbaikan[{{ $instrumen->id }}]" rows="4">{{ isset($ikssAuditeeData[$instrumen->id]) ? $ikssAuditeeData[$instrumen->id]->rencana : '' }}</textarea>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h6>Indikator Penilaian</h6>
                                                                <div>
                                                                    {!! $instrumen->penilaian !!}
                                                                </div>
                                                            </div>

                                                            <hr class="my-5">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach

                            @if (!$ikssAuditeeData->isNotEmpty())

                                <div class="text-end mb-5 p-5">
                                    <button type="submit" class="btn btn-primary btn-lg">Simpan Semua</button>
                                </div>
                            @endif
                            </form>
                        @else
                            <div class="alert alert-info">
                                Tidak ada instrumen yang perlu diisi saat ini.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::details View-->
@endsection
