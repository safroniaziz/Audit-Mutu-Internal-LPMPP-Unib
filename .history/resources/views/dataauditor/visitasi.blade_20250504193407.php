@extends('dataauditor/dashboard_template')

@section('dashboardProfile')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                                👋 Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>
                            </h3>
                         </div>
                    </div>

                    <div class="card-body">
                        @if($visitasi->isNotEmpty())
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
                                        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/>
                                        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/>
                                    </svg>
                                </span>
                                <div class="d-flex justify-content-between align-items-center py-4 mb-6 border rounded px-4" id="approve-desk-container">
                                    <div class="me-10">
                                            <h4 class="text-dark fw-bold mb-1">
                                                ✅ Visitasi Telah Diselesaikan
                                            </h4>
                                            <p class="text-gray-700 fs-6 mb-0">
                                                Silakan klik tombol <strong>Setujui</strong> untuk melanjutkan ke tahap <strong>Visitasi</strong>.
                                            </p>
                                    </div>

                                        <button type="button" class="btn btn-primary px-5" id="visitasi-btn" data-id="{{ $pengajuan->id }}">
                                            <i class="bi bi-arrow-right-circle me-2"></i> Lanjut ke Unduh Dokumen
                                        </button>
                                </div>
                            </div>
                        @else
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
                                                Silakan lengkapi pengisian data <strong>IKSS</strong> di bawah ini secara menyeluruh
                                                untuk dapat melanjutkan ke tahap <strong>pengisian Instrumen Audit</strong>.
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($dataIkss->isNotEmpty())
                            <form action="{{ route('auditor.audit.submitVisitasi') }}" method="POST" enctype="multipart/form-data" id="formVisitasi">
                                @csrf
                                <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">

                                @php
                                    // Group IKSS by their indicator codes
                                    $groupedIkss = $dataIkss->groupBy(function($item) {
                                        return $item->instrumen->indikatorKinerja->kode_ikss;
                                    });
                                @endphp

                                @foreach ($groupedIkss as $kodeIkss => $ikssGroup)
                                    @php
                                        // Get the first item to display the IKSS title
                                        $firstIkss = $ikssGroup->first();
                                        // Check if all instruments in this group are evaluated
                                        $allEvaluated = $ikssGroup->every(function($item) use ($visitasi) {
                                            return isset($visitasi[$item->id]);
                                        });
                                    @endphp

                                    <div class="card mb-5 {{ $allEvaluated ? 'border-success' : '' }}">
                                        <div class="card-header {{ $allEvaluated ? 'bg-success-subtle' : 'bg-light' }} pt-4">
                                            <div class="d-flex align-items-center">
                                                <h4 class="mb-0">ID IKSS: {{ $kodeIkss }} – {{ $firstIkss->instrumen->indikatorKinerja->tujuan }}</h4>
                                                @if($allEvaluated)
                                                    <span class="badge bg-success-subtle text-success border border-success ms-3">
                                                        ✅ Semua Instrumen Sudah Dievaluasi
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <!-- Loop through each instrument for this IKSS -->
                                            @foreach ($ikssGroup as $index => $ikssAuditee)
                                                @php
                                                    $hasEvaluation = isset($visitasi[$ikssAuditee->id]);
                                                @endphp

                                                <div class="instrument-container mb-4 {{ $index > 0 ? 'mt-5 pt-4 border-top' : '' }}">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h5 class="mb-0">Instrumen #{{ $index + 1 }}: {{ $ikssAuditee->instrumen->indikator }}</h5>
                                                        @if($hasEvaluation)
                                                            <span class="badge bg-success-subtle text-success border border-success ms-3">
                                                                ✅ Sudah Dievaluasi
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <input type="hidden" name="ikss_auditee_ids[]" value="{{ $ikssAuditee->id }}">

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
                                                        <div class="mt-3">
                                                            <h6>Ketidak Sesuaian</h6>
                                                            <textarea rows="2" class="form-control" name="deskripsi[{{ $ikssAuditee->id }}]" {{ $hasEvaluation ? 'disabled' : '' }}>{{ $hasEvaluation ? $visitasi[$ikssAuditee->id]->deskripsi : '' }}</textarea>
                                                        </div>
                                                        <div class="mt-3">
                                                            <h6>Pernyataan</h6>
                                                            <textarea rows="2" class="form-control" name="pertanyaan[{{ $ikssAuditee->id }}]" {{ $hasEvaluation ? 'disabled' : '' }}>{{ $hasEvaluation ? $visitasi[$ikssAuditee->id]->pertanyaan : '' }}</textarea>
                                                        </div>

                                                        <div class="mt-3">
                                                            <h6>Kelebihan</h6>
                                                            <textarea rows="2" class="form-control" name="pertanyaan[{{ $ikssAuditee->id }}]" {{ $hasEvaluation ? 'disabled' : '' }}>{{ $hasEvaluation ? $visitasi[$ikssAuditee->id]->pertanyaan : '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Only show submit button if there are items that haven't been evaluated -->
                                @php
                                    $evaluatedCount = $dataIkss->filter(function($item) use ($visitasi) {
                                        return isset($visitasi[$item->id]);
                                    })->count();
                                @endphp

                                @if($dataIkss->count() > $evaluatedCount)
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

@push('scripts')
    <script>
        // Tunggu hingga DOM selesai dimuat
        $(document).ready(function() {
            // Tambahkan tanda bintang pada label yang required
            $('.card-body h6').each(function() {
                // Tambahkan tanda bintang pada label Deskripsi, Pertanyaan, dan Nilai
                if($(this).text() === 'Deskripsi Penilaian Auditor Berdasarkan Data Sumber/Bukti dan Informasi' ||
                $(this).text() === 'Pertanyaan' ||
                $(this).text() === 'Nilai') {
                    $(this).append(' <span class="text-danger">*</span>');
                }
            });

            // Handle form submission dengan Ajax
            $('#formVisitasi').on('submit', function(e) {
                e.preventDefault();

                // Validasi form sebelum submit
                let valid = true;
                let errorMessages = [];

                // Validasi semua textarea yang required
                $('textarea[name^="deskripsi"], textarea[name^="pertanyaan"], textarea[name^="nilai"]').each(function() {
                    if($(this).val().trim() === '') {
                        valid = false;
                        // Highlight textarea yang kosong
                        $(this).addClass('is-invalid');

                        // Dapatkan label field
                        let fieldName = $(this).closest('div').find('h6').text().replace(' *', '');
                        errorMessages.push('Field ' + fieldName + ' tidak boleh kosong');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if(!valid) {
                    // Tampilkan pesan error dengan SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal',
                        html: errorMessages.join('<br>'),
                        confirmButtonText: 'Mengerti'
                    });
                    return;
                }

                // Tampilkan loading indicator
                Swal.fire({
                    title: 'Sedang Menyimpan...',
                    html: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Kirim data form dengan Ajax
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Tampilkan pesan sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data evaluasi berhasil disimpan',
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            // Refresh halaman setelah berhasil
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan pada server';

                        // Jika ada response error detail dari Laravel
                        if(xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = '<ul class="text-left">';
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorMessage += '<li>' + value + '</li>';
                            });
                            errorMessage += '</ul>';
                        }

                        // Tampilkan pesan error
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan Data',
                            html: errorMessage,
                            confirmButtonText: 'Mengerti'
                        });
                    }
                });
            });

            // Tambahkan event listener untuk menghapus class is-invalid saat input berubah
            $('textarea').on('input', function() {
                $(this).removeClass('is-invalid');
            });
        });

        document.getElementById('approve-desk-btn').addEventListener('click', function () {
            const pengajuanId = this.dataset.id;

            // SweetAlert2 untuk konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Setujui untuk melanjutkan ke tahap visitasi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user setuju, kirimkan request AJAX
                    fetch("{{ route('auditor.audit.approveDeskEvaluation', '__id__') }}".replace('__id__', pengajuanId), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                    }).then(response => {
                        if (response.ok) {
                            // Tampilkan notifikasi sukses
                            Swal.fire(
                                'Disetujui!',
                                'Proses Visitasi telah disetujui.',
                                'success'
                            ).then(() => {
                                // Optional: update UI atau redirect
                                document.getElementById('approve-desk-container').innerHTML = `
                                    <div class="text-success fw-semibold">✅ Disetujui! Anda dapat melanjutkan ke tahap visitasi.</div>
                                `;
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan. Silakan coba lagi.',
                                'error'
                            );
                        }
                    }).catch(error => {
                        console.error(error);
                        Swal.fire(
                            'Terjadi Kesalahan!',
                            'Silakan coba lagi nanti.',
                            'error'
                        );
                    });
                }
            });
        });
    </script>
@endpush
