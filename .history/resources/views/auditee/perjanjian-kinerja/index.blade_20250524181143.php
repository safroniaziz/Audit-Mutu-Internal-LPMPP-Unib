@extends('layouts.dashboard2')

@section('userName')
    {{ Auth::user()->name }}
@endsection

@section('userEmail')
    {{ Auth::user()->email }}
@endsection

@section('content')
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="row mb-7">
            <!--begin::Progress-->
            <div class="card-body">
                <!--begin::Heading-->
                <div class="card-px text-center pt-15 pb-15">
                    <!--begin::Title-->
                    <h2 class="fs-2x fw-bold mb-0">Unggah Perjanjian Kinerja</h2>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <p class="text-gray-400 fs-4 fw-semibold py-7">
                        Silakan unggah dokumen Perjanjian Kinerja Anda.<br/>
                        Format yang diperbolehkan: PDF, DOC, DOCX (Maks. 10MB)
                    </p>
                    <!--end::Description-->

                    @if($perjanjianKinerja)
                        <!--begin::Uploaded Document-->
                        <div class="d-flex flex-column align-items-center mb-7">
                            <div class="symbol symbol-60px symbol-2by3 me-4">
                                <div class="symbol-label" style="background-image: url('{{ asset('assets/media/svg/files/pdf.svg') }}')"></div>
                            </div>
                            <div class="d-flex flex-column align-items-center mt-4">
                                <span class="fs-5 fw-bold text-gray-900 mb-2">{{ $perjanjianKinerja->nama_file }}</span>
                                <div class="fs-7 fw-semibold text-gray-400 mb-4">Ukuran: {{ number_format($perjanjianKinerja->size / 1024, 2) }} KB</div>
                                <div class="d-flex">
                                    <a href="{{ route('auditee.perjanjian-kinerja.download', $perjanjianKinerja->id) }}"
                                       class="btn btn-sm btn-light-primary me-2">
                                        <i class="fas fa-download"></i> Unduh
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-light-danger delete-file"
                                            data-id="{{ $perjanjianKinerja->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--end::Uploaded Document-->
                    @else
                        <!--begin::Upload button-->
                        <div class="text-center px-4">
                            <form id="uploadForm" enctype="multipart/form-data">
                                @csrf
                                <input type="file"
                                       name="file"
                                       id="file"
                                       class="d-none"
                                       accept=".pdf,.doc,.docx">
                                <button type="button"
                                        class="btn btn-primary"
                                        onclick="document.getElementById('file').click()">
                                    <i class="fas fa-upload"></i> Unggah Dokumen
                                </button>
                            </form>
                        </div>
                        <!--end::Upload button-->
                    @endif
                </div>
                <!--end::Heading-->
            </div>
            <!--end::Progress-->
        </div>
        <!--end::Details-->
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle file selection
    document.getElementById('file')?.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            const formData = new FormData();
            formData.append('file', file);

            // Show loading state
            Swal.fire({
                title: 'Mengunggah...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Upload file
            fetch('{{ route("auditee.perjanjian-kinerja.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        showConfirmButton: true
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.message || 'Terjadi kesalahan saat mengunggah file',
                    showConfirmButton: true
                });
            });
        }
    });

    // Handle file deletion
    document.querySelector('.delete-file')?.addEventListener('click', function() {
        const fileId = this.dataset.id;

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "File yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ route('auditee.perjanjian-kinerja.destroy', '') }}/${fileId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            showConfirmButton: true
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        throw new Error(data.message);
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: error.message || 'Terjadi kesalahan saat menghapus file',
                        showConfirmButton: true
                    });
                });
            }
        });
    });
});
</script>
@endpush
