@extends('layouts.dashboard.dashboard')
@section('menu')
    Data Indikator Instrumen
@endsection
@section('link')
    <li class="breadcrumb-item text-muted">
        <a href="index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Data Indikator Instrumen</li>
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
        .detail-indikator-card {
            border: 1px solid #e9ecef;
            border-radius: 0.85rem;
        }
        .detail-kriteria-table thead th {
            background: #f8f9fa;
            font-weight: 700;
            color: #3f4254;
        }
        .state-card {
            border: 1px dashed #c7d2fe;
            border-radius: 0.85rem;
            background: linear-gradient(135deg, #f8faff 0%, #f2f6ff 100%);
        }
        .state-card .state-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: #e8efff;
            color: #3f6ad8;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        .indikator-option-card {
            border: 1px solid #e4e6ef;
            border-radius: 0.75rem;
            transition: all .15s ease;
        }
        .indikator-option-card:hover {
            border-color: #3f6ad8;
            box-shadow: 0 0.3rem 0.8rem rgba(63, 106, 216, .08);
        }
    </style>
@endpush

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            @php
                $isDetailMode = !empty($selectedFakultas) || !empty($selectedProdiId);
                $hasSelectedProdi = !empty($selectedProdi);
                $hasMultipleIndicators = $indikators->count() > 1;
                $totalKriteriaDetail = $indikators->sum(function ($indikator) {
                    return $indikator->kriterias->count();
                });
                $totalElemenDetail = $indikators->sum(function ($indikator) {
                    return $indikator->kriterias->sum(function ($kriteria) {
                        return $kriteria->instrumenProdi->count();
                    });
                });
            @endphp
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title {{ $isDetailMode ? 'd-none' : '' }}">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-indikatorInstrumen-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Indikator Instrumen" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end {{ $isDetailMode ? 'd-none' : '' }}" data-kt-indikatorInstrumen-table-toolbar="base">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal" style="padding-top: .8rem; padding-bottom: .8rem;">
                                <i class="fas fa-plus fa-sm"></i> Tambah Indikator Instrumen
                            </button>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none {{ $isDetailMode ? 'd-none' : '' }}" data-kt-indikatorInstrumen-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-indikatorInstrumen-table-select="selected_count"></span>Dipilih</div>
                            <button type="button" class="btn btn-danger" data-kt-indikatorInstrumen-table-select="delete_selected">Nonaktifkan Data Terpilih</button>
                        </div>
                        <div class="d-flex justify-content-end {{ $isDetailMode ? '' : 'd-none' }}">
                            <a href="{{ route('indikatorInstrumen.index', [], false) }}" class="btn btn-light-primary btn-sm">
                                <i class="fas fa-rotate-left me-1"></i> Reset Filter
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @if ($isDetailMode)
                        <div class="mb-8">
                            <div class="alert alert-primary d-flex align-items-center p-5 mb-6">
                                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                                    <i class="ki-duotone ki-abstract-26 fs-2 text-primary">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-primary">Detail Instrumen Prodi</h4>
                                    <span>
                                        Fakultas: <strong>{{ $selectedFakultas ?? '-' }}</strong>
                                        @if(!empty($selectedProdi))
                                            | Prodi: <strong>{{ $selectedProdi->nama_unit_kerja }}{{ $selectedProdi->jenjang ? ' (' . $selectedProdi->jenjang . ')' : '' }}</strong>
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="row g-5 mb-6">
                                <div class="col-md-4">
                                    <div class="card bg-light-primary h-100">
                                        <div class="card-body">
                                            <div class="fw-semibold text-primary mb-1">Total Indikator</div>
                                            <div class="fs-2 fw-bold text-dark">{{ $indikators->count() }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light-success h-100">
                                        <div class="card-body">
                                            <div class="fw-semibold text-success mb-1">Total Kriteria</div>
                                            <div class="fs-2 fw-bold text-dark">{{ $totalKriteriaDetail }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light-info h-100">
                                        <div class="card-body">
                                            <div class="fw-semibold text-info mb-1">Total Elemen</div>
                                            <div class="fs-2 fw-bold text-dark">{{ $totalElemenDetail }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($hasSelectedProdi && $indikators->isNotEmpty())
                                <div class="card state-card mb-6">
                                    <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-4">
                                        <div>
                                            <div class="d-flex align-items-center gap-3 mb-2">
                                                <span class="state-icon">
                                                    <i class="fas fa-compass"></i>
                                                </span>
                                                <div>
                                                    <div class="fw-bold fs-5 text-dark">Pengaturan Indikator Prodi</div>
                                                    <div class="text-muted">
                                                        Kelola indikator untuk <strong>{{ $selectedProdi->nama_unit_kerja }}{{ $selectedProdi->jenjang ? ' (' . $selectedProdi->jenjang . ')' : '' }}</strong>.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-gray-700">
                                                Prodi ini sudah menggunakan <strong>1 indikator aktif</strong>. Jika perlu, Anda bisa mengganti ke indikator lain.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($hasSelectedProdi && isset($availableIndikators) && $availableIndikators->isNotEmpty())
                                <div class="card mb-6" id="indikator-opsi-prodi">
                                    <div class="card-header border-0 pt-5">
                                        <div class="card-title d-flex flex-column">
                                            <span class="fw-bold fs-5 text-dark">Opsi Indikator Yang Bisa Dipakai</span>
                                            <span class="text-muted fs-7">Pilih indikator yang ingin digunakan untuk prodi ini.</span>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row g-4">
                                            @foreach($availableIndikators as $opsiIndikator)
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="indikator-option-card p-4 h-100 d-flex flex-column justify-content-between">
                                                        <div>
                                                            <div class="fw-bold text-dark mb-2">{{ $opsiIndikator->nama_indikator }}</div>
                                                            <div class="text-muted fs-7 mb-3">{{ $opsiIndikator->kriterias_count }} kriteria tersedia</div>
                                                        </div>
                                                        <div>
                                                            <button type="button"
                                                                class="btn btn-light-primary btn-sm w-100 js-use-existing-indikator"
                                                                data-id="{{ $opsiIndikator->id }}"
                                                                data-url="{{ route('indikatorInstrumen.edit', $opsiIndikator->id, false) }}"
                                                                data-prodi-id="{{ $selectedProdi->id }}"
                                                                data-prodi-label="{{ $selectedProdi->nama_unit_kerja }}{{ $selectedProdi->jenjang ? ' (' . $selectedProdi->jenjang . ')' : '' }}">
                                                                <i class="fas fa-link me-1"></i> Gunakan Indikator Ini
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @forelse ($indikators as $indikator)
                                @php
                                    $totalElemenPerIndikator = $indikator->kriterias->sum(function ($kriteria) {
                                        return $kriteria->instrumenProdi->count();
                                    });
                                @endphp
                                <div class="card detail-indikator-card mb-6">
                                    <div class="card-header border-0 pt-5">
                                        <div class="card-title d-flex flex-column">
                                            <span class="fw-bold fs-4 text-dark">{{ $indikator->nama_indikator }}</span>
                                            <div class="d-flex flex-wrap gap-2 mt-2">
                                                <span class="badge badge-light-success">{{ $indikator->kriterias->count() }} Kriteria</span>
                                                <span class="badge badge-light-info">{{ $totalElemenPerIndikator }} Elemen</span>
                                                <span class="badge badge-light-warning">Threshold LAM: {{ number_format((float)($indikator->threshold ?? 3), 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="card-toolbar">
                                            @if($hasSelectedProdi)
                                                <button type="button"
                                                    class="btn btn-sm btn-light-success me-2 js-use-existing-indikator"
                                                    data-id="{{ $indikator->id }}"
                                                    data-url="{{ route('indikatorInstrumen.edit', $indikator->id, false) }}"
                                                    data-prodi-id="{{ $selectedProdi->id }}"
                                                    data-prodi-label="{{ $selectedProdi->nama_unit_kerja }}{{ $selectedProdi->jenjang ? ' (' . $selectedProdi->jenjang . ')' : '' }}">
                                                    <i class="fas fa-pen-to-square me-1"></i> Edit Penggunaan Indikator
                                                </button>
                                                @if($hasMultipleIndicators)
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger js-remove-prodi"
                                                        data-id="{{ $indikator->id }}"
                                                        data-prodi="{{ $selectedProdi->id }}"
                                                        data-url="{{ route('indikatorInstrumen.removeProdi', $indikator->id, false) }}">
                                                        <i class="fas fa-trash-alt me-1"></i> Hapus dari Prodi ini
                                                    </button>
                                                @endif
                                            @endif
                                            <a href="{{ route('indikatorInstrumen.getKriteria', ['indikator' => $indikator->id, 'fakultas' => $selectedFakultas, 'prodi_id' => $selectedProdiId], false) }}"
                                               class="btn btn-sm btn-light-primary">
                                                <i class="fas fa-list me-1"></i> Lihat / Kelola Kriteria
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        @if($indikator->kriterias->isEmpty())
                                            <div class="text-muted fst-italic">Belum ada kriteria untuk indikator ini.</div>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table table-row-dashed align-middle detail-kriteria-table">
                                                    <thead>
                                                        <tr>
                                                            <th width="60">No</th>
                                                            <th width="140">Kode</th>
                                                            <th width="280">Nama Kriteria</th>
                                                            <th>Elemen</th>
                                                            <th width="120" class="text-center">Jumlah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($indikator->kriterias as $indexKriteria => $kriteria)
                                                            @php $elemens = $kriteria->instrumenProdi; @endphp
                                                            <tr>
                                                                <td>{{ $indexKriteria + 1 }}</td>
                                                                <td><span class="badge badge-light-secondary">{{ $kriteria->kode_kriteria ?? '-' }}</span></td>
                                                                <td>{{ $kriteria->nama_kriteria }}</td>
                                                                <td>
                                                                    <div class="d-flex flex-wrap gap-2">
                                                                        @forelse($elemens as $elemen)
                                                                            <span class="badge badge-light-primary">{{ $elemen->elemen }}</span>
                                                                        @empty
                                                                            <span class="text-muted fst-italic">Belum ada elemen</span>
                                                                        @endforelse
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    <span class="badge badge-light-info">{{ $elemens->count() }}</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="card state-card">
                                    <div class="card-body p-6">
                                        <div class="d-flex align-items-start gap-4">
                                            <span class="state-icon">
                                                <i class="fas fa-circle-info"></i>
                                            </span>
                                            <div>
                                                <h4 class="mb-2 text-dark">Belum Ada Indikator Sesuai Filter</h4>
                                                <p class="text-muted mb-4">
                                                    Data indikator untuk filter ini belum tersedia.
                                                    @if($hasSelectedProdi)
                                                        Silakan pilih indikator yang sudah tersedia untuk dipakai pada prodi ini.
                                                    @else
                                                        Coba pilih prodi yang lebih spesifik agar Anda bisa langsung menambahkan atau memetakan indikator.
                                                    @endif
                                                </p>
                                                @if($hasSelectedProdi)
                                                    
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    @endif

                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 {{ $isDetailMode ? 'd-none' : '' }}" id="kt_indikatorInstrumen_table">
                        <thead>
                            <tr class="text-start text-dark fw-bolder fs-7 text-uppercase gs-0 bg-light-primary">
                                <th class="w-10px pe-2 ps-4">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid ms-3 me-3">
                                        <input class="form-check-input bg-white" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_indikatorInstrumen_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-50px ps-3">No</th>
                                <th class="min-w-125px">Nama Indikator</th>
                                <th class="min-w-100px text-center">Threshold LAM</th>
                                <th class="min-w-200px">Program Studi</th>
                                <th class="min-w-100px text-center">Jumlah Kriteria</th>
                                <th class="min-w-100px text-center">Status</th>
                                <th class="min-w-auto text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse ($indikators as $index => $indikator)
                                <tr>
                                    <td class="w-10px pe-2 ps-4">
                                        <div class="form-check form-check-custom form-check-primary form-check-sm ms-3 me-3">
                                            <input class="form-check-input" type="checkbox" value="{{ $indikator->id }}" />
                                        </div>
                                    </td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $indikator->nama_indikator }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-light-warning">{{ number_format((float)($indikator->threshold ?? 3), 2) }}</span>
                                    </td>
                                    <td>
                                        @if($indikator->prodis->isNotEmpty())
                                            <div class="d-flex flex-column gap-2">
                                                @foreach($indikator->prodis->take(3) as $prodi)
                                                    <span class="badge badge-light-primary">{{ $prodi->nama_unit_kerja }} ({{ $prodi->jenjang }})</span>
                                                @endforeach
                                                @if($indikator->prodis->count() > 3)
                                                    <a href="#" class="show-all-prodi text-hover-primary"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-custom-class="tooltip-inverse"
                                                       data-bs-html="true"
                                                       data-bs-placement="bottom"
                                                       title="@foreach($indikator->prodis->skip(3) as $prodi){{ $prodi->nama_unit_kerja }} ({{ $prodi->jenjang }})<br>@endforeach">
                                                        <span class="badge badge-light-info">+{{ $indikator->prodis->count() - 3 }} more</span>
                                                    </a>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-danger fst-italic">Tidak ada prodi terkait</span>
                                        @endif
                                    </td>
                                                                        <td class="text-center">
                                        <a href="{{ route('indikatorInstrumen.getKriteria', ['indikator' => $indikator->id, 'fakultas' => request()->query('fakultas'), 'prodi_id' => request()->query('prodi_id')], false) }}"
                                           class="btn btn-sm {{ $indikator->kriteria_count > 0 ? 'btn-light-info' : 'btn-light-secondary' }}">
                                            <i class="fas fa-list"></i> {{ $indikator->kriteria_count }} Kriteria
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if ($indikator->deleted_at)
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
                                            <button type="button" class="btn btn-sm btn-light-success edit-indikatorInstrumen"
                                                data-id="{{ $indikator->id }}"
                                                data-url="{{ route('indikatorInstrumen.edit', $indikator->id, false) }}"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal">
                                                <i class="fas fa-edit fa-sm"></i>&nbsp;</i> Edit
                                            </button>
                                            @if ($indikator->deleted_at)
                                                <button type="button" class="btn btn-sm btn-light-primary restore-data" data-id="{{ $indikator->id }}">
                                                    <i class="fas fa-sync-alt fa-sm"></i>&nbsp;Aktifkan
                                                </button>

                                                <button type="button" class="btn btn-sm btn-light-danger delete-permanent" data-id="{{ $indikator->id }}">
                                                    <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-light-danger nonaktifkan-indikatorInstrumen" data-id="{{ $indikator->id }}">
                                                    <i class="fas fa-ban fa-sm"></i>&nbsp;Nonaktifkan
                                                </button>

                                                <button type="button" class="btn btn-sm btn-light-danger" disabled>
                                                    <i class="fas fa-trash-alt fa-sm"></i>&nbsp;Hapus
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak tersedia</td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @include('layouts.partials._modal_indikator_instrumen')
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



        $(document).on('click', '.restore-data', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dipulihkan dan bisa digunakan kembali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, aktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('indikatorInstrumen.restore', ['id' => '__ID__'], false) }}".replace('__ID__', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'PUT'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dipulihkan!',
                                text: 'Data Indikator Instrumen berhasil dipulihkan.',
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat memulihkan data.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });

        const scopedIndicatorOptions = @json(
            ($hasSelectedProdi ?? false)
                ? $indikators->concat($availableIndikators ?? collect())
                    ->unique('id')
                    ->values()
                    ->map(fn($indikator) => [
                        'id' => (int) $indikator->id,
                        'nama_indikator' => $indikator->nama_indikator
                    ])
                : []
        );

        const setModalToCreate = function() {
            $('#kt_modal form')[0].reset();
            $('#methodField').val('POST');
            $('#kt_modal_form').attr('action', "{{ route('indikatorInstrumen.store', [], false) }}");
            $('#kt_modal .modal-title').text('Tambah Indikator Instrumen');
            $('#kt_modal button[type=submit]').html('<i class="ki-duotone ki-check fs-5"></i> Simpan');
            $('#threshold_input').val('3.00');
            $('#kategori_select').val(null).trigger('change');
            resetModalScope();
        };

        const syncScopedIndicatorFields = function() {
            const selectedId = $('#nama_indikator_scoped_select').val() || '';
            const selectedName = $('#nama_indikator_scoped_select option:selected').text() || '';
            $('#scoped_indikator_id').val(selectedId);
            $('#nama_indikator_hidden').val(selectedName).prop('disabled', !selectedId);
        };

        const renderScopedIndicatorSelect = function(selectedId = '') {
            const selectedIdStr = selectedId ? String(selectedId) : '';
            const $scopedSelect = $('#nama_indikator_scoped_select');
            $scopedSelect.empty();
            $scopedSelect.append(new Option('Pilih indikator yang sudah tersedia', '', !selectedIdStr, !selectedIdStr));

            scopedIndicatorOptions.forEach(function(item) {
                const value = String(item.id);
                const isSelected = value === selectedIdStr;
                $scopedSelect.append(new Option(item.nama_indikator || '-', value, isSelected, isSelected));
            });

            if (selectedIdStr) {
                $scopedSelect.val(selectedIdStr);
            } else {
                $scopedSelect.val('');
            }

            syncScopedIndicatorFields();
        };

        const setScopedNamaIndikator = function(indikatorId = '') {
            $('#nama_indikator_input_wrapper').addClass('d-none');
            $('#nama_indikator_scoped_wrapper').removeClass('d-none');
            $('#nama_indikator_input').prop('disabled', true);
            $('#nama_indikator_scoped_select').prop('disabled', false);
            renderScopedIndicatorSelect(indikatorId);
        };

        const resetScopedNamaIndikator = function() {
            $('#nama_indikator_scoped_wrapper').addClass('d-none');
            $('#nama_indikator_input_wrapper').removeClass('d-none');
            $('#nama_indikator_input').prop('disabled', false);
            $('#nama_indikator_input').val('');
            $('#nama_indikator_scoped_select').empty();
            $('#nama_indikator_hidden').val('').prop('disabled', true);
            $('#scoped_indikator_id').val('');
        };

        const resetModalScope = function() {
            $('#scope_prodi_id').val('');
            $('#scope_prodi_label').val('');
            $('#scope_prodi_info').addClass('d-none');
            $('#kategori_select_wrapper').removeClass('d-none');
            $('#kategori_select').prop('disabled', false);
            resetScopedNamaIndikator();
        };

        const applyScopedProdiMode = function(prodiId, prodiLabel) {
            const scopedId = prodiId ? String(prodiId) : '';
            if (!scopedId) {
                resetModalScope();
                return;
            }

            $('#scope_prodi_id').val(scopedId);
            $('#scope_prodi_label').val(prodiLabel || '');
            $('#scope_prodi_info').removeClass('d-none');
            $('#kategori_select_wrapper').addClass('d-none');
            $('#kategori_select').val(null).trigger('change');
            $('#kategori_select').prop('disabled', true);
        };

        const openEditModalForProdi = function(indikatorId, editUrl, prodiId, prodiLabel) {
            $('#kt_modal form')[0].reset();
            $('#methodField').val('PUT');
            $('#kt_modal_form').attr('action', "{{ route('indikatorInstrumen.update', '', false) }}/" + indikatorId);
            $('#kt_modal .modal-title').text('Pilih / Ganti Indikator');
            $('#kt_modal button[type=submit]').html('<i class="ki-duotone ki-check fs-5"></i> Update Data');
            applyScopedProdiMode(prodiId, prodiLabel);
            setScopedNamaIndikator(indikatorId);
            if (prodiLabel) {
                $('#kt_modal .modal-title').text('Pilih / Ganti Indikator - ' + prodiLabel);
            }
            $('#kt_modal').modal('show');
        };

        $(document).on('click', '.js-use-existing-indikator', function() {
            const indikatorId = $(this).data('id');
            const editUrl = $(this).data('url');
            const prodiId = $(this).data('prodi-id');
            const prodiLabel = $(this).data('prodi-label');
            openEditModalForProdi(indikatorId, editUrl, prodiId, prodiLabel);
        });

        $(document).on('click', '.js-remove-prodi', function() {
            const indikatorId = $(this).data('id');
            const prodiId = $(this).data('prodi');
            const url = $(this).data('url');

            Swal.fire({
                title: 'Hapus indikator untuk prodi ini?',
                text: 'Relasi indikator akan dicabut, tetapi data indikator tetap tersedia untuk prodi lain.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (!result.isConfirmed) {
                    return;
                }

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        prodi_id: prodiId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Relasi dihapus',
                            text: 'Prodi ini sudah tidak lagi terhubung ke indikator tersebut.'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire('Gagal', 'Tidak dapat menghapus relasi prodi saat ini.', 'error');
                    }
                });
            });
        });

        // Script untuk tombol tambah (reset form)
        $('button[data-bs-target="#kt_modal"]:not(.edit-indikatorInstrumen)').click(function() {
            setModalToCreate();
        });

        // Script untuk delete
        $(document).on('click', '.nonaktifkan-indikatorInstrumen', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dinonaktifkan tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, nonaktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('indikatorInstrumen.nonaktifkan', '', false) }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dinonaktifkan!',
                                text: 'Data Indikator Instrumen berhasil dinonaktifkan.',
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menonaktifkan data.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });

        // Handler untuk tombol "Nonaktifkan Data Terpilih"
        $(document).on('click', '[data-kt-indikatorInstrumen-table-select="delete_selected"]', function() {
            const checkboxes = document.querySelectorAll('#kt_indikatorInstrumen_table tbody input[type="checkbox"]:checked');
            console.log(checkboxes);
            if (checkboxes.length <= 0) {
                Swal.fire({
                    text: "Tidak ada data yang dipilih!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, mengerti!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    }
                });
                return;
            }

            const ids = Array.from(checkboxes).map(checkbox => checkbox.value);

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan menonaktifkan ${ids.length} data yang dipilih. Data yang dinonaktifkan tidak dapat dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, nonaktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('indikatorInstrumen.nonaktifkanSelected', [], false) }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: ids
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Dinonaktifkan!',
                                text: response.message,
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menonaktifkan data.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click', '.delete-permanent', function () {
            var id = $(this).data('id');
            var url = "{{ route('indikatorInstrumen.hapus_permanen', ['id' => '__ID__'], false) }}";
            url = url.replace('__ID__', id);

            Swal.fire({
                title: 'Hapus Permanen?',
                text: "Data Auditor akan dihapus secara permanen dan tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus Permanen!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: true,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: xhr.responseJSON.message,
                            });
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip({
                template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner bg-white text-dark shadow-sm p-2"></div></div>'
            });

            const formatKategoriOption = function(state) {
                if (!state.id) {
                    return state.text;
                }

                const hasIndikator = $(state.element).data('has-indikator') == 1;
                if (hasIndikator) {
                    return $('<span>' + state.text + '</span>');
                }

                return $(
                    '<span class="d-flex align-items-center justify-content-between gap-2">' +
                        '<span>' + state.text + '</span>' +
                        '<span class="badge badge-light-secondary">Belum ada indikator</span>' +
                    '</span>'
                );
            };

            // Initialize Select2
            $('#kategori_select').select2({
                dropdownParent: $('#kt_modal'),
                placeholder: 'Pilih kategori...',
                allowClear: true,
                templateResult: formatKategoriOption,
                templateSelection: function(state) {
                    return state.text;
                },
                escapeMarkup: function(markup) {
                    return markup;
                }
            });

            $('#nama_indikator_scoped_select').on('change', function() {
                syncScopedIndicatorFields();
            });

            // Reset select2 when modal is hidden
            $('#kt_modal').on('hidden.bs.modal', function () {
                $('#kategori_select').val(null).trigger('change');
                resetModalScope();
            });
        });
    </script>
@endpush
