@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Perjanjian Kinerja</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                        <div class="me-4">
                            <i class="bi bi-info-circle-fill fs-2 text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h4 class="fw-bold text-dark mb-2">📢 Informasi Penting</h4>
                            <div class="fs-6 text-gray-700">
                                <p class="mt-4">
                                    <strong>Catatan:</strong>
                                    <span class="text-gray-800">
                                        Silakan unggah dokumen Perjanjian Kinerja Anda untuk dapat melanjutkan ke tahap Pemilihan IKSS.
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="ms-auto">
                            <a
                                @if($perjanjianKinerja)
                                    href="{{ route('auditee.pengajuanAmi.pemilihanIkss') }}"
                                    class="btn btn-sm px-4 btn-primary"
                                @else
                                    href="#"
                                    class="btn btn-sm px-4 btn-secondary disabled"
                                    style="cursor: not-allowed; opacity: 0.65;"
                                @endif
                            >
                                <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                            </a>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                            Upload Perjanjian Kinerja
                        </button>
                    </div>

                    @if($perjanjianKinerja)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
                                        <th>Ukuran</th>
                                        <th>Tanggal Upload</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $perjanjianKinerja->nama_file }}</td>
                                        <td>{{ number_format($perjanjianKinerja->size / 1024, 2) }} KB</td>
                                        <td>{{ $perjanjianKinerja->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('perjanjian-kinerja.download', $perjanjianKinerja->id) }}" class="btn btn-sm btn-info">
                                                Download
                                            </a>
                                            <form action="{{ route('perjanjian-kinerja.destroy', $perjanjianKinerja->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Belum ada file Perjanjian Kinerja yang diunggah.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Perjanjian Kinerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('perjanjian-kinerja.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="periode_id">Periode</label>
                        <select name="periode_id" id="periode_id" class="form-control @error('periode_id') is-invalid @enderror" required>
                            <option value="">Pilih Periode</option>
                            @foreach($periodes as $periode)
                                <option value="{{ $periode->id }}">{{ $periode->tahun }} - {{ $periode->semester }}</option>
                            @endforeach
                        </select>
                        @error('periode_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">File Perjanjian Kinerja</label>
                        <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file" required>
                        <small class="form-text text-muted">Format file: PDF, maksimal 10MB</small>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
