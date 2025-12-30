<?php

use Livewire\Volt\Component;
use App\Models\Registrant;
use App\Models\Program;
use Illuminate\Validation\Rule;

new class extends Component {
    // Form Properties
    public ?Registrant $registrant = null; // For Edit Mode

    public $program_id = '';
    public $full_name = '';
    public $gender = 'Pria';
    public $birth_place = '';
    public $date_of_birth = '';
    public $age = '';
    public $email = '';
    public $phone_number = '';
    public $parent_guardian_phone = '';
    public $address = '';
    public $origin_school = '';
    public $hobby = '';
    public $height_cm = '';
    public $weight_kg = '';
    public $work_experience = '';
    public $status = 'Pending';
    public $notes = '';

    // Data for Dropdowns
    public $programs = [];

    public function mount($id = null)
    {
        $this->programs = Program::where('is_active', true)->get();

        if ($id) {
            $this->registrant = Registrant::findOrFail($id);

            // Fill form with existing data
            $this->fill($this->registrant->toArray());

            // Handle date format explicitly for HTML date input
            if ($this->registrant->date_of_birth) {
                $this->date_of_birth = $this->registrant->date_of_birth->format('Y-m-d');
            }
        }
    }

    // Auto-calculate Age when Date of Birth changes
    public function updatedDateOfBirth($value)
    {
        if ($value) {
            $this->age = \Carbon\Carbon::parse($value)->age;
        }
    }

    public function save()
    {
        $rules = [
            'program_id' => 'required|exists:program,id',
            'full_name' => 'required|min:3',
            'gender' => 'required|in:Pria,Wanita',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'date_of_birth' => 'nullable|date',
            'age' => 'nullable|numeric',
            'height_cm' => 'nullable|numeric',
            'weight_kg' => 'nullable|numeric',
            'status' => 'required',
        ];

        $validated = $this->validate($rules);

        if ($this->registrant) {
            // Update Existing
            $this->registrant->update($this->all());
            $message = 'Data berhasil diperbarui.';
        } else {
            // Create New
            Registrant::create($this->all());
            $message = 'Peserta baru berhasil ditambahkan.';
        }

        session()->flash('alert', ['type' => 'success', 'message' => $message]);

        return redirect()->route('admin.registrants.index');
    }
}; ?>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 text-primary">
            <i class="fas {{ $registrant ? 'fa-edit' : 'fa-user-plus' }} me-2"></i>
            {{ $registrant ? 'Edit Data Peserta' : 'Form Pendaftaran Baru' }}
        </h5>
    </div>

    <form wire:submit="save">
        <div class="card-body">

            {{-- Section 1: Program & Account --}}
            <h6 class="text-uppercase text-muted fw-bold mb-3 small ls-1">Informasi Dasar</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label required">Pilih Program</label>
                    <select wire:model="program_id" class="form-select @error('program_id') is-invalid @enderror">
                        <option value="">-- Pilih Program Pelatihan --</option>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                        @endforeach
                    </select>
                    @error('program_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label required">Status Pendaftaran</label>
                    <select wire:model="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="Pending">Pending (Menunggu)</option>
                        <option value="Verified">Verified (Terverifikasi)</option>
                        <option value="Accepted">Accepted (Diterima)</option>
                        <option value="Rejected">Rejected (Ditolak)</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Section 2: Personal Data --}}
            <h6 class="text-uppercase text-muted fw-bold mb-3 small ls-1 border-top pt-3">Data Pribadi</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label required">Nama Lengkap</label>
                    <input type="text" wire:model="full_name"
                        class="form-control @error('full_name') is-invalid @enderror">
                    @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select wire:model="gender" class="form-select">
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Usia</label>
                    <input type="number" wire:model="age" class="form-control bg-light" readonly>
                    <small class="text-muted" style="font-size: 0.75rem">*Otomatis dari Tgl Lahir</small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" wire:model="birth_place" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" wire:model.live="date_of_birth" class="form-control">
                </div>

                <div class="col-12">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea wire:model="address" class="form-control" rows="2"></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Asal Sekolah</label>
                    <input type="text" wire:model="origin_school" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Hobi</label>
                    <input type="text" wire:model="hobby" class="form-control">
                </div>
            </div>

            {{-- Section 3: Contact Info --}}
            <h6 class="text-uppercase text-muted fw-bold mb-3 small ls-1 border-top pt-3">Kontak</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label required">Email</label>
                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label required">No. HP / WhatsApp</label>
                    <input type="text" wire:model="phone_number"
                        class="form-control @error('phone_number') is-invalid @enderror">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">No. HP Orang Tua / Wali</label>
                    <input type="text" wire:model="parent_guardian_phone" class="form-control">
                </div>
            </div>

            {{-- Section 4: Physical & Experience --}}
            <h6 class="text-uppercase text-muted fw-bold mb-3 small ls-1 border-top pt-3">Data Fisik & Pengalaman</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <label class="form-label">Tinggi Badan (cm)</label>
                    <input type="number" wire:model="height_cm" class="form-control">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Berat Badan (kg)</label>
                    <input type="number" wire:model="weight_kg" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pengalaman Kerja (Jika ada)</label>
                    <textarea wire:model="work_experience" class="form-control" rows="2"
                        placeholder="Contoh: Magang di PT ABC (3 Bulan)..."></textarea>
                </div>
            </div>

            {{-- Section 5: Admin Notes --}}
            <h6 class="text-uppercase text-muted fw-bold mb-3 small ls-1 border-top pt-3">Catatan Admin</h6>
            <div class="row mb-3">
                <div class="col-12">
                    <textarea wire:model="notes" class="form-control bg-light" rows="2" placeholder="Catatan internal admin..."></textarea>
                </div>
            </div>

        </div>

        <div class="card-footer bg-light py-3 d-flex justify-content-between">
            <a href="{{ route('admin.registrants.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i>
                {{ $registrant ? 'Simpan Perubahan' : 'Simpan Data Baru' }}
            </button>
        </div>
    </form>

    <style>
        .required:after {
            content: " *";
            color: red;
        }

        .ls-1 {
            letter-spacing: 1px;
        }
    </style>
</div>
