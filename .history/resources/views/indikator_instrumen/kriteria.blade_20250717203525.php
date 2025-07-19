@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Kriteria Penilaian
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('indikatorInstrumen.index') }}" class="text-muted text-hover-primary">Indikator Instrumen</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Kriteria Penilaian</li>
@endsection

@push('styles')
    <style>
        .select2-container--bootstrap5 .select2-selection {
            box-shadow: none !important;
        }
        .select2-container--bootstrap5 .select2-selection--multiple {
            min-height: calc(1.5em + 1.5rem + 2px) !important;
        }
        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__rendered {
            display: flex;
            flex-wrap: wrap;
        }
        .tooltip-inner {
            max-width: 300px;
            text-align: left;
        }
        .tooltip-inner br {
            margin-bottom: 3px;
        }
    </style>
@endpush

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="w-100 mb-2">
                        <div class="alert alert-info d-flex align-items-center p-5">
                            <span class="svg-icon svg-icon-2hx svg-icon-info me-4">
                                <i class="ki-duotone ki-information-5 fs-2 text-info">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>

                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-info">Informasi Indikator</h4>
                                <span>Menampilkan kriteria penilaian untuk indikator: <strong>{{ $indikator->nama_indikator }}</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-kriteria-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Kriteria Penilaian" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-kriteria-table-toolbar="base">
                            <a href="{{ route('indikatorInstrumen.index') }}" class="btn btn-secondary btn-sm" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-arrow-left fa-sm"></i> Kembali ke Indikator
                            </a>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-kriteria-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-kriteria-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-kriteria-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_kriteria_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="w-10px pe-2 ps-4">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                        <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_kriteria_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-50px ps-3">No</th>
                                <th class="min-w-200px">Nama Kriteria</th>
                                <th class="min-w-300px">Elemen</th>
                                <th class="min-w-100px text-center">Status</th>
                                <th class="min-w-auto text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse ($kriterias as $index => $kriteria)
                                <tr>
                                    <td class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-custom form-check-primary form-check-sm ms-3 me-3">
                                            <input class="form-check-input" type="checkbox" value="{{ $kriteria->id }}" />
                                        </div>
                                    </td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kriteria->nama_kriteria }}</td>
                                                                        <td>
                                        @if($kriteria->instrumenProdi->isNotEmpty())
                                            <div class="d-flex flex-column gap-2">
                                                @foreach($kriteria->instrumenProdi->take(3) as $instrumen)
                                                    <span class="badge badge-light-primary">{{ $instrumen->elemen }}</span>
                                                @endforeach
                                                @if($kriteria->instrumenProdi->count() > 3)
                                                    <a href="#" class="show-all-elemen text-hover-primary"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-custom-class="tooltip-inverse"
                                                       data-bs-html="true"
                                                       data-bs-placement="bottom"
                                                       title="@foreach($kriteria->instrumenProdi->skip(3) as $instrumen){{ $instrumen->elemen }}<br>@endforeach">
                                                        <span class="badge badge-light-info">+{{ $kriteria->instrumenProdi->count() - 3 }} more</span>
                                                    </a>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-danger fst-italic">Tidak ada elemen</span>
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
                                    <td colspan="6" class="text-center">Data tidak tersedia</td>
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
    <script src="{{ asset('assets/src/js/custom/apps/indikator_instrumen/list/list.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Inisialisasi DataTable
        $(document).ready(function() {
            $('#kt_kriteria_table').DataTable({
                "pageLength": 25,
                "order": [[1, "asc"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                }
            });
        });
    </script>
@endpush
