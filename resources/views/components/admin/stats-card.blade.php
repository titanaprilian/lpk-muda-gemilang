@props(['title', 'value', 'percentage', 'isIncrease' => true, 'icon', 'color' => 'primary', 'delay' => 0])

<div class="col-xl-3 col-md-6 mb-4">
    {{-- ADDED 'h-100' HERE --}}
    <div class="card fade-in h-100" style="animation-delay: {{ $delay }}s">
        <div class="card-body">
            {{-- Added 'h-100' to this inner flex container to ensure vertical centering if needed --}}
            <div class="d-flex justify-content-between align-items-center h-100">
                <div>
                    <h6 class="text-muted mb-1">{{ $title }}</h6>
                    <h3 class="mb-0">{{ $value }}</h3>
                    <small class="{{ $isIncrease ? 'text-success' : 'text-danger' }} fw-bold">
                        {{-- Added logic to handle text vs percentage --}}
                        @if (str_contains($percentage, '%'))
                            <i class="fas fa-arrow-{{ $isIncrease ? 'up' : 'down' }} me-1"></i>
                        @endif
                        {{ $percentage }}
                    </small>
                </div>
                <div class="bg-{{ $color }} bg-opacity-10 p-3 rounded">
                    <i class="{{ $icon }} fa-2x text-{{ $color }}"></i>
                </div>
            </div>
        </div>
    </div>
</div>
