@props(['icon', 'title', 'subtitle', 'color' => 'primary', 'link' => '#'])

<div class="col-md-3 col-6">
    {{-- Added 'h-100' and 'd-flex flex-column justify-content-center' --}}
    <a href="{{ $link }}"
        class="card action-card text-decoration-none text-center p-4 rounded h-100 d-flex flex-column justify-content-center">
        <div class="mb-3">
            <i class="{{ $icon }} fa-2x text-{{ $color }}"></i>
        </div>
        <h6>{{ $title }}</h6>
        <small class="text-muted">{{ $subtitle }}</small>
    </a>
</div>
