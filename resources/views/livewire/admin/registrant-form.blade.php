<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\Registrant;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

new class extends Component {
    use WithFileUploads;

    // --- 1. MODEL & DATA PROPERTIES ---
    public ?Registrant $registrant = null;
    public $programs = [];

    // --- 2. FORM INPUTS ---
    public $program_id,
        $full_name,
        $gender = 'Laki-laki',
        $birth_place,
        $date_of_birth,
        $age;
    public $email, $phone_number, $parent_guardian_phone, $address, $origin_school;
    public $hobby,
        $height_cm,
        $weight_kg,
        $work_experience,
        $status = 'Pending',
        $notes;

    // --- 3. UPLOADS ---
    // New files
    public $scan_ktp, $scan_kk, $scan_akta, $scan_ijazah_sd, $scan_ijazah_smp;
    // Existing file paths (for display)
    public $existing_scan_ktp, $existing_scan_kk, $existing_scan_akta, $existing_scan_ijazah_sd, $existing_scan_ijazah_smp;

    // --- LIFECYCLE HOOKS ---
    public function mount($id = null)
    {
        $this->programs = Program::where('is_active', true)->get();

        if ($id) {
            $this->loadExistingRegistrant($id);
        }
    }

    // Auto-calculate age
    public function updatedDateOfBirth($value)
    {
        if ($value) {
            $this->age = Carbon::parse($value)->age;
        }
    }

    // --- MAIN ACTION: SAVE ---
    public function save()
    {
        // --- FIX: SANITIZE FILE INPUTS ---
        // Convert empty strings or invalid data to NULL so validation passes
        $fileFields = ['scan_ktp', 'scan_kk', 'scan_akta', 'scan_ijazah_sd', 'scan_ijazah_smp'];

        foreach ($fileFields as $field) {
            // If the field is not a "TemporaryUploadedFile" object, set it to null
            if (!is_object($this->$field)) {
                $this->$field = null;
            }
        }

        // 1. Validate Input
        // Now that empty fields are strictly NULL, the 'nullable' rule will work
        $this->validate($this->rules());

        // 2. Prepare Data Array
        $data = $this->collectFormData();

        // 3. Handle File Uploads
        $data = array_merge($data, $this->handleFileUploads());

        // 4. Save to Database
        $this->persistRegistrant($data);

        $this->persistRegistrant($data);

        // USE THIS for Redirects
        // This matches your Layout's @if(session('success')) check
        return redirect()
            ->route('admin.registrants.index')
            ->with('success', $this->registrant ? 'Data berhasil diperbarui.' : 'Peserta baru berhasil ditambahkan.');
    }

    // --- HELPER METHODS (The "Messy" Logic is hidden here) ---

    // Load data for Edit Mode
    protected function loadExistingRegistrant($id)
    {
        $this->registrant = Registrant::findOrFail($id);
        $this->fill($this->registrant->toArray());

        // Handle Date conversion specifically
        if ($this->registrant->date_of_birth) {
            $this->date_of_birth = $this->registrant->date_of_birth->format('Y-m-d');
        }

        // Map existing documents to the specific properties
        $documents = ['scan_ktp', 'scan_kk', 'scan_akta', 'scan_ijazah_sd', 'scan_ijazah_smp'];
        foreach ($documents as $doc) {
            $prop = 'existing_' . $doc;
            $this->$prop = $this->registrant->$doc;
        }
    }

    // Define Validation Rules
    protected function rules()
    {
        return [
            'program_id' => 'required|exists:program,id',
            'full_name' => 'required|min:3',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required',
            // Files
            'scan_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'scan_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'scan_akta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'scan_ijazah_sd' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'scan_ijazah_smp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            // Optionals
            'date_of_birth' => 'nullable|date',
            'age' => 'nullable|numeric',
            'height_cm' => 'nullable|numeric',
            'weight_kg' => 'nullable|numeric',
        ];
    }

    // Gather all simple inputs into an array
    protected function collectFormData()
    {
        return [
            'program_id' => $this->program_id,
            'full_name' => $this->full_name,
            'gender' => $this->gender,
            'birth_place' => $this->birth_place,
            'date_of_birth' => $this->date_of_birth,
            'age' => $this->age,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'parent_guardian_phone' => $this->parent_guardian_phone,
            'address' => $this->address,
            'origin_school' => $this->origin_school,
            'hobby' => $this->hobby,
            'height_cm' => $this->height_cm,
            'weight_kg' => $this->weight_kg,
            'work_experience' => $this->work_experience,
            'status' => $this->status,
            'notes' => $this->notes,
        ];
    }

    // Loop through uploaded files and save them
    protected function handleFileUploads()
    {
        $filePaths = [];
        $documentFields = ['scan_ktp', 'scan_kk', 'scan_akta', 'scan_ijazah_sd', 'scan_ijazah_smp'];

        foreach ($documentFields as $field) {
            if ($this->$field) {
                // If editing, delete the OLD file from storage
                if ($this->registrant && $this->registrant->$field) {
                    Storage::delete($this->registrant->$field);
                }
                // Upload new file
                $filePaths[$field] = $this->$field->store('registrants/documents', 'public');
            }
        }

        return $filePaths;
    }

    // Save to DB
    protected function persistRegistrant($data)
    {
        if ($this->registrant) {
            $this->registrant->update($data);
        } else {
            $data['registration_date'] = now();
            Registrant::create($data);
        }
    }

    // Delete a specific document (Triggered from UI)
    public function removeDocument($field)
    {
        $existingField = 'existing_' . $field;

        if ($this->registrant && $this->$existingField) {
            Storage::delete($this->$existingField);
            $this->registrant->update([$field => null]);
            $this->$existingField = null;

            // USE THIS for Livewire to talk to JS without reload
            $this->dispatch('trigger-toast', type: 'success', message: 'Dokumen berhasil dihapus.');
        }
    }
}; ?>

