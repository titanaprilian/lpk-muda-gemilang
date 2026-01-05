@props(['form'])

{{-- 1. Image Upload --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white py-3 border-bottom-0">
        <h6 class="mb-0 fw-bold text-primary"><i class="fas fa-image me-2"></i>Gambar Utama</h6>
    </div>
    <div class="card-body text-center">

        <div class="border rounded-3 p-2 bg-light position-relative mb-3 d-flex align-items-center justify-content-center"
            style="height: 200px; overflow: hidden;">
            @if ($form->image)
                <img src="{{ $form->image->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 100%;">
            @elseif ($form->existingImage)
                <img src="{{ asset('storage/' . $form->existingImage) }}" class="img-fluid rounded"
                    style="max-height: 100%;">
            @else
                <div class="text-muted opacity-50">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <p class="small mb-0">Preview</p>
                </div>
            @endif

            <div wire:loading wire:target="form.image" class="position-absolute top-50 start-50 translate-middle">
                <div class="spinner-border text-primary" role="status"></div>
            </div>
        </div>

        <input type="file" wire:model="form.image"
            class="form-control form-control-sm @error('form.image') is-invalid @enderror" accept="image/*">
        @error('form.image')
            <div class="invalid-feedback text-start">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- 2. Publish Settings --}}
<div class="card border-0 shadow-sm rounded-4 mb-4 sticky-top" style="top: 20px;">
    <div class="card-body p-4">
        <h6 class="text-uppercase text-muted fw-bold small ls-1 mb-3">
            <i class="fas fa-cog me-2"></i>Pengaturan
        </h6>

        <div class="mb-4">
            <label class="form-label small fw-bold">Status Program</label>
            <select wire:model="form.is_active" class="form-select form-select-lg">
                <option value="1">✅ Aktif</option>
                <option value="0">⛔ Non-Aktif</option>
            </select>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">
                    <i class="fas fa-save me-1"></i> Simpan Data
                </span>
                <span wire:loading wire:target="save">
                    <i class="fas fa-spinner fa-spin me-1"></i> Proses...
                </span>
            </button>
        </div>
    </div>
</div>
