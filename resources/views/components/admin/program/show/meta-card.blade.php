@props(['program'])

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white py-3 border-bottom-0">
        <h6 class="mb-0 fw-bold text-primary">
            <i class="fas fa-info-circle me-2"></i> Status & Aksi
        </h6>
    </div>
    <div class="card-body p-4">

        {{-- Status --}}
        <div class="mb-4">
            <label class="small text-muted fw-bold text-uppercase ls-1">Status Publikasi</label>
            <div class="mt-2">
                @if ($program->is_active)
                    <div class="d-flex align-items-center text-success">
                        <i class="fas fa-check-circle fa-2x me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-0">Aktif</h6>
                            <small class="text-muted">Tampil di website</small>
                        </div>
                    </div>
                @else
                    <div class="d-flex align-items-center text-secondary">
                        <i class="fas fa-ban fa-2x me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-0">Non-Aktif</h6>
                            <small class="text-muted">Disembunyikan (Draft)</small>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <hr class="opacity-25 my-4">

        {{-- Timestamp --}}
        <div class="mb-3">
            <label class="small text-muted fw-bold text-uppercase ls-1">Dibuat Pada</label>
            <p class="mb-0 fw-bold">{{ $program->created_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="mb-4">
            <label class="small text-muted fw-bold text-uppercase ls-1">Terakhir Diupdate</label>
            <p class="mb-0 fw-bold">{{ $program->updated_at->diffForHumans() }}</p>
        </div>

        {{-- Actions --}}
        <div class="d-grid gap-2">
            <a href="{{ route('admin.programs.edit', $program->id) }}"
                class="btn btn-warning text-white fw-bold shadow-sm">
                <i class="fas fa-edit me-2"></i> Edit Program
            </a>

            {{-- We wire the delete action to the Livewire parent component --}}
            <button wire:click="delete" wire:confirm="Yakin ingin menghapus program ini secara permanen?"
                class="btn btn-outline-danger fw-bold">
                <i class="fas fa-trash me-2"></i> Hapus
            </button>
        </div>
    </div>
</div>