<div class="registrant-form-wrapper">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Terdapat Kesalahan Input!</h6>
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form wire:submit="save">
        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1 text-dark">
                    {{ $registrant ? 'Edit Peserta' : 'Pendaftaran Baru' }}
                </h4>
                <p class="text-muted mb-0 small">
                    {{ $registrant ? 'Perbarui informasi peserta #' . $registrant->id : 'Isi formulir untuk mendaftarkan peserta baru' }}
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.registrants.index') }}" class="btn btn-light border">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary px-4 shadow-sm" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">Simpan Data</span>
                    <span wire:loading wire:target="save"><i class="fas fa-spinner fa-spin"></i></span>
                </button>
            </div>
        </div>

        <div class="row g-4">

            {{-- Left Column: Main Info --}}
            <div class="col-lg-8">

                {{-- Card 1: Personal Identity --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
                        <h6 class="text-primary fw-bold text-uppercase small ls-1 mb-0">
                            <i class="fas fa-user-circle me-2"></i>Identitas Pribadi
                        </h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" wire:model="full_name"
                                        class="form-control @error('full_name') is-invalid @enderror" id="fullName"
                                        placeholder="Nama Lengkap">
                                    <label for="fullName">Nama Lengkap <span class="text-danger">*</span></label>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select wire:model="gender" class="form-select" id="gender">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <label for="gender">Jenis Kelamin</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" wire:model="birth_place" class="form-control" id="birthPlace"
                                        placeholder="Tempat Lahir">
                                    <label for="birthPlace">Tempat Lahir</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" wire:model.live="date_of_birth" class="form-control"
                                        id="dob">
                                    <label for="dob">Tanggal Lahir</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" wire:model="age" class="form-control bg-light" id="age"
                                        readonly placeholder="Usia">
                                    <label for="age">Usia (Tahun)</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea wire:model="address" class="form-control" id="address" style="height: 100px" placeholder="Alamat"></textarea>
                                    <label for="address">Alamat Lengkap</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Contact & Physical --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
                        <h6 class="text-primary fw-bold text-uppercase small ls-1 mb-0">
                            <i class="fas fa-address-book me-2"></i>Kontak & Fisik
                        </h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" wire:model="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="Email">
                                    <label for="email">Alamat Email <span class="text-danger">*</span></label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" wire:model="phone_number"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone" placeholder="No HP">
                                    <label for="phone">No. WhatsApp <span class="text-danger">*</span></label>
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" wire:model="parent_guardian_phone" class="form-control"
                                        id="parentPhone" placeholder="No Ortu">
                                    <label for="parentPhone">No. HP Orang Tua</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" wire:model="origin_school" class="form-control"
                                        id="school" placeholder="Sekolah">
                                    <label for="school">Asal Sekolah</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="number" wire:model="height_cm" class="form-control"
                                            id="height" placeholder="Tinggi">
                                        <label for="height">Tinggi Badan</label>
                                    </div>
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="number" wire:model="weight_kg" class="form-control"
                                            id="weight" placeholder="Berat">
                                        <label for="weight">Berat Badan</label>
                                    </div>
                                    <span class="input-group-text">kg</span>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea wire:model="work_experience" class="form-control" id="experience" style="height: 80px"
                                        placeholder="Pengalaman"></textarea>
                                    <label for="experience">Pengalaman Kerja / Organisasi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Documents --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
                        <h6 class="text-primary fw-bold text-uppercase small ls-1 mb-0">
                            <i class="fas fa-folder-open me-2"></i>Upload Dokumen
                        </h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="alert alert-light border-start border-primary border-4 text-muted small">
                            <i class="fas fa-info-circle me-1"></i> Format: JPG/PNG/PDF. Max: 2MB per file.
                        </div>

                        <div class="row g-3">
                            @foreach ([
        'scan_ktp' => 'KTP',
        'scan_kk' => 'Kartu Keluarga',
        'scan_akta' => 'Akta Kelahiran',
        'scan_ijazah_sd' => 'Ijazah SD',
        'scan_ijazah_smp' => 'Ijazah SMP',
    ] as $field => $label)
                                <div class="col-md-6">
                                    <div
                                        class="document-upload-card p-3 border rounded-3 h-100 position-relative bg-white hover-shadow">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="fw-bold text-dark small">{{ $label }}</span>
                                            @php $existingVar = 'existing_' . $field; @endphp

                                            @if ($$existingVar)
                                                <span class="badge bg-success-subtle text-success rounded-pill">
                                                    <i class="fas fa-check me-1"></i> Ada
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-secondary-subtle text-secondary rounded-pill">Kosong</span>
                                            @endif
                                        </div>

                                        <input type="file" wire:model="{{ $field }}"
                                            class="form-control form-control-sm mb-2" accept=".jpg,.jpeg,.png,.pdf">
                                        @error($field)
                                            <div class="text-danger small" style="font-size:0.75rem">{{ $message }}
                                            </div>
                                        @enderror

                                        {{-- Loading State --}}
                                        <div wire:loading wire:target="{{ $field }}"
                                            class="text-primary small">
                                            <i class="fas fa-spinner fa-spin me-1"></i> Uploading...
                                        </div>

                                        {{-- Actions for Existing File --}}
                                        @if ($$existingVar)
                                            <div class="mt-2 pt-2 border-top d-flex gap-2">
                                                <a href="{{ Storage::url($$existingVar) }}" target="_blank"
                                                    class="btn btn-xs btn-outline-primary w-100">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button type="button"
                                                    wire:click="removeDocument('{{ $field }}')"
                                                    class="btn btn-xs btn-outline-danger w-100"
                                                    onclick="confirm('Hapus file ini?') || event.stopImmediatePropagation()">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right Column: Status & Program --}}
            <div class="col-lg-4">

                {{-- Status Card --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4 sticky-top" style="top: 20px; z-index: 1;">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-muted fw-bold small ls-1 mb-3">Status Aplikasi</h6>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Program Pilihan <span
                                    class="text-danger">*</span></label>
                            <select wire:model="program_id"
                                class="form-select form-select-lg border-primary bg-primary-subtle text-primary fw-bold @error('program_id') is-invalid @enderror">
                                <option value="">-- Pilih Program --</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                @endforeach
                            </select>
                            @error('program_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Status Pendaftaran</label>
                            <select wire:model="status" class="form-select">
                                <option value="Pending">🕒 Pending</option>
                                <option value="Verified">✅ Verified</option>
                                <option value="Accepted">🎉 Accepted</option>
                                <option value="Rejected">❌ Rejected</option>
                            </select>
                        </div>

                        <hr class="text-muted opacity-25">

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Catatan Admin</label>
                            <textarea wire:model="notes" class="form-control bg-light text-muted" rows="4"
                                placeholder="Tulis catatan internal..."></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2 fw-bold">
                                <i class="fas fa-save me-2"></i> Simpan Data
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <style>
        .ls-1 {
            letter-spacing: 1px;
        }

        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .05) !important;
            transform: translateY(-2px);
        }

        .btn-xs {
            padding: 0.2rem 0.4rem;
            font-size: 0.75rem;
        }

        /* Custom scrollbar for textareas if needed */
        textarea {
            resize: none;
        }
    </style>
</div>
