@props(['registrant'])

<div class="card shadow-sm info-card">
    <div class="card-body p-4">
        <h5 class="section-title">Aksi Cepat</h5>
        <div class="d-grid gap-2">
            <a href="{{ route('admin.registrants.edit', $registrant->id) }}"
                class="btn btn-warning fw-bold text-white shadow-sm">
                <i class="fas fa-edit me-2"></i>Edit Data
            </a>

            <button type="button" class="btn btn-outline-dark" onclick="window.print()">
                <i class="fas fa-print me-2"></i>Cetak Halaman
            </button>

            <a href="mailto:{{ $registrant->email }}" class="btn btn-outline-info">
                <i class="fas fa-envelope me-2"></i>Kirim Email
            </a>

            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $registrant->phone_number) }}" target="_blank"
                class="btn btn-success text-white">
                <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
            </a>
        </div>
    </div>
</div>
