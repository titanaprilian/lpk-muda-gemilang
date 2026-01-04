@props(['form'])

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white py-3 border-bottom-0">
        <h6 class="mb-0 fw-bold text-primary"><i class="fas fa-align-left me-2"></i>Informasi Detail</h6>
    </div>
    <div class="card-body">
        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label small fw-bold">Judul Kegiatan</label>
            <input type="text" wire:model="form.title"
                class="form-control form-control-lg @error('form.title') is-invalid @enderror"
                placeholder="Contoh: Perayaan HUT RI ke-79">
            @error('form.title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-0">
            <label class="form-label small fw-bold">Deskripsi / Keterangan</label>
            <textarea wire:model="form.description" class="form-control @error('form.description') is-invalid @enderror"
                rows="5" placeholder="Tambahkan detail mengenai kegiatan ini..."></textarea>
            @error('form.description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
