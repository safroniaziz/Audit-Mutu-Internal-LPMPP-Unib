@props(['fileUrl', 'fileName', 'fileType'])

@php
    // Determine file type and extension
    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $isPdf = $extension === 'pdf';
    $isWord = in_array($extension, ['doc', 'docx']);
    $isExcel = in_array($extension, ['xls', 'xlsx']);
    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    $isViewable = $isPdf || $isWord || $isExcel || $isImage;
@endphp

<div class="file-viewer-container">
    @if($isPdf)
        {{-- PDF tetap tampil di browser --}}
        <div class="pdf-viewer">
            <iframe src="{{ $fileUrl }}"
                    width="100%"
                    height="600px"
                    frameborder="0"
                    style="border: 1px solid #ddd; border-radius: 8px;">
                <p>Browser Anda tidak mendukung iframe. <a href="{{ $fileUrl }}" target="_blank">Klik di sini untuk download PDF</a></p>
            </iframe>
        </div>
    @elseif($isWord || $isExcel)
        {{-- Word & Excel pakai Google Docs Viewer --}}
        <div class="google-docs-viewer">
            <div class="viewer-header mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1">{{ $fileName }}</h6>
                        <small class="text-muted">
                            @if($isWord)
                                <i class="fas fa-file-word text-primary me-1"></i> Dokumen Word
                            @else
                                <i class="fas fa-file-excel text-success me-1"></i> Dokumen Excel
                            @endif
                        </small>
                    </div>
                    <div>
                        <a href="{{ $fileUrl }}" download="{{ $fileName }}" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fas fa-download me-1"></i> Download
                        </a>
                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-external-link-alt me-1"></i> Buka di Tab Baru
                        </a>
                    </div>
                </div>
            </div>

            <div class="viewer-content">
                <iframe src="https://docs.google.com/viewer?url={{ urlencode($fileUrl) }}&embedded=true"
                        width="100%"
                        height="600px"
                        frameborder="0"
                        style="border: 1px solid #ddd; border-radius: 8px; background: #f8f9fa;">
                    <div class="text-center p-5">
                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Google Docs Viewer tidak tersedia. Silakan download file untuk membukanya.</p>
                        <a href="{{ $fileUrl }}" download="{{ $fileName }}" class="btn btn-primary">
                            <i class="fas fa-download me-1"></i> Download File
                        </a>
                    </div>
                </iframe>
            </div>
        </div>
    @elseif($isImage)
        {{-- Image tetap tampil di browser --}}
        <div class="image-viewer text-center">
            <img src="{{ $fileUrl }}"
                 alt="{{ $fileName }}"
                 class="img-fluid"
                 style="max-height: 600px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="mt-3">
                <a href="{{ $fileUrl }}" download="{{ $fileName }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-download me-1"></i> Download
                </a>
            </div>
        </div>
    @else
        {{-- File lain, tampilkan info dan tombol download --}}
        <div class="unsupported-file text-center p-5">
            <i class="fas fa-file fa-3x text-muted mb-3"></i>
            <h6 class="text-muted">{{ $fileName }}</h6>
            <p class="text-muted mb-3">File ini tidak dapat ditampilkan preview-nya.</p>
            <a href="{{ $fileUrl }}" download="{{ $fileName }}" class="btn btn-primary">
                <i class="fas fa-download me-1"></i> Download File
            </a>
        </div>
    @endif
</div>

<style>
.file-viewer-container {
    background: white;
    border-radius: 8px;
    overflow: hidden;
}

.viewer-header {
    background: #f8f9fa;
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
}

.viewer-content {
    background: white;
}

.google-docs-viewer iframe {
    min-height: 600px;
}

.pdf-viewer iframe {
    min-height: 600px;
}

.image-viewer img {
    transition: transform 0.3s ease;
}

.image-viewer img:hover {
    transform: scale(1.02);
}

.unsupported-file {
    background: #f8f9fa;
    border-radius: 8px;
}
</style>
