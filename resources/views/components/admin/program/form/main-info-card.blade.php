@props(['form'])

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white py-3 border-bottom-0">
        <h6 class="mb-0 fw-bold text-primary"><i class="fas fa-align-left me-2"></i>Informasi Program</h6>
    </div>
    <div class="card-body">

        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label small fw-bold">Nama Program</label>
            {{-- We use wire:blur to trigger slug generation only when user finishes typing --}}
            <input type="text" wire:model.blur="form.program_name"
                class="form-control form-control-lg @error('form.program_name') is-invalid @enderror"
                placeholder="Contoh: Pelatihan Bahasa Jepang">
            @error('form.program_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Slug (Auto-generated) --}}
        <div class="mb-3">
            <label class="form-label small fw-bold">URL Slug (Otomatis)</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted border-end-0">/program/</span>
                <input type="text" wire:model="form.slug"
                    class="form-control bg-light @error('form.slug') is-invalid @enderror" readonly>
            </div>
            @error('form.slug')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Short Description --}}
        <div class="mb-3">
            <label class="form-label small fw-bold">Deskripsi Singkat</label>
            <textarea wire:model="form.description" class="form-control @error('form.description') is-invalid @enderror"
                rows="2" placeholder="Ringkasan singkat untuk tampilan kartu..."></textarea>
            <div class="form-text small">Maksimal 255 karakter.</div>
            @error('form.description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Rich Text Editor (Trix) --}}
        <div class="mb-3" wire:ignore>
            <label class="form-label small fw-bold">Konten Lengkap</label>

            {{-- Hidden input to actually store the value --}}
            <input id="content" type="hidden" name="content" value="{{ $form->content }}">

            {{-- The Editor --}}
            <trix-editor input="content" class="trix-content rounded" style="min-height: 300px;"></trix-editor>

            {{-- Script to sync Trix -> Livewire --}}
            <script>
                document.addEventListener('trix-change', function(e) {
                    @this.set('form.content', e.target.value);
                });
            </script>
        </div>
        @error('form.content')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror

    </div>
</div>
