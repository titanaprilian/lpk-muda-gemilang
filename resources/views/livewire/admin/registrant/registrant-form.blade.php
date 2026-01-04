<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\Registrant;
use App\Models\Program;
use App\Livewire\Forms\RegistrantForm;

new class extends Component {
    use WithFileUploads;

    // 1. Inject the Form Object
    public RegistrantForm $form;

    // 2. Data for Dropdowns
    public $programs = [];

    public function mount($id = null)
    {
        // Load Programs for the dropdown
        $this->programs = Program::where('is_active', true)->get();

        // If ID exists, we are in "Edit Mode"
        if ($id) {
            $registrant = Registrant::findOrFail($id);
            $this->form->setRegistrant($registrant);
        }
    }

    // Real-time age calculation
    public function updatedFormDateOfBirth()
    {
        $this->form->calculateAge();
    }

    public function save()
    {
        $this->form->store();

        return redirect()
            ->route('admin.registrants.index')
            ->with('success', $this->form->registrant ? 'Data peserta berhasil diperbarui.' : 'Peserta baru berhasil ditambahkan.');
    }

    // Action to delete a specific document
    public function removeDocument($field)
    {
        // Check if the file actually exists in the DB
        if ($this->form->registrant && $this->form->registrant->$field) {
            // Delete from storage
            Storage::disk('public')->delete($this->form->registrant->$field);

            // Update DB to null
            $this->form->registrant->update([$field => null]);

            // Refresh the form state so UI updates
            $this->form->scan_ktp = null; // Resetting the specific livewire property just in case

            // Notification
            $this->dispatch('alert', type: 'success', message: 'Dokumen berhasil dihapus.');
        }
    }
}; ?>

<div class="registrant-form-wrapper">

    {{-- Error Alert (Global) --}}
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
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form wire:submit="save">

        {{-- 1. Header Section --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1 text-dark">
                    {{ $form->registrant ? 'Edit Peserta' : 'Pendaftaran Baru' }}
                </h4>
                <p class="text-muted mb-0 small">
                    {{ $form->registrant ? 'Perbarui informasi peserta #' . $form->registrant->id : 'Isi formulir untuk mendaftarkan peserta baru' }}
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.registrants.index') }}" class="btn btn-light border shadow-sm">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary px-4 shadow-sm fw-bold" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">
                        <i class="fas fa-save me-1"></i> Simpan Data
                    </span>
                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...
                    </span>
                </button>
            </div>
        </div>

        <div class="row g-4">

            {{-- 2. Left Column: Main Form Components --}}
            <div class="col-lg-8">

                {{-- Component: Personal Info --}}
                <x-admin.registrant.form.personal-info-card :form="$form" />

                {{-- Component: Contact & Physical --}}
                <x-admin.registrant.form.contact-card :form="$form" />

                {{-- Component: Documents (Includes Ijazah SMA) --}}
                <x-admin.registrant.form.document-upload-card :form="$form" />

            </div>

            {{-- 3. Right Column: Status & Admin Controls --}}
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm rounded-4 mb-4 sticky-top" style="top: 20px; z-index: 1;">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-muted fw-bold small ls-1 mb-3">
                            <i class="fas fa-cog me-2"></i>Status & Program
                        </h6>

                        {{-- Program Selection --}}
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Program Pilihan <span
                                    class="text-danger">*</span></label>
                            <select wire:model="form.program_id"
                                class="form-select form-select-lg border-primary bg-primary-subtle text-primary fw-bold @error('form.program_id') is-invalid @enderror">
                                <option value="">-- Pilih Program --</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                @endforeach
                            </select>
                            @error('form.program_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status Selection --}}
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Status Pendaftaran</label>
                            <select wire:model="form.status"
                                class="form-select @error('form.status') is-invalid @enderror">
                                <option value="Pending">🕒 Pending</option>
                                <option value="Verified">✅ Verified</option>
                                <option value="Accepted">🎉 Accepted</option>
                                <option value="Rejected">❌ Rejected</option>
                            </select>
                            @error('form.status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="text-muted opacity-25">

                        {{-- Internal Notes --}}
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Catatan Admin (Internal)</label>
                            <textarea wire:model="form.notes" class="form-control bg-light text-muted" rows="5"
                                placeholder="Tulis catatan mengenai peserta ini..."></textarea>
                        </div>

                        {{-- Submit Button (Repeated for convenience) --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm">
                                <i class="fas fa-check-circle me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
