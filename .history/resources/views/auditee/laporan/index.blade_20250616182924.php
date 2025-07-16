@extends('layouts.dashboard2')

@section('title', 'Laporan AMI')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Audit Mutu Internal</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan AMI</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Siklus</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penugasanAuditors as $index => $pengajuan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pengajuan->periodeAktif->tahun }}</td>
                                        <td>{{ $pengajuan->periodeAktif->siklus }}</td>
                                        <td>
                                            @if($pengajuan->is_disetujui)
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-warning">Dalam Proses</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('auditee.laporan.berita-acara', $pengajuan->id) }}"
                                                   class="btn btn-sm btn-info"
                                                   target="_blank">
                                                    <i class="fas fa-file-alt"></i> Berita Acara
                                                </a>
                                                <a href="{{ route('auditee.laporan.evaluasi-ami', $pengajuan->id) }}"
                                                   class="btn btn-sm btn-primary"
                                                   target="_blank">
                                                    <i class="fas fa-clipboard-check"></i> Evaluasi AMI
                                                </a>
                                                <a href="{{ route('auditee.laporan.daftar-pertanyaan', $pengajuan->id) }}"
                                                   class="btn btn-sm btn-warning"
                                                   target="_blank">
                                                    <i class="fas fa-list"></i> Daftar Pertanyaan
                                                </a>
                                                <a href="{{ route('auditee.laporan.laporan-ami', $pengajuan->id) }}"
                                                   class="btn btn-sm btn-success"
                                                   target="_blank">
                                                    <i class="fas fa-file-pdf"></i> Laporan AMI
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn-group .btn {
        margin: 0 2px;
    }
    .badge {
        padding: 8px 12px;
        font-size: 0.85rem;
    }
</style>
@endpush