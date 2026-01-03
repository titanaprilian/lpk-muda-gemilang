<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
        <h6 class="text-primary fw-bold text-uppercase small ls-1 mb-0">
            <i class="fas fa-folder-open me-2"></i>Upload Dokumen
        </h6>
    </div>
    <div class="card-body px-4 pb-4">
        {{-- Info Alert --}}
        <div class="alert alert-light border-start border-primary border-4 text-muted small">
            <i class="fas fa-info-circle me-1"></i> Format: JPG/PNG/PDF. Max: 2MB per file.
        </div>

        <div class="row g-3">
            {{-- Loop through the document types --}}
            @foreach ([
        'scan_ktp' => 'KTP',
        'scan_kk' => 'Kartu Keluarga',
        'scan_akta' => 'Akta Kelahiran',
        'scan_ijazah_sd' => 'Ijazah SD',
        'scan_ijazah_smp' => 'Ijazah SMP',
        'scan_ijazah_sma' => 'Ijazah SMA',
    ] as $field => $label)
                <div class="col-md-6">
                    <div class="document-upload-card p-3 border rounded-3 h-100 position-relative bg-white hover-shadow">

                        {{-- 1. Header & Status Badge --}}
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="fw-bold text-dark small">{{ $label }}</span>

                            {{-- Check if we have an existing file in the database model --}}
                            @if ($form->registrant && $form->registrant->$field)
                                <span class="badge bg-success-subtle text-success rounded-pill">
                                    <i class="fas fa-check me-1"></i> Tersimpan
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary rounded-pill">Kosong</span>
                            @endif
                        </div>

                        {{-- 2. File Input --}}
                        {{-- Binds to form.scan_ktp, form.scan_kk, etc. --}}
                        <input type="file" wire:model="form.{{ $field }}"
                            class="form-control form-control-sm mb-2" accept=".jpg,.jpeg,.png,.pdf">

                        {{-- Validation Error --}}
                        @error('form.' . $field)
                            <div class="text-danger small fw-bold" style="font-size:0.75rem">
                                {{ $message }}
                            </div>
                        @enderror

                        {{-- 3. Loading State (Specific to this field) --}}
                        <div wire:loading wire:target="form.{{ $field }}" class="text-primary small my-1">
                            <i class="fas fa-spinner fa-spin me-1"></i> Uploading...
                        </div>

                        {{-- 4. Actions for EXISTING File --}}
                        {{-- Only show View/Delete buttons if the file exists in DB --}}
                        @if ($form->registrant && $form->registrant->$field)
                            <div class="mt-2 pt-2 border-top d-flex gap-2">
                                {{-- View Button --}}
                                <a href="{{ Storage::url($form->registrant->$field) }}" target="_blank"
                                    class="btn btn-xs btn-outline-primary w-100" title="Lihat File">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>

                                {{-- Delete Button --}}
                                {{-- Calls removeDocument() on the Parent Component --}}
                                <button type="button" wire:click="removeDocument('{{ $field }}')"
                                    wire:confirm="Apakah Anda yakin ingin menghapus dokumen {{ $label }} ini?"
                                    class="btn btn-xs btn-outline-danger w-100" title="Hapus File">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
