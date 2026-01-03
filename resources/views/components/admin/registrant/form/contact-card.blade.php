<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
        <h6 class="text-primary fw-bold text-uppercase small ls-1 mb-0">
            <i class="fas fa-address-book me-2"></i>Kontak & Fisik
        </h6>
    </div>
    <div class="card-body px-4 pb-4">
        <div class="row g-3">
            {{-- Email --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" wire:model="form.email"
                        class="form-control @error('form.email') is-invalid @enderror" id="email"
                        placeholder="Email">
                    <label for="email">Alamat Email <span class="text-danger">*</span></label>
                    @error('form.email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- WhatsApp --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" wire:model="form.phone_number"
                        class="form-control @error('form.phone_number') is-invalid @enderror" id="phone"
                        placeholder="No HP">
                    <label for="phone">No. WhatsApp <span class="text-danger">*</span></label>
                    @error('form.phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Parent Phone --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" wire:model="form.parent_guardian_phone" class="form-control" id="parentPhone"
                        placeholder="No Ortu">
                    <label for="parentPhone">No. HP Orang Tua</label>
                </div>
            </div>

            {{-- Origin School --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" wire:model="form.origin_school" class="form-control" id="school"
                        placeholder="Sekolah">
                    <label for="school">Asal Sekolah</label>
                </div>
            </div>

            {{-- Height --}}
            <div class="col-md-6">
                <div class="input-group">
                    <div class="form-floating">
                        <input type="number" wire:model="form.height_cm" class="form-control" id="height"
                            placeholder="Tinggi">
                        <label for="height">Tinggi Badan</label>
                    </div>
                    <span class="input-group-text">cm</span>
                </div>
            </div>

            {{-- Weight --}}
            <div class="col-md-6">
                <div class="input-group">
                    <div class="form-floating">
                        <input type="number" wire:model="form.weight_kg" class="form-control" id="weight"
                            placeholder="Berat">
                        <label for="weight">Berat Badan</label>
                    </div>
                    <span class="input-group-text">kg</span>
                </div>
            </div>

            {{-- Experience --}}
            <div class="col-12">
                <div class="form-floating">
                    <textarea wire:model="form.work_experience" class="form-control" id="experience" style="height: 80px"
                        placeholder="Pengalaman"></textarea>
                    <label for="experience">Pengalaman Kerja / Organisasi</label>
                </div>
            </div>
        </div>
    </div>
</div>
