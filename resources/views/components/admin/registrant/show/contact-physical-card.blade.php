@props(['registrant'])

<div class="card shadow-sm mb-4 info-card">
    <div class="card-body p-4">
        <h5 class="section-title">Kontak & Fisik</h5>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label"><i class="fas fa-envelope me-2"></i>Email</div>
                <div class="col-md-8 info-value">
                    <a href="mailto:{{ $registrant->email }}">{{ $registrant->email }}</a>
                </div>
            </div>
        </div>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label"><i class="fas fa-phone me-2"></i>No. WhatsApp</div>
                <div class="col-md-8 info-value">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $registrant->phone_number) }}"
                        target="_blank">
                        {{ $registrant->phone_number }}
                    </a>
                </div>
            </div>
        </div>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label"><i class="fas fa-phone-alt me-2"></i>Orang Tua</div>
                <div class="col-md-8 info-value">
                    <a href="tel:{{ $registrant->parent_guardian_phone }}">{{ $registrant->parent_guardian_phone }}</a>
                </div>
            </div>
        </div>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label">Asal Sekolah</div>
                <div class="col-md-8 info-value">{{ $registrant->origin_school }}</div>
            </div>
        </div>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label">Tinggi / Berat</div>
                <div class="col-md-8 info-value">
                    {{ $registrant->height_cm }} cm / {{ $registrant->weight_kg }} kg
                </div>
            </div>
        </div>

        <div class="info-row">
            <div class="row">
                <div class="col-md-4 info-label">Pengalaman</div>
                <div class="col-md-8 info-value">{{ $registrant->work_experience ?? '-' }}</div>
            </div>
        </div>
    </div>
</div>
