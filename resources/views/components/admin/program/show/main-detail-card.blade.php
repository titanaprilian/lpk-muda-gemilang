@props(['program'])

<div class="card border-0 shadow-sm rounded-4 mb-4">

    {{-- Hero Image --}}
    <div class="card-img-top bg-light position-relative" style="height: 300px; overflow: hidden;">
        @if ($program->image)
            <img src="{{ asset('storage/' . $program->image) }}" class="w-100 h-100 object-fit-cover"
                alt="{{ $program->program_name }}">
        @else
            <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                <div class="text-center">
                    <i class="fas fa-image fa-3x mb-2 opacity-50"></i>
                    <p>Tidak ada gambar utama</p>
                </div>
            </div>
        @endif
    </div>

    <div class="card-body p-4">
        {{-- Title & Slug --}}
        <div class="mb-4">
            <h3 class="fw-bold text-dark mb-1">{{ $program->program_name }}</h3>
            <div class="text-muted small">
                <i class="fas fa-link me-1"></i> Slug:
                <span class="font-monospace bg-light px-2 py-1 rounded">/{{ $program->slug }}</span>
            </div>
        </div>

        {{-- Short Description --}}
        <div class="alert alert-light border mb-4">
            <strong><i class="fas fa-quote-left me-2 text-primary"></i>Deskripsi Singkat:</strong>
            <p class="mb-0 mt-1 text-muted">{{ $program->description }}</p>
        </div>

        <hr class="opacity-25 my-4">

        {{-- Main Content (HTML) --}}
        <h5 class="fw-bold text-primary mb-3">
            <i class="fas fa-align-left me-2"></i>Konten Lengkap
        </h5>

        {{-- Use trix-content class to apply Trix's default styling --}}
        <div class="trix-content">
            {!! $program->content !!}
        </div>
    </div>
</div>
