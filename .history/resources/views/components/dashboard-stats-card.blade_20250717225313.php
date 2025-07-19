@props([
    'title' => '',
    'value' => 0,
    'icon' => 'ki-duotone ki-chart-line',
    'color' => 'primary',
    'description' => ''
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
        <div class="d-flex align-items-center">
            <div class="flex-grow-1">
                <div class="h-8px bg-white rounded">
                    <div class="bg-{{ $color }} rounded h-8px" style="width: {{ $percentage }}%"></div>
                </div>
            </div>
            <span class="badge badge-light-{{ $color }} fs-8 fw-bold ms-2">
                <i class="ki-duotone ki-arrow-{{ $trend }} fs-6 me-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                {{ $percentage }}%
            </span>
        </div>
        @if($description)
        <div class="text-gray-600 fw-semibold fs-7 mt-2">{{ $description }}</div>
        @endif
    </div>
</div>
