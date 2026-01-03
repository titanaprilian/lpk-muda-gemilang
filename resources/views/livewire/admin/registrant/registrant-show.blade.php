<?php

use Livewire\Volt\Component;
use App\Models\Registrant;

new class extends Component {
    public Registrant $registrant;

    public function mount($id)
    {
        // Eager load program to avoid N+1 query
        $this->registrant = Registrant::with('program')->findOrFail($id);
    }

    public function delete()
    {
        $this->registrant->delete();

        $this->dispatch('alert', type: 'success', message: 'Data berhasil dihapus.');

        return redirect()->route('admin.registrants.index');
    }
}; ?>

<div class="page-wrapper">
    @push('styles')
        @vite('resources/css/registrant-detail.css')
    @endpush

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold">
                Detail Peserta
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.registrants.index') }}"
                            class="text-decoration-none">Daftar Peserta</a></li>
                    <li class="breadcrumb-item active text-muted">{{ $registrant->full_name }}</li>
                </ol>
            </nav>
        </div>

        <div class="btn-group shadow-sm">
            <a href="{{ route('admin.registrants.index') }}" class="btn btn-light border">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <button wire:click="delete"
                wire:confirm="Yakin ingin menghapus data {{ $registrant->full_name }}? Aksi ini tidak dapat dibatalkan."
                class="btn btn-danger">
                <i class="fas fa-trash me-1"></i> Hapus
            </button>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left Column --}}
        <div class="col-lg-8">
            <x-admin.registrant.show.personal-card :registrant="$registrant" />

            <x-admin.registrant.show.contact-physical-card :registrant="$registrant" />

            <x-admin.registrant.show.documents-card :registrant="$registrant" />
        </div>

        {{-- Right Column --}}
        <div class="col-lg-4">
            <x-admin.registrant.show.status-card :registrant="$registrant" />

            <x-admin.registrant.show.actions-card :registrant="$registrant" />
        </div>
    </div>
</div>
