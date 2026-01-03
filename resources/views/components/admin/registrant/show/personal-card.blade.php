@props(['registrant'])

<div class="card shadow-sm mb-4 info-card">
    <div class="card-body p-4">
        <h5 class="section-title">Informasi Pribadi</h5>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label">Nama Lengkap</div>
                <div class="col-md-8 info-value">{{ $registrant->full_name }}</div>
            </div>
        </div>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label">Tempat, Tanggal Lahir</div>
                <div class="col-md-8 info-value">
                    {{ $registrant->birth_place }}, {{ $registrant->date_of_birth?->format('d F Y') }}
                </div>
            </div>
        </div>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label">Umur</div>
                <div class="col-md-8 info-value">{{ $registrant->age }} tahun</div>
            </div>
        </div>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label">Jenis Kelamin</div>
                <div class="col-md-8 info-value">
                    <span
                        class="badge bg-{{ $registrant->gender == 'Laki-laki' ? 'primary' : 'danger' }} bg-opacity-25 text-dark border">
                        <i class="fas fa-{{ $registrant->gender == 'Laki-laki' ? 'mars' : 'venus' }} me-1"></i>
                        {{ $registrant->gender }}
                    </span>
                </div>
            </div>
        </div>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label">Alamat</div>
                <div class="col-md-8 info-value">{{ $registrant->address }}</div>
            </div>
        </div>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label">Hobi</div>
                <div class="col-md-8 info-value">{{ $registrant->hobby ?? '-' }}</div>
            </div>
        </div>
    </div>
</div>
