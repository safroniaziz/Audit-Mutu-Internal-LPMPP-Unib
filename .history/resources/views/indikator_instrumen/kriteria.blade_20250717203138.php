@extends('layouts.dashboard.dashboard')
@section('menu')
    Kriteria Penilaian - {{ $indikator->nama_indikator }}
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('indikatorInstrumen.index') }}" class="text-muted text-hover-primary">Indikator Instrumen</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Kriteria Penilaian</li>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h2 class="fw-bold">Daftar Kriteria Penilaian</h2>
                        <p class="text-muted">Indikator: <strong>{{ $indikator->nama_indikator }}</strong></p>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('indikatorInstrumen.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_kriteria_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="min-w-50px ps-3">No</th>
                                <th class="min-w-200px">Nama Kriteria</th>
                                <th class="min-w-100px text-center">Jumlah Elemen</th>
                                <th class="min-w-100px text-center">Status</th>
                                <th class="min-w-auto text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse ($kriterias as $index => $kriteria)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kriteria->nama_kriteria }}</td>
                                    <td class="text-center">
                                        @if($kriteria->instrumenProdi->count() > 0)
                                            <a href="{{ route('instrumenProdi.index') }}?kriteria={{ $kriteria->id }}"
                                               class="btn btn-sm btn-light-info">
                                                <i class="fas fa-list"></i> {{ $kriteria->instrumenProdi->count() }} Elemen
                                            </a>
                                        @else
                                            <span class="badge badge-light-secondary">0 Elemen</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($kriteria->deleted_at)
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times-circle fa-sm" style="color: white;"></i>&nbsp;Tidak Aktif
                                            </span>
                                        @else
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle fa-sm" style="color: white;"></i>&nbsp;Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="button-container">
                                            <a href="{{ route('instrumenProdi.index') }}?kriteria={{ $kriteria->id }}"
                                               class="btn btn-sm btn-light-primary">
                                                <i class="fas fa-eye fa-sm"></i>&nbsp;Lihat Elemen
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada kriteria yang ditemukan</td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Inisialisasi DataTable jika diperlukan
        $(document).ready(function() {
            $('#kt_kriteria_table').DataTable({
                "pageLength": 25,
                "order": [[0, "asc"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                }
            });
        });
    </script>
@endpush
