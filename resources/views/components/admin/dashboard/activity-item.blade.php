@props(['icon', 'title', 'description', 'time', 'color' => 'primary', 'last' => false])

<div class="list-group-item p-3 border-0 {{ !$last ? 'border-bottom' : '' }}">
    <div class="d-flex">
        <div class="bg-{{ $color }} bg-opacity-10 p-2 rounded me-3 h-100">
            <i class="{{ $icon }} text-{{ $color }}"></i>
        </div>
        <div>
            <h6 class="mb-1">{{ $title }}</h6>
            <p class="mb-0 text-muted small">{{ $description }}</p>
            <small class="text-muted" style="font-size: 0.75rem">{{ $time }}</small>
        </div>
    </div>
</div>
