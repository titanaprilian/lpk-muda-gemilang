@props(['form'])

<div class="card border-0 shadow-sm rounded-4 mb-4 sticky-top" style="top: 20px; z-index: 1;">
    <div class="card-body p-4">
        <h6 class="text-uppercase text-muted fw-bold small ls-1 mb-3">
            <i class="fas fa-cog me-2"></i>Pengaturan
        </h6>

        {{-- Visibility Selection --}}
        <div class="mb-4">
            <label class="form-label small fw-bold">Visibilitas</label>
            <select wire:model="form.is_public"
                class="form-select form-select-lg @error('form.is_public') is-invalid @enderror">
                <option value="1">🌐 Publik</option>
                <option value="0">🔒 Privat (Arsip)</option>
            </select>
            <div class="form-text small mt-2">
                <strong>Publik:</strong> Tampil di halaman depan website.<br>
                <strong>Privat:</strong> Hanya terlihat oleh admin.
            </div>
            @error('form.is_public')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr class="text-muted opacity-25">

        {{-- Submit Button --}}
        <div class="d-grid">
            <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">
                    <i class="fas fa-check-circle me-2"></i> Simpan Perubahan
                </span>
                <span wire:loading wire:target="save">
                    <i class="fas fa-spinner fa-spin me-1"></i> Proses...
                </span>
            </button>
        </div>
    </div>
</div>
