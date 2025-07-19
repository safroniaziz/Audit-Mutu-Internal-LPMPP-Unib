@props([
    'title' => '',
    'value' => 0,
    'description' => '',
    'icon' => 'ki-duotone ki-chart-line',
    'color' => 'primary'
])

<div class="card card-flush border-0 bg-white shadow-sm h-100">
    <div class="card-body p-6">
        <div class="d-flex align-items-center mb-3">
            <div class="symbol symbol-50px me-4">
                <div class="symbol-label bg-{{ $color }} bg-opacity-10">
                    <i class="{{ $icon }} fs-2x text-{{ $color }}">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="fs-2hx fw-bold text-dark">{{ number_format($value) }}</div>
                <div class="text-gray-600 fw-semibold fs-6">{{ $title }}</div>
            </div>
        </div>

        @if($description)
        <div class="text-gray-600 fw-semibold fs-7 mt-2">{{ $description }}</div>
        @endif
    </div>
</div>
