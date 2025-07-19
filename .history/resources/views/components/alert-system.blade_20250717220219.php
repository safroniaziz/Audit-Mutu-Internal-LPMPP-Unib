@if(session('success'))
    <x-modern-alert
        type="success"
        title="Berhasil!"
        :message="session('success')"
        :autoHide="true"
        :autoHideDelay="4000"
    />
@endif

@if(session('error'))
    <x-modern-alert
        type="danger"
        title="Terjadi Kesalahan!"
        :message="session('error')"
        :autoHide="true"
        :autoHideDelay="6000"
    />
@endif

@if(session('warning'))
    <x-modern-alert
        type="warning"
        title="Peringatan!"
        :message="session('warning')"
        :autoHide="true"
        :autoHideDelay="5000"
    />
@endif

@if(session('info'))
    <x-modern-alert
        type="info"
        title="Informasi"
        :message="session('info')"
        :autoHide="true"
        :autoHideDelay="4000"
    />
@endif

@if($errors->any())
    <x-modern-alert
        type="danger"
        title="Validasi Error"
        :dismissible="true"
        :autoHide="false"
    >
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-modern-alert>
@endif

<!-- Custom Alert for Periode Aktif -->
@if(request()->routeIs('periodeAktif.*') || request()->routeIs('*periode*'))
    <x-modern-alert
        type="warning"
        title="Perhatian Penting!"
        message="Jika Anda ingin menghapus data Periode Aktif, harap pastikan data tersebut telah dinonaktifkan terlebih dahulu untuk menghindari konflik dengan data yang terkait."
        :dismissible="true"
        :autoHide="false"
        actionText="Lihat Panduan"
        actionUrl="#"
        icon="ki-duotone ki-shield-tick"
    />
@endif

<!-- Custom Alert for Data Management -->
@if(request()->routeIs('*kriteria*') || request()->routeIs('*indikator*') || request()->routeIs('*instrumen*'))
    @if(request()->routeIs('indikatorInstrumen.getKriteria'))
        <x-modern-alert
            type="info"
            title="Informasi Indikator"
            message="Menampilkan kriteria penilaian untuk indikator yang dipilih. Anda dapat menambah, mengedit, atau menghapus kriteria sesuai kebutuhan."
            :dismissible="true"
            :autoHide="false"
            icon="ki-duotone ki-information-5"
        />
    @else
        <x-modern-alert
            type="info"
            title="Tips Pengelolaan Data"
            message="Pastikan untuk selalu memvalidasi data sebelum menyimpan. Data yang sudah terkait dengan elemen lain tidak dapat dihapus secara langsung."
            :dismissible="true"
            :autoHide="true"
            :autoHideDelay="8000"
            icon="ki-duotone ki-information-5"
        />
    @endif
@endif

<!-- Custom Alert for Audit Process -->
@if(request()->routeIs('*audit*') || request()->routeIs('*evaluasi*'))
    <x-modern-alert
        type="success"
        title="Proses Audit"
        message="Sistem audit internal membantu memastikan kualitas dan kepatuhan terhadap standar yang telah ditetapkan."
        :dismissible="true"
        :autoHide="true"
        :autoHideDelay="6000"
        icon="ki-duotone ki-check-circle"
    />
@endif

<!-- Custom Alert for User Management -->
@if(request()->routeIs('*user*') || request()->routeIs('*admin*') || request()->routeIs('*auditor*'))
    <x-modern-alert
        type="dark"
        title="Manajemen Pengguna"
        message="Kelola hak akses pengguna dengan bijak. Setiap perubahan role akan mempengaruhi kemampuan akses ke fitur tertentu."
        :dismissible="true"
        :autoHide="true"
        :autoHideDelay="7000"
        icon="ki-duotone ki-shield"
    />
@endif

<script>
// Global function to show custom alerts
window.showModernAlert = function(type, title, message, options = {}) {
    const defaultOptions = {
        dismissible: true,
        autoHide: false,
        autoHideDelay: 5000,
        actionText: '',
        actionUrl: '',
        action: null
    };

    const config = { ...defaultOptions, ...options };

    // Create alert HTML
    const alertHtml = `
        <div class="modern-alert alert alert-dismissible fade show border-0 shadow-sm mb-4 slide-in-right"
             role="alert"
             ${config.autoHide ? `data-auto-hide="${config.autoHideDelay}"` : ''}>
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <i class="ki-duotone ki-information-5 fs-2 text-${type}">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="alert-heading fw-bold mb-1">${title}</h6>
                    <p class="mb-0">${message}</p>
                </div>
                ${config.actionText ? `
                    <div class="flex-shrink-0 ms-3">
                        ${config.actionUrl ?
                            `<a href="${config.actionUrl}" class="btn btn-sm btn-outline-${type}">${config.actionText}</a>` :
                            `<button type="button" class="btn btn-sm btn-outline-${type}" onclick="${config.action}">${config.actionText}</button>`
                        }
                    </div>
                ` : ''}
                ${config.dismissible ? `
                    <div class="flex-shrink-0 ms-2">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ` : ''}
            </div>
        </div>
    `;

    // Insert alert at the top of the content area
    const contentArea = document.querySelector('#kt_app_content_container') || document.querySelector('.app-container') || document.body;
    contentArea.insertAdjacentHTML('afterbegin', alertHtml);

    // Auto-hide if enabled
    if (config.autoHide) {
        setTimeout(() => {
            const alert = contentArea.querySelector('.modern-alert');
            if (alert && alert.classList.contains('show')) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, config.autoHideDelay);
    }
};

// Example usage:
// showModernAlert('success', 'Berhasil!', 'Data berhasil disimpan', { autoHide: true });
// showModernAlert('warning', 'Peringatan!', 'Data akan dihapus', { actionText: 'Batal', action: 'cancelDelete()' });
</script>
