@extends('dataauditor/dashboard_template')

@section('dashboardProfile')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Desk Evaluation</div>

                    <div class="card-body">
                        @if($dataIkss->isNotEmpty())
                            <form action="{{ route('auditor.submitDeskEvaluation') }}" method="POST" enctype="multipart/form-data" id="formDeskEvaluation">
                                @csrf
                                <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">

                                @foreach ($dataIkss as $ikssAuditee)
                                    <div class="card mb-5">
                                        <div class="card-header bg-light pt-4">
                                            <h4>ID IKSS: {{ $ikssAuditee->instrumen->indikatorKinerja->kode_ikss }} – {{ $ikssAuditee->instrumen->indikatorKinerja->tujuan }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-5">
                                                <input type="hidden" name="ikss_auditee_ids[]" value="{{ $ikssAuditee->id }}">

                                                <h5 class="border-bottom pb-2 mb-4">{{ $ikssAuditee->instrumen->indikator }}</h5>

                                                <div class="mb-4">
                                                    <h6>Referensi</h6>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td width="30%">Indikator Kinerja RSB</td>
                                                                <td>{{ $ikssAuditee->instrumen->indikator }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Sumber data/bukti</td>
                                                                <td>
                                                                    {{ $ikssAuditee->instrumen->sumber }}
                                                                    @if($ikssAuditee->file_sumber)
                                                                        <div class="mb-2">
                                                                            <a href="{{ asset('storage/'.$ikssAuditee->file_sumber) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                                                <i class="fas fa-file-alt"></i> Lihat File Bukti
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Target</td>
                                                                <td>{{ $ikssAuditee->instrumen->target }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Realisasi</td>
                                                                <td>{{ $ikssAuditee->realisasi }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <h6>Pengukuran</h6>
                                                    <h6 class="text-muted fs-7">Akar Penyebab (target tidak tercapai)/ Akar Penunjang (target tercapai)</h6>
                                                    <div class="mb-2">
                                                        <p>{{ $ikssAuditee->akar }}</p>
                                                    </div>

                                                    <div class="mt-3">
                                                        <h6>Penilaian Auditor</h6>
                                                        <textarea class="form-control" name="penilaian_akar[{{ $ikssAuditee->id }}]" rows="4">{{ isset($deskEvaluation[$ikssAuditee->id]) ? $deskEvaluation[$ikssAuditee->id]->penilaian_akar : '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <h6>Rencana Perbaikan dan Tindak lanjut</h6>
                                                    <div class="mb-2">
                                                        <p>{{ $ikssAuditee->rencana }}</p>
                                                    </div>

                                                    <div class="mt-3">
                                                        <h6>Penilaian Auditor</h6>
                                                        <textarea class="form-control" name="penilaian_rencana[{{ $ikssAuditee->id }}]" rows="4">{{ isset($deskEvaluation[$ikssAuditee->id]) ? $deskEvaluation[$ikssAuditee->id]->penilaian_rencana : '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <h6>Indikator Penilaian</h6>
                                                    <div>
                                                        {!! $ikssAuditee->instrumen->penilaian !!}
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <h6>Hasil Penilaian Auditor</h6>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="nilai[{{ $ikssAuditee->id }}]" value="1" id="nilai1_{{ $ikssAuditee->id }}" {{ isset($deskEvaluation[$ikssAuditee->id]) && $deskEvaluation[$ikssAuditee->id]->nilai == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="nilai1_{{ $ikssAuditee->id }}">
                                                            1 - Tidak Memadai
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="nilai[{{ $ikssAuditee->id }}]" value="2" id="nilai2_{{ $ikssAuditee->id }}" {{ isset($deskEvaluation[$ikssAuditee->id]) && $deskEvaluation[$ikssAuditee->id]->nilai == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="nilai2_{{ $ikssAuditee->id }}">
                                                            2 - Kurang Memadai
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="nilai[{{ $ikssAuditee->id }}]" value="3" id="nilai3_{{ $ikssAuditee->id }}" {{ isset($deskEvaluation[$ikssAuditee->id]) && $deskEvaluation[$ikssAuditee->id]->nilai == 3 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="nilai3_{{ $ikssAuditee->id }}">
                                                            3 - Cukup Memadai
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="nilai[{{ $ikssAuditee->id }}]" value="4" id="nilai4_{{ $ikssAuditee->id }}" {{ isset($deskEvaluation[$ikssAuditee->id]) && $deskEvaluation[$ikssAuditee->id]->nilai == 4 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="nilai4_{{ $ikssAuditee->id }}">
                                                            4 - Memadai
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="nilai[{{ $ikssAuditee->id }}]" value="5" id="nilai5_{{ $ikssAuditee->id }}" {{ isset($deskEvaluation[$ikssAuditee->id]) && $deskEvaluation[$ikssAuditee->id]->nilai == 5 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="nilai5_{{ $ikssAuditee->id }}">
                                                            5 - Sangat Memadai
                                                        </label>
                                                    </div>
                                                </div>

                                                <hr class="my-5">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="text-end mb-5 p-3">
                                    <button type="submit" class="btn btn-primary btn-lg">Simpan Evaluasi</button>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-info">
                                Tidak ada data IKSS untuk dievaluasi saat ini.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
