<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\Program;
use App\Livewire\Forms\ProgramForm;

new class extends Component {
    use WithFileUploads;

    public ProgramForm $form;

    public function mount($id = null)
    {
        if ($id) {
            $program = Program::findOrFail($id);
            $this->form->setProgram($program);
        }
    }

    // Listener for auto-slug when name changes
    public function updatedFormProgramName()
    {
        $this->form->generateSlug();
    }

    public function save()
    {
        $isEdit = !is_null($this->form->program);

        $this->form->store();

        return redirect()
            ->route('admin.programs.index')
            ->with('success', $isEdit ? 'Program berhasil diperbarui.' : 'Program baru berhasil dibuat.');
    }
}; ?>

<div class="program-form-wrapper">

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <h6 class="alert-heading fw-bold">
                <i class="fas fa-exclamation-triangle me-2"></i>Terdapat Kesalahan Input!
            </h6>
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form wire:submit="save">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1 text-dark">
                    {{ $form->program ? 'Edit Program' : 'Buat Program Baru' }}
                </h4>
            </div>
            <div>
                <a href="{{ route('admin.programs.index') }}" class="btn btn-light border shadow-sm me-2">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
            </div>
        </div>

        <div class="row g-4">
            {{-- Left: Main Info --}}
            <div class="col-lg-8">
                <x-admin.program.form.main-info-card :form="$form" />
            </div>

            {{-- Right: Sidebar --}}
            <div class="col-lg-4">
                <x-admin.program.form.sidebar-card :form="$form" />
            </div>
        </div>
    </form>
</div>
