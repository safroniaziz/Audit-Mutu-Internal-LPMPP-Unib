@extends('layouts.dashboard2')

@section('title', $title)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $subtitle }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
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
                                @forelse($pengajuanAmis as $pengajuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pengajuan->periode->tahun }}</td>
                                    <td>{{ $pengajuan->periode->siklus }}</td>
                                    <td>
                                        <span class="badge badge-success">Selesai</span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('auditee.laporanAmi.unduhDokumen', $pengajuan->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-download"></i> Unduh Dokumen
                                            </a>
                                            <a href="{{ route('auditee.laporanAmi.beritaAcara', $pengajuan->id) }}" class="btn btn-sm btn-primary" target="_blank">
                                                <i class="fas fa-file-alt"></i> Berita Acara
                                            </a>
                                            <a href="{{ route('auditee.laporanAmi.evaluasiAmi', $pengajuan->id) }}" class="btn btn-sm btn-warning" target="_blank">
                                                <i class="fas fa-clipboard-check"></i> Evaluasi
                                            </a>
                                            <a href="{{ route('auditee.laporanAmi.daftarPertanyaan', $pengajuan->id) }}" class="btn btn-sm btn-secondary" target="_blank">
                                                <i class="fas fa-list"></i> Daftar Pertanyaan
                                            </a>
                                            <a href="{{ route('auditee.laporanAmi.laporan', $pengajuan->id) }}" class="btn btn-sm btn-success" target="_blank">
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
