@props([
    'type' => 'info',
    'title' => '',
    'message' => '',
    'dismissible' => true,
    'autoHide' => false,
    'autoHideDelay' => 5000,
    'icon' => null,
    'action' => null,
    'actionText' => '',
    'actionUrl' => ''
])

@php
    $alertClasses = [
        'info' => 'border-primary bg-primary-subtle text-primary-emphasis',
        'success' => 'border-success bg-success-subtle text-success-emphasis',
        'warning' => 'border-warning bg-warning-subtle text-warning-emphasis',
        'danger' => 'border-danger bg-danger-subtle text-danger-emphasis',
        'dark' => 'border-dark bg-dark-subtle text-dark-emphasis'
    ];

    $iconClasses = [
        'info' => 'ki-duotone ki-information-5 fs-2 text-primary',
        'success' => 'ki-duotone ki-check-circle fs-2 text-success',
        'warning' => 'ki-duotone ki-shield-tick fs-2 text-warning',
        'danger' => 'ki-duotone ki-shield-cross fs-2 text-danger',
        'dark' => 'ki-duotone ki-shield fs-2 text-dark'
    ];

    $defaultIcons = [
        'info' => 'ki-duotone ki-information-5',
        'success' => 'ki-duotone ki-check-circle',
        'warning' => 'ki-duotone ki-shield-tick',
        'danger' => 'ki-duotone ki-shield-cross',
        'dark' => 'ki-duotone ki-shield'
    ];

    $alertClass = $alertClasses[$type] ?? $alertClasses['info'];
    $iconClass = $icon ?? $defaultIcons[$type];
@endphp

<div id="modern-alert-{{ uniqid() }}"
     class="modern-alert alert alert-dismissible fade show border-0 shadow-sm mb-4 {{ $alertClass }}"
     role="alert"
     @if($autoHide) data-auto-hide="{{ $autoHideDelay }}" @endif>

    <div class="d-flex align-items-center">
        <!-- Icon -->
        <div class="flex-shrink-0 me-3">
            <i class="{{ $iconClass }} fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>

        <!-- Content -->
        <div class="flex-grow-1">
            @if($title)
                <h6 class="alert-heading fw-bold mb-1">{{ $title }}</h6>
            @endif
            @if($message)
                <p class="mb-0">{{ $message }}</p>
            @endif
            {{ $slot }}
        </div>

        <!-- Action Button -->
        @if($action && $actionText)
            <div class="flex-shrink-0 ms-3">
                @if($actionUrl)
                    <a href="{{ $actionUrl }}" class="btn btn-sm btn-outline-{{ $type }}">
                        {{ $actionText }}
                    </a>
                @else
                    <button type="button" class="btn btn-sm btn-outline-{{ $type }}" onclick="{{ $action }}">
                        {{ $actionText }}
                    </button>
                @endif
            </div>
        @endif

        <!-- Dismiss Button -->
        @if($dismissible)
            <div class="flex-shrink-0 ms-2">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>

<style>
.modern-alert {
    border-radius: 12px !important;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    border-left: 4px solid !important;
}

.modern-alert:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.modern-alert.alert-dismissible .btn-close {
    padding: 0.75rem;
    margin: 0;
    border-radius: 50%;
    transition: all 0.2s ease;
}

.modern-alert.alert-dismissible .btn-close:hover {
    background-color: rgba(255,255,255,0.2);
    transform: scale(1.1);
}

.modern-alert.fade {
    transition: opacity 0.3s ease-in-out;
}

.modern-alert.fade.show {
    opacity: 1;
}

/* Custom animations */
@keyframes slideInFromTop {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes slideInFromRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.modern-alert.slide-in-top {
    animation: slideInFromTop 0.5s ease-out;
}

.modern-alert.slide-in-right {
    animation: slideInFromRight 0.5s ease-out;
}

/* Responsive */
@media (max-width: 768px) {
    .modern-alert .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
    }

    .modern-alert .flex-shrink-0 {
        margin-bottom: 0.5rem;
    }

    .modern-alert .btn-close {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide functionality
    const alerts = document.querySelectorAll('.modern-alert[data-auto-hide]');
    alerts.forEach(alert => {
        const delay = parseInt(alert.dataset.autoHide);
        setTimeout(() => {
            if (alert.classList.contains('show')) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, delay);
    });

    // Add slide-in animation
    const newAlerts = document.querySelectorAll('.modern-alert:not(.slide-in-top):not(.slide-in-right)');
    newAlerts.forEach((alert, index) => {
        setTimeout(() => {
            alert.classList.add('slide-in-top');
        }, index * 100);
    });
});
</script>
