@extends('auditee/dashboard_template')

@section('dashboardProfile')
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center p-5 mb-6">
            <i class="fas fa-check-circle fs-2 text-success me-3"></i>
            <div class="fw-semibold">{{ session('success') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger d-flex align-items-start p-5 mb-6">
            <i class="fas fa-exclamation-triangle fs-2 text-danger me-3 mt-1"></i>
            <div>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="row g-5 g-xl-8">
        <!-- Kolom Kiri: Informasi Selamat Datang -->
        <div class="col-xl-7">
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                            👋 Selamat Datang Kaprodi, <span class="fw-bold">{{ Auth::user()->name }}</span>
                        </h3>
                    </div>
                </div>
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                        <div class="me-4">
                            <i class="bi bi-info-circle-fill fs-2 text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h4 class="fw-bold text-dark mb-2">📢 Informasi Periode Aktif</h4>
                            <div class="fs-6 text-gray-700">
                                <p>
                                    <strong>Saat ini, periode yang sedang aktif adalah</strong>
                                    <span class="fw-semibold text-primary">
                                        Nomor Surat: {{ $periodeAktif ? $periodeAktif->nomor_surat : 'Data tidak tersedia' }}
                                    </span>
                                </p>
                                <p>
                                    <strong>Tahun AMI:</strong>
                                    <span class="fw-semibold text-primary">
                                        {{ $periodeAktif ? $periodeAktif->tahun_ami : 'Data tidak tersedia' }}
                                    </span>
                                </p>
                                <p>
                                    <strong>Jadwal input data oleh auditee:</strong>
                                    <span class="fw-semibold text-primary">
                                        @if ($jadwalData)
                                            @if ($jadwalData->waktu_mulai && $jadwalData->waktu_selesai)
                                                {{ \Carbon\Carbon::parse($jadwalData->waktu_mulai)->format('d F Y') }} - {{ \Carbon\Carbon::parse($jadwalData->waktu_selesai)->format('d F Y') }}
                                            @elseif ($jadwalData->waktu_selesai)
                                                Berakhir pada {{ \Carbon\Carbon::parse($jadwalData->waktu_selesai)->format('d F Y') }} pukul {{ \Carbon\Carbon::parse($jadwalData->waktu_selesai)->format('H:i') }}
                                            @else
                                                Data tidak tersedia
                                            @endif
                                        @else
                                            Data tidak tersedia
                                        @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('auditee.pengajuanAmi') }}" class="btn btn-sm btn-primary px-4"><i class="fas fa-arrow-right me-2"></i> Ajukan Permohonan</a>
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>

        <!-- Kolom Kanan: Tanda Tangan Auditee -->
        <div class="col-xl-5">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title text-primary fw-bold">
                        <i class="fas fa-signature fs-2 me-2"></i> Tanda Tangan Auditee
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="text-muted fs-7 mb-2">TTD saat ini</div>
                        <div class="border rounded p-4 text-center bg-light position-relative">
                            @if (Auth::user()->ttd)
                                <img src="{{ asset('storage/' . Auth::user()->ttd) }}" alt="TTD Auditee" style="max-height: 90px;">
                                <form action="{{ route('auditee.deleteTtd') }}" method="POST" class="position-absolute top-0 end-0 m-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-sm btn-light-danger" data-bs-toggle="tooltip" title="Hapus Tanda Tangan" onclick="return confirm('Apakah Anda yakin ingin menghapus tanda tangan saat ini?')">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">Belum ada tanda tangan</span>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('auditee.updateTtd') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Upload TTD Baru (PNG/JPG, maks 350KB)</label>
                            
                            <div class="drag-drop-zone-ttd" id="dragDropZoneTtd" onclick="openFileDialogTtd()">
                                <input type="file" name="ttd" id="ttdFileInput" accept=".png,.jpg,.jpeg" style="display: none;" onchange="handleFileChangeTtd(event)" required />
                                <div class="upload-content-ttd text-center" id="uploadContentTtd">
                                    <div class="upload-icon mb-3 mt-3">
                                        <i class="fas fa-cloud-upload-alt fs-2x text-primary"></i>
                                    </div>
                                    <h5 class="fw-bold text-gray-800 mb-1">Tarik & lepas file TTD di sini</h5>
                                    <p class="text-muted fs-7 mb-3">atau klik untuk menelusuri berkas</p>
                                </div>
                                <div class="preview-container-ttd text-center d-none p-4" id="previewContainerTtd">
                                    <!-- Image preview will be injected here -->
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary" id="btnSubmitTtd" disabled>
                                <i class="fas fa-upload me-2"></i> Simpan TTD
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('styles')
    <style>
        .drag-drop-zone-ttd {
            width: 100%;
            min-height: 180px;
            border: 2px dashed #D3D3D3;
            border-radius: 12px;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f4fd 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .drag-drop-zone-ttd:hover {
            border-color: #009EF7;
            background: linear-gradient(135deg, #e8f4fd 0%, #009ef715 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 158, 247, 0.1);
        }

        .drag-drop-zone-ttd.drag-over {
            border-color: #50CD89;
            background: linear-gradient(135deg, #e8fff3 0%, #50cd8915 100%);
            transform: scale(1.01);
            box-shadow: 0 15px 30px rgba(80, 205, 137, 0.15);
        }

        .drag-drop-zone-ttd .upload-icon {
            transition: all 0.3s ease;
        }

        .drag-drop-zone-ttd:hover .upload-icon {
            transform: translateY(-3px);
        }

        .drag-drop-zone-ttd.success-upload-ttd {
            border-color: #50CD89 !important;
            background: linear-gradient(135deg, #e8fff3 0%, #50cd8910 100%) !important;
        }

        .preview-img-ttd {
            max-height: 110px;
            max-width: 90%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
    </style>
@endpush

@push('scripts')
<script>
    const dropZone = document.getElementById('dragDropZoneTtd');
    const fileInput = document.getElementById('ttdFileInput');
    const uploadContent = document.getElementById('uploadContentTtd');
    const previewContainer = document.getElementById('previewContainerTtd');
    const submitBtn = document.getElementById('btnSubmitTtd');

    function openFileDialogTtd() {
        fileInput.click();
    }

    function handleFileChangeTtd(e) {
        const file = e.target.files[0];
        if (file) {
            processFile(file);
        }
    }

    function processFile(file) {
        if (!file.type.match('image.*')) {
            Swal.fire({
                icon: 'error',
                title: 'File tidak valid!',
                text: 'Silakan pilih file gambar (JPG, JPEG, PNG)',
            });
            resetFormTtd();
            return;
        }

        if (file.size > 358400) {
            Swal.fire({
                icon: 'error',
                title: 'File terlalu besar!',
                text: 'Ukuran file maksimal 350KB',
            });
            resetFormTtd();
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewContainer.innerHTML = `
                <div class="position-relative d-inline-block">
                    <img src="${e.target.result}" class="preview-img-ttd">
                    <button type="button" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 end-0 translate-middle" onclick="resetFormTtd(event)" title="Hapus berkas terpilih">
                        <i class="fas fa-times fs-6 text-danger"></i>
                    </button>
                </div>
                <div class="mt-3 text-success fw-semibold fs-7">${file.name} (${(file.size/1024).toFixed(1)} KB)</div>
            `;
            
            uploadContent.classList.add('d-none');
            previewContainer.classList.remove('d-none');
            dropZone.classList.add('success-upload-ttd');
            submitBtn.disabled = false;
        }
        reader.readAsDataURL(file);
    }

    function resetFormTtd(e) {
        if (e) {
            e.stopPropagation();
        }
        fileInput.value = '';
        uploadContent.classList.remove('d-none');
        previewContainer.classList.add('d-none');
        previewContainer.innerHTML = '';
        dropZone.classList.remove('success-upload-ttd');
        submitBtn.disabled = true;
    }

    // Drag and Drop events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, e => {
            e.preventDefault();
            e.stopPropagation();
        }, false);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.add('drag-over');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.remove('drag-over');
        }, false);
    });

    dropZone.addEventListener('drop', e => {
        const dt = e.dataTransfer;
        const file = dt.files[0];
        if (file) {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;
            processFile(file);
        }
    }, false);
</script>
@endpush
@endsection
