<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
        <h6 class="text-primary fw-bold text-uppercase small ls-1 mb-0">
            <i class="fas fa-user-circle me-2"></i>Identitas Pribadi
        </h6>
    </div>
    <div class="card-body px-4 pb-4">
        <div class="row g-3">
            {{-- Nama Lengkap --}}
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" wire:model="form.full_name"
                        class="form-control @error('form.full_name') is-invalid @enderror" id="fullName"
                        placeholder="Nama Lengkap">
                    <label for="fullName">Nama Lengkap <span class="text-danger">*</span></label>
                    @error('form.full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <select wire:model="form.gender" class="form-select" id="gender">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <label for="gender">Jenis Kelamin</label>
                </div>
            </div>

            {{-- Tempat Lahir --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" wire:model="form.birth_place" class="form-control" id="birthPlace"
                        placeholder="Tempat Lahir">
                    <label for="birthPlace">Tempat Lahir</label>
                </div>
            </div>

            {{-- Tanggal Lahir (Note the .live modifier for age calculation) --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" wire:model.live="form.date_of_birth" class="form-control" id="dob">
                    <label for="dob">Tanggal Lahir</label>
                </div>
            </div>

            {{-- Usia --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" wire:model="form.age" class="form-control bg-light" id="age" readonly
                        placeholder="Usia">
                    <label for="age">Usia (Tahun)</label>
                </div>
            </div>

            {{-- Alamat --}}
            <div class="col-12">
                <div class="form-floating">
                    <textarea wire:model="form.address" class="form-control" id="address" style="height: 100px" placeholder="Alamat"></textarea>
                    <label for="address">Alamat Lengkap</label>
                </div>
            </div>
        </div>
    </div>
</div>
