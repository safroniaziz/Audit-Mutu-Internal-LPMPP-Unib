<div class="modal fade" id="kt_modal" tabindex="-1" data-bs-backdrop="static" data-bs-focus="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header px-10">
                <h2 class="fw-bold">Tambah Indikator Instrumen</h2>
            </div>
            <div class="modal-body d-flex flex-column scroll-y px-10" style="flex-grow: 1;">
                <form id="kt_modal_form" class="form d-flex flex-column" style="flex-grow: 1;">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="POST">
                    <input type="hidden" name="scope_prodi_id" id="scope_prodi_id" value="">
                    <input type="hidden" name="scoped_indikator_id" id="scoped_indikator_id" value="">
                    <div class="fv-row mb-5" id="nama_indikator_input_wrapper">
                        <label class="fs-5 fw-semibold form-label mb-2">Nama Indikator Instrumen:</label>
                        <input type="text" name="nama_indikator" id="nama_indikator_input" class="form-control" />
                    </div>
                    <div class="fv-row mb-5" id="threshold_input_wrapper">
                        <label class="fs-5 fw-semibold form-label mb-2">Threshold LAM:</label>
                        <input type="number" step="0.01" min="0" name="threshold" id="threshold_input" class="form-control" value="3.00" />
                        <small class="text-muted">Default 3.00. Nilai ini berlaku untuk seluruh indikator/kriteria di dalam LAM ini.</small>
                    </div>

                    <div class="fv-row mb-5 d-none" id="nama_indikator_scoped_wrapper">
                        <label class="fs-5 fw-semibold form-label mb-2">Nama Indikator Instrumen:</label>
                        <select class="form-select" id="nama_indikator_scoped_select"></select>
                        <input type="hidden" name="nama_indikator" id="nama_indikator_hidden" value="" disabled>
                    </div>

                    <div class="fv-row mb-5 d-none" id="scope_prodi_info">
                        <label class="fs-5 fw-semibold form-label mb-2">Program Studi Terpilih:</label>
                        <input type="text" class="form-control form-control-solid" id="scope_prodi_label" readonly>
                        <small class="text-muted">Mode ini khusus untuk pengaturan indikator prodi yang sedang difilter.</small>
                    </div>

                    <div class="fv-row mb-5" id="kategori_select_wrapper">
                        <label class="fs-5 fw-semibold form-label mb-2">Pilih Program Studi:</label>
                        <select class="form-select" name="kategori[]" id="kategori_select" multiple>
                            @foreach ($prodis as $prodi)
                                @php
                                    $hasIndikator = in_array((int) $prodi->id, $assignedProdiIds ?? [], true);
                                @endphp
                                <option value="{{ $prodi->id }}" data-has-indikator="{{ $hasIndikator ? '1' : '0' }}">
                                    {{ $prodi->nama_unit_kerja }} ({{ $prodi->jenjang }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Label abu-abu menandakan prodi belum punya indikator aktif.</small>
                    </div>

                    <div class="modal-footer border-top mt-auto" style="padding:10px 0px 10px 0px">
                        <button type="reset" id="cancelModal" class="btn btn-danger btn-sm" style="padding-top: .8rem; padding-bottom: .8rem;">
                            <i class="fa fa-close fs-8"></i> Batalkan
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" style="padding-top: .8rem; padding-bottom: .8rem;">
                            <i class="ki-duotone ki-check fs-5"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.partials._cancel_modal')
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#kt_modal_form').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action') || "{{ route('indikatorInstrumen.store') }}";
                let method = $('#methodField').val() === 'PUT' ? 'PUT' : 'POST';

                // Siapkan data form
                let formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');

                // Jika method adalah PUT, gunakan _method untuk method spoofing
                if (method === 'PUT') {
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    url: url,
                    type: 'POST', // Selalu gunakan POST untuk AJAX, method spoofing akan menangani konversi ke PUT
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            title: '✅ Berhasil!',
                            html: `<div style="font-size: 1.2rem; font-weight: 500;">${response.message}</div>`,
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            timer: 2500,
                            timerProgressBar: true,
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON?.errors;
                        if (errors) {
                            let errorMessages = Object.values(errors).map(errorArray =>
                                errorArray.map(error => `
                                    <div style="margin: 4px auto; padding-bottom: 4px; color: red; font-weight: 500; text-align: center; border-bottom: 1px solid #ccc; width: 80%;">${error}</div>`
                                ).join('')
                            ).join('');

                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan!',
                                html: `<div style="font-size: 1rem;">${errorMessages}</div>`,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan, silakan coba lagi.'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
