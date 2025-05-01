<div class="modal fade" id="kt_modal" tabindex="-1" data-bs-backdrop="static" data-bs-focus="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header px-10">
                <h2 class="fw-bold">Tambah Instrumen Prodi</h2>
            </div>
            <div class="modal-body d-flex flex-column scroll-y px-10" style="flex-grow: 1;">
                <form id="kt_modal_form" class="form d-flex flex-column" style="flex-grow: 1;">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="POST">

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Indikator Instrumen:</label>
                        <select name="indikator_instrumen_id" class="form-control" required>
                            <option disabled selected>-- pilih indikator instrumen --</option>
                            @foreach ($indikators as $indikator)
                                <option value="{{ $indikator->id }}">{{ $indikator->nama_indikator }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Kriteria Instrumen:</label>
                        <select name="indikator_instrumen_kriteria_id" class="form-control" required>
                            <option disabled selected>-- pilih kriteria instrumen --</option>
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Elemen:</label>
                        <input type="text" name="elemen" class="form-control" required />
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Indikator:</label>
                        <input type="text" name="indikator" class="form-control" required />
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Sumber Data:</label>
                        <input type="text" name="sumber_data" class="form-control" required />
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Metode Perhitungan:</label>
                        <input type="text" name="metode_perhitungan" class="form-control" required />
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Target:</label>
                        <input type="text" name="target" class="form-control" required />
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Realisasi:</label>
                        <input type="text" name="realisasi" class="form-control" required />
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Standar Digunakan:</label>
                        <input type="text" name="standar_digunakan" class="form-control" required />
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Uraian:</label>
                        <textarea name="uraian" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Penyebab Tidak Tercapai:</label>
                        <textarea name="penyebab_tidak_tercapai" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Rencana Perbaikan:</label>
                        <textarea name="rencana_perbaikan" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Indikator Penilaian:</label>
                        <textarea name="indikator_penilaian" class="form-control" rows="3"></textarea>
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
            var savedKriteriaId = null;
            $(document).ready(function () {
                // Handler untuk perubahan indikator instrumen
                $('select[name="indikator_instrumen_id"]').on('change', function () {
                    let indikatorId = $(this).val();

                    if (indikatorId) {
                        $.ajax({
                            url: '/instrumen-prodi/indikator/' + indikatorId + '/kriteria',
                            type: 'GET',
                            success: function (response) {
                                let kriteriaSelect = $('select[name="indikator_instrumen_kriteria_id"]');
                                kriteriaSelect.empty();
                                kriteriaSelect.append('<option disabled selected>-- pilih kriteria instrumen --</option>');

                                response.forEach(function (kriteria) {
                                    kriteriaSelect.append('<option value="' + kriteria.id + '">' + kriteria.nama_kriteria + '</option>');
                                });

                                // Cek apakah ada ID kriteria yang perlu dipilih (dari proses edit)
                                if (savedKriteriaId) {
                                    console.log("Attempting to select kriteria ID:", savedKriteriaId);
                                    kriteriaSelect.val(savedKriteriaId);

                                    // Jika masih tidak berhasil, coba dengan pendekatan alternatif
                                    if (kriteriaSelect.val() === null) {
                                        kriteriaSelect.find('option[value="' + savedKriteriaId + '"]').prop('selected', true);
                                    }

                                    console.log("Selected value after attempt:", kriteriaSelect.val());

                                    // Reset nilai savedKriteriaId setelah digunakan
                                    savedKriteriaId = null;
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error fetching kriteria: ', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: 'Tidak dapat mengambil kriteria, silakan coba lagi.',
                                });
                            }
                        });
                    }
                });

            $('#kt_modal_form').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action') || "{{ route('kriteriaInstrumen.store') }}";
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
