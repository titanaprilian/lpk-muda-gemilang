@props(['image'])

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white py-3 border-bottom-0">
        <h6 class="mb-0 fw-bold text-primary">
            <i class="fas fa-image me-2"></i> Preview & Deskripsi
        </h6>
    </div>
    <div class="card-body p-4">
        {{-- Large Image Preview --}}
        <div class="bg-light rounded-3 p-2 mb-4 d-flex justify-content-center align-items-center"
            style="min-height: 300px;">
            <img src="{{ $image->url }}" alt="{{ $image->title }}" class="img-fluid rounded shadow-sm"
                style="max-height: 500px; object-fit: contain;">
        </div>

        {{-- Title --}}
        <h5 class="fw-bold text-dark mb-2">{{ $image->title ?? 'Tanpa Judul' }}</h5>

        {{-- Description --}}
        @if ($image->description)
            <div class="p-3 bg-light rounded-3 text-muted">
                {{ $image->description }}
            </div>
        @else
            <p class="text-muted fst-italic mb-0">Tidak ada deskripsi tersedia.</p>
        @endif
    </div>
</div>
