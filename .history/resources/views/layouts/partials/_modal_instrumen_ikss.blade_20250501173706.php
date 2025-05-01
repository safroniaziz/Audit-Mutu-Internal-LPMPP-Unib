<div class="modal fade" id="kt_modal" tabindex="-1" data-bs-backdrop="static" data-bs-focus="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header px-10">
                <h2 class="fw-bold">Tambah Instrumen IKSS</h2>
            </div>
            <div class="modal-body d-flex flex-column scroll-y px-10" style="flex-grow: 1;">
                <form id="kt_modal_form" class="form d-flex flex-column" style="flex-grow: 1;">
                    @csrf
                    <input type="hidden" name="_method" id="methodField" value="POST">

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Indikator Kinerja:</label>
                        <select name="indikator_kinerja_id" class="form-control" required>
                            <option disabled selected>-- pilih indikator kinerja --</option>
                            @foreach ($indikatorKinerjas as $indikatorKinerja)
                                <option value="{{ $indikatorKinerja->id }}">{{ $indikatorKinerja->tujuan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Kode IKSS:</label>
                        <input type="text" name="kode_ikss" class="form-control" maxlength="10" required>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Tujuan:</label>
                        <textarea name="tujuan" id="kt_docs_ckeditor_tujuan" class="form-control"></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Indikator:</label>
                        <textarea name="indikator" id="kt_docs_ckeditor_indikator" class="form-control"></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Satuan:</label>
                        <textarea name="satuan" id="kt_docs_ckeditor_satuan" class="form-control"></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Pertanyaan:</label>
                        <textarea name="pertanyaan" id="kt_docs_ckeditor_pertanyaan" class="form-control"></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Target:</label>
                        <input type="text" name="target" class="form-control" maxlength="255">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Sumber:</label>
                        <textarea name="sumber" id="kt_docs_ckeditor_sumber" class="form-control"></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Uraian:</label>
                        <textarea name="uraian" id="kt_docs_ckeditor_uraian" class="form-control"></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Penilaian:</label>
                        <textarea name="penilaian" id="kt_docs_ckeditor_penilaian" class="form-control"></textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Jenis Auditee:</label>
                        <input type="text" name="jenis_auditee" class="form-control" maxlength="255">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="fs-5 fw-semibold form-label mb-2">Wajib?</label>
                        <select name="is_wajib" class="form-select">
                            <option value="" selected disabled>Pilih</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        // Array of all the textarea IDs except target
        const editorFields = [
            'kt_docs_ckeditor_tujuan',
            'kt_docs_ckeditor_indikator',
            'kt_docs_ckeditor_satuan',
            'kt_docs_ckeditor_pertanyaan',
            'kt_docs_ckeditor_sumber',
            'kt_docs_ckeditor_uraian',
            'kt_docs_ckeditor_penilaian'
        ];

        // Initialize CKEditor for each textarea
        editorFields.forEach(id => {
            const element = document.querySelector(`#${id}`);
            if (element) {
                ClassicEditor
                    .create(element, {
                        toolbar: ['bold', 'italic', 'link', 'undo', 'redo'],
                        height: '200px',  // Mengatur tinggi editor di sini
                    })
                    .then(editor => {
                        console.log(`${id} initialized`);
                    })
                    .catch(error => {
                        console.error(`Error initializing ${id}:`, error);
                    });
            }
        });

    </script>

    <script>
        $(document).ready(function () {
            $('#kt_modal_form').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action') || "{{ route('instrumenIkss.store') }}";
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
