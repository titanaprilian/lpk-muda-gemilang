@props(['image'])

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white py-3 border-bottom-0">
        <h6 class="mb-0 fw-bold text-primary">
            <i class="fas fa-info-circle me-2"></i> Informasi Status
        </h6>
    </div>
    <div class="card-body p-4">

        {{-- Visibility Status --}}
        <div class="mb-4">
            <label class="small text-muted fw-bold text-uppercase ls-1">Visibilitas</label>
            <div class="mt-1">
                @if ($image->is_public)
                    <span class="badge bg-success rounded-pill px-3 py-2">
                        <i class="fas fa-globe me-2"></i> Publik
                    </span>
                    <div class="small text-muted mt-2">
                        Gambar ini <strong>tampil</strong> di halaman depan website.
                    </div>
                @else
                    <span class="badge bg-secondary rounded-pill px-3 py-2">
                        <i class="fas fa-lock me-2"></i> Privat
                    </span>
                    <div class="small text-muted mt-2">
                        Gambar ini <strong>disembunyikan</strong> dari publik.
                    </div>
                @endif
            </div>
        </div>

        <hr class="opacity-25 my-4">

        {{-- Upload Details --}}
        <div class="mb-3">
            <label class="small text-muted fw-bold text-uppercase ls-1">Tanggal Upload</label>
            <p class="mb-0 fw-bold text-dark fs-5">
                {{ $image->upload_date->format('d M Y') }}
            </p>
            <small class="text-muted">{{ $image->upload_date->format('H:i') }} WIB</small>
        </div>

        <div class="mb-3">
            <label class="small text-muted fw-bold text-uppercase ls-1">Diunggah Oleh</label>
            <div class="d-flex align-items-center mt-2">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                    style="width: 32px; height: 32px;">
                    {{ strtoupper(substr($image->uploader->name ?? 'A', 0, 1)) }}
                </div>
                <span class="fw-bold">{{ $image->uploader->name ?? 'Administrator' }}</span>
            </div>
        </div>

        {{-- Edit Action (Placed here like the Registrant actions) --}}
        <div class="d-grid mt-4">
            <a href="{{ route('admin.galleries.edit', $image->id) }}"
                class="btn btn-warning fw-bold text-white shadow-sm">
                <i class="fas fa-edit me-2"></i> Edit Data
            </a>
        </div>
    </div>
</div>
