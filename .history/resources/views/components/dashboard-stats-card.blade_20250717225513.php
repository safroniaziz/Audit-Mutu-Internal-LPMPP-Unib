@props([
    'title' => '',
    'value' => 0,
    'icon' => 'ki-duotone ki-chart-line',
    'color' => 'primary',
    'description' => '',
    'percentage' => null,
    'subtitle' => null,
    'details' => []
])

<div class="card card-custom card-stretch gutter-b">
    <div class="card-body p-0">
        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
            <div class="d-flex flex-column flex-grow-1">
                <div class="d-flex align-items-center mb-2">
                    <div class="symbol symbol-45px me-3">
                        <div class="symbol-label bg-light-{{ $color }}">
                            <i class="{{ $icon }} fs-2x text-{{ $color }}"></i>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="text-dark fw-bold fs-6">{{ $title }}</span>
                        <span class="text-muted fw-semibold fs-7">{{ $description }}</span>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <span class="text-dark fw-bold fs-2x me-2">{{ $value }}</span>
                    @if(isset($percentage) && $percentage !== null)
                        <div class="d-flex align-items-center">
                            @if($percentage >= 0)
                                <span class="badge badge-light-success fs-8 fw-bold">
                                    <i class="fas fa-arrow-up fs-7 me-1"></i>{{ number_format($percentage, 1) }}%
                                </span>
                            @else
                                <span class="badge badge-light-danger fs-8 fw-bold">
                                    <i class="fas fa-arrow-down fs-7 me-1"></i>{{ number_format(abs($percentage), 1) }}%
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                @if(isset($subtitle))
                    <div class="d-flex align-items-center mt-2">
                        <span class="text-muted fs-7 fw-semibold">{{ $subtitle }}</span>
                    </div>
                @endif

                @if(isset($details))
                    <div class="mt-3">
                        <div class="d-flex flex-column">
                            @foreach($details as $detail)
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="text-muted fs-8">{{ $detail['label'] }}</span>
                                    <span class="text-dark fs-8 fw-semibold">{{ $detail['value'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
