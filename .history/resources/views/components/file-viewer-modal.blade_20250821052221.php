@props(['id' => 'fileViewerModal', 'title' => 'Preview File'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-0">
                <div id="fileViewerContent">
                    <!-- File viewer akan diisi di sini -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Fungsi untuk membuka file viewer modal
function openFileViewer(fileUrl, fileName, modalId = '{{ $id }}') {
    const modal = document.getElementById(modalId);
    const content = modal.querySelector('#fileViewerContent');

    // Tampilkan loading
    content.innerHTML = `
        <div class="text-center p-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Memuat file...</p>
        </div>
    `;

    // Buka modal
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();

    // Load file viewer component via AJAX
    fetch(`/file-viewer?url=${encodeURIComponent(fileUrl)}&name=${encodeURIComponent(fileName)}`)
        .then(response => response.text())
        .then(html => {
            content.innerHTML = html;
        })
        .catch(error => {
            content.innerHTML = `
                <div class="text-center p-5">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <h6 class="text-warning">Gagal memuat file</h6>
                    <p class="text-muted mb-3">Terjadi kesalahan saat memuat preview file.</p>
                    <a href="${fileUrl}" download="${fileName}" class="btn btn-primary">
                        <i class="fas fa-download me-1"></i> Download File
                    </a>
                </div>
            `;
        });
}

// Fungsi untuk membuka file viewer dengan data dari button
function openFileViewerFromButton(button) {
    const fileUrl = button.getAttribute('data-file-url');
    const fileName = button.getAttribute('data-file-name');

    if (fileUrl && fileName) {
        openFileViewer(fileUrl, fileName);
    } else {
        console.error('Data file tidak lengkap');
    }
}
</script>
