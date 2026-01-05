<?php

use Livewire\Volt\Component;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    public Program $program;

    public function mount($id)
    {
        $this->program = Program::findOrFail($id);
    }

    public function delete()
    {
        // 1. Delete Image
        if ($this->program->image) {
            Storage::disk('public')->delete($this->program->image);
        }

        // 2. Delete Record
        $this->program->delete();

        // 3. Notify & Redirect
        $this->dispatch('alert', type: 'success', message: 'Program berhasil dihapus.');

        return redirect()->route('admin.programs.index');
    }
}; ?>

<div class="page-wrapper">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold">Detail Program</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.programs.index') }}" class="text-decoration-none">Daftar Program</a>
                    </li>
                    <li class="breadcrumb-item active text-muted">{{ Str::limit($program->program_name, 30) }}</li>
                </ol>
            </nav>
        </div>

        <div>
            <a href="{{ route('admin.programs.index') }}" class="btn btn-light border shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left Column: Content --}}
        <div class="col-lg-8">
            <x-admin.program.show.main-detail-card :program="$program" />
        </div>

        {{-- Right Column: Sidebar --}}
        <div class="col-lg-4">
            <x-admin.program.show.meta-card :program="$program" />
        </div>
    </div>
</div>
