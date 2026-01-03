@props(['registrant'])

<div class="card shadow-sm mb-4 info-card">
    <div class="card-body p-4">
        <h5 class="section-title">Dokumen Pendukung</h5>

        <div class="row g-3">
            @php
                $docs = [
                    'scan_ktp' => ['label' => 'KTP', 'icon' => 'id-card'],
                    'scan_kk' => ['label' => 'Kartu Keluarga', 'icon' => 'users'],
                    'scan_akta' => ['label' => 'Akta Kelahiran', 'icon' => 'certificate'],
                    'scan_ijazah_sd' => ['label' => 'Ijazah SD', 'icon' => 'graduation-cap'],
                    'scan_ijazah_smp' => ['label' => 'Ijazah SMP', 'icon' => 'graduation-cap'],
                    'scan_ijazah_sma' => ['label' => 'Ijazah SMA', 'icon' => 'graduation-cap'],
                ];
                $hasDocs = false;
            @endphp

            @foreach ($docs as $field => $meta)
                @if ($registrant->$field)
                    @php $hasDocs = true; @endphp
                    <div class="col-md-6">
                        <div class="card h-100 border">
                            <div class="card-body text-center p-3">
                                <h6 class="card-title text-muted mb-3">
                                    <i class="fas fa-{{ $meta['icon'] }} me-2"></i>{{ $meta['label'] }}
                                </h6>

                                {{-- Preview Logic --}}
                                @if (Str::endsWith($registrant->$field, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                                    <img src="{{ Storage::url($registrant->$field) }}" class="document-preview mb-3"
                                        alt="{{ $meta['label'] }}"
                                        onclick="window.open('{{ Storage::url($registrant->$field) }}', '_blank')">
                                @else
                                    <div
                                        class="document-preview mb-3 d-flex align-items-center justify-content-center bg-light text-danger">
                                        <i class="fas fa-file-pdf fa-3x"></i>
                                    </div>
                                @endif

                                <a href="{{ Storage::url($registrant->$field) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary w-100">
                                    <i class="fas fa-download me-1"></i> Unduh / Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            @if (!$hasDocs)
                <div class="col-12">
                    <div class="alert alert-info mb-0 border-0 bg-info-subtle text-info-emphasis">
                        <i class="fas fa-info-circle me-2"></i> Belum ada dokumen yang diunggah.
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
