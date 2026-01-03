@props(['registrant'])

<div class="card shadow-sm mb-4 info-card">
    <div class="card-body p-4">
        <h5 class="section-title">Status Pendaftaran</h5>

        <div class="mb-3">
            <label class="info-label d-block mb-2">Program</label>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-6 px-3 py-2">
                <i class="fas fa-book me-2"></i>
                {{ $registrant->program->program_name ?? '-' }}
            </span>
        </div>

        <div class="mb-3">
            <label class="info-label d-block mb-2">Status</label>
            @php
                $statusConfig = match ($registrant->status) {
                    'Pending' => ['color' => 'warning', 'icon' => 'clock'],
                    'Verified' => ['color' => 'info', 'icon' => 'check-circle'],
                    'Accepted' => ['color' => 'success', 'icon' => 'check-double'],
                    'Rejected' => ['color' => 'danger', 'icon' => 'times-circle'],
                    default => ['color' => 'secondary', 'icon' => 'question-circle'],
                };
            @endphp
            <span class="badge bg-{{ $statusConfig['color'] }} fs-6 px-3 py-2">
                <i class="fas fa-{{ $statusConfig['icon'] }} me-2"></i>
                {{ $registrant->status }}
            </span>
        </div>

        <div>
            <label class="info-label d-block mb-2">Tanggal Daftar</label>
            <div class="info-value">
                <i class="fas fa-calendar-alt me-2 text-muted"></i>
                {{ $registrant->registration_date->format('d F Y, H:i') }}
            </div>
        </div>
    </div>
</div>

{{-- Notes are usually tied to status --}}
@if ($registrant->notes)
    <div class="card shadow-sm mb-4 info-card">
        <div class="card-body p-4">
            <h5 class="section-title">Catatan</h5>
            <div class="alert alert-warning mb-0 border-0">
                <i class="fas fa-sticky-note me-2"></i>
                {{ $registrant->notes }}
            </div>
        </div>
    </div>
@endif
