@extends('dataauditor/dashboard_template')

@section('dashboardProfile')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Desk Evaluation - Pengajuan AMI</h4>
                        <p class="text-muted">Auditee: {{ $pengajuan->auditee->nama }}</p>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($dataIkss->isNotEmpty())
                            <form action="{{ route('auditor.audit.submitDeskEvaluation') }}" method="POST" enctype="multipart/form-data" id="formDeskEvaluation">
                                @csrf
                                <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">

                                @foreach ($dataIkss as $ikssAuditee)
                                    @php
                                        $hasEvaluation = isset($deskEvaluation[$ikssAuditee->id]);
                                    @endphp

                                    <div class="card mb-5 {{ $hasEvaluation ? 'border-success' : '' }}">
                                        <div class="card-header {{ $hasEvaluation ? 'bg-success-subtle' : 'bg-light' }} pt-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4>ID IKSS: {{ $ikssAuditee->instrumen->indikatorKinerja->kode_ikss }} – {{ $ikssAuditee->instrumen->indikatorKinerja->tujuan }}</h4>
                                                @if($hasEvaluation)
                                                    <span class="badge bg-success">Sudah Dievaluasi</span>
                                                @endif
                                            </div>
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
                                                    <div class="p-3 bg-light mb-3 rounded">
                                                        <p>{{ $ikssAuditee->akar }}</p>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <h6>Rencana Perbaikan dan Tindak lanjut</h6>
                                                    <div class="p-3 bg-light mb-3 rounded">
                                                        <p>{{ $ikssAuditee->rencana }}</p>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <h6>Indikator Penilaian</h6>
                                                    <div class="p-3 bg-light rounded">
                                                        {!! $ikssAuditee->instrumen->penilaian !!}
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    @if(!$hasEvaluation)
                                                    <div class="mt-3">
                                                        <h6>Penilaian Auditor</h6>
                                                        <textarea class="form-control" name="penilaian_rencana[{{ $ikssAuditee->id }}]" rows="4" {{ $hasEvaluation ? 'disabled' : '' }}>{{ $hasEvaluation ? $deskEvaluation[$ikssAuditee->id]->penilaian_rencana : '' }}</textarea>
                                                    </div>
                                                @else
                                                    <div class="mt-3">
                                                        <h6>Penilaian Auditor</h6>
                                                        <div class="p-3 border rounded">
                                                            <p>{{ $deskEvaluation[$ikssAuditee->id]->penilaian_rencana }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!$hasEvaluation)
                                                    <div class="mt-3">
                                                        <h6>Penilaian Auditor</h6>
                                                        <textarea class="form-control" name="penilaian_akar[{{ $ikssAuditee->id }}]" rows="4" {{ $hasEvaluation ? 'disabled' : '' }}>{{ $hasEvaluation ? $deskEvaluation[$ikssAuditee->id]->penilaian_akar : '' }}</textarea>
                                                    </div>
                                                @else
                                                    <div class="mt-3">
                                                        <h6>Penilaian Auditor</h6>
                                                        <div class="p-3 border rounded">
                                                            <p>{{ $deskEvaluation[$ikssAuditee->id]->penilaian_akar }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!$hasEvaluation)
                                                    <div class="mb-4">
                                                        <h6>Hasil Penilaian Auditor</h6>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nilai[{{ $ikssAuditee->id }}]" value="1" id="nilai1_{{ $ikssAuditee->id }}" required>
                                                            <label class="form-check-label" for="nilai1_{{ $ikssAuditee->id }}">
                                                                1 - Tidak Memadai
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nilai[{{ $ikssAuditee->id }}]" value="2" id="nilai2_{{ $ikssAuditee->id }}">
                                                            <label class="form-check-label" for="nilai2_{{ $ikssAuditee->id }}">
                                                                2 - Kurang Memadai
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nilai[{{ $ikssAuditee->id }}]" value="3" id="nilai3_{{ $ikssAuditee->id }}">
                                                            <label class="form-check-label" for="nilai3_{{ $ikssAuditee->id }}">
                                                                3 - Cukup Memadai
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nilai[{{ $ikssAuditee->id }}]" value="4" id="nilai4_{{ $ikssAuditee->id }}">
                                                            <label class="form-check-label" for="nilai4_{{ $ikssAuditee->id }}">
                                                                4 - Memadai
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nilai[{{ $ikssAuditee->id }}]" value="5" id="nilai5_{{ $ikssAuditee->id }}">
                                                            <label class="form-check-label" for="nilai5_{{ $ikssAuditee->id }}">
                                                                5 - Sangat Memadai
                                                            </label>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="mb-4">
                                                        <h6>Hasil Penilaian Auditor</h6>
                                                        <div class="p-3 border rounded">
                                                            <h3 class="text-center">{{ $deskEvaluation[$ikssAuditee->id]->nilai }} / 5</h3>
                                                            <p class="text-center mb-0">
                                                                @switch($deskEvaluation[$ikssAuditee->id]->nilai)
                                                                    @case(1)
                                                                        <span class="badge bg-danger">Tidak Memadai</span>
                                                                        @break
                                                                    @case(2)
                                                                        <span class="badge bg-warning">Kurang Memadai</span>
                                                                        @break
                                                                    @case(3)
                                                                        <span class="badge bg-info">Cukup Memadai</span>
                                                                        @break
                                                                    @case(4)
                                                                        <span class="badge bg-primary">Memadai</span>
                                                                        @break
                                                                    @case(5)
                                                                        <span class="badge bg-success">Sangat Memadai</span>
                                                                        @break
                                                                @endswitch
                                                            </p>
                                                        </div>
                                                    </div>


                                                    </div>
                                                @endif

                                                <hr class="my-5">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Only show submit button if there are items that haven't been evaluated -->
                                @if($dataIkss->count() > $deskEvaluation->count())
                                    <div class="text-end mb-5 p-3">
                                        <button type="submit" class="btn btn-primary btn-lg">Simpan Evaluasi</button>
                                    </div>
                                @else
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle me-2"></i> Anda telah menyelesaikan evaluasi untuk semua instrumen.
                                    </div>
                                @endif
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
