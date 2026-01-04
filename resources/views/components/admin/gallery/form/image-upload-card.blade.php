@props(['form'])

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white py-3 border-bottom-0">
        <h6 class="mb-0 fw-bold text-primary"><i class="fas fa-image me-2"></i>File Gambar</h6>
    </div>
    <div class="card-body">

        {{-- Preview Box --}}
        <div class="border rounded-3 p-2 text-center bg-light position-relative mb-3"
            style="height: 300px; display: flex; align-items: center; justify-content: center; overflow: hidden;">

            @if ($form->image)
                {{-- New Upload Preview --}}
                <img src="{{ $form->image->temporaryUrl() }}" class="img-fluid rounded shadow-sm"
                    style="max-height: 100%; object-fit: contain;">
            @elseif ($form->galleryImage && $form->galleryImage->file_path)
                {{-- Existing Database Image --}}
                <img src="{{ $form->galleryImage->url }}" class="img-fluid rounded shadow-sm"
                    style="max-height: 100%; object-fit: contain;">
            @else
                {{-- Placeholder --}}
                <div class="text-muted opacity-50">
                    <i class="fas fa-cloud-upload-alt fa-4x mb-3"></i>
                    <p class="small mb-0 fw-bold">Belum ada gambar yang dipilih</p>
                </div>
            @endif

            {{-- Loading Spinner --}}
            <div wire:loading wire:target="form.image" class="position-absolute top-50 start-50 translate-middle">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
            </div>
        </div>

        {{-- Input --}}
        <div class="mb-2">
            <input type="file" wire:model="form.image" class="form-control @error('form.image') is-invalid @enderror"
                accept="image/*">
            @error('form.image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-text small text-muted">
            <i class="fas fa-info-circle me-1"></i> Format: JPG, PNG, WEBP. Maksimal ukuran file: 2MB.
        </div>
    </div>
</div>
