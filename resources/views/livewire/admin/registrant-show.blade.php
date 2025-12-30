<?php

use Livewire\Volt\Component;
use App\Models\Registrant;

new class extends Component {
    public Registrant $registrant;

    public function mount($id)
    {
        $this->registrant = Registrant::with('program')->findOrFail($id);
    }

    public function delete()
    {
        $this->registrant->delete();
        $this->dispatch('alert', type: 'success', message: 'Data berhasil dihapus.');
        return redirect()->route('admin.registrants.index');
    }
}; ?>

<div>
    <style>
        .info-card {
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            border-left: 4px solid #0d6efd;
            padding-left: 12px;
            margin-bottom: 20px;
        }

        .document-preview {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .document-preview:hover {
            transform: scale(1.05);
        }

        .info-row {
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #6c757d;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .info-value {
            color: #212529;
            font-weight: 400;
        }
    </style>

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">
                <i class="fas fa-user-circle me-2 text-primary"></i>
                Detail Peserta
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.registrants.index') }}">Daftar Peserta</a></li>
                    <li class="breadcrumb-item active">{{ $registrant->full_name }}</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.registrants.edit', $registrant->id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <button wire:click="delete"
                wire:confirm="Apakah Anda yakin ingin menghapus data {{ $registrant->full_name }}?"
                class="btn btn-danger">
                <i class="fas fa-trash me-1"></i> Hapus
            </button>
            <a href="{{ route('admin.registrants.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left Column --}}
        <div class="col-lg-8">
            {{-- Personal Information --}}
            <div class="card shadow-sm mb-4 info-card">
                <div class="card-body">
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
                                    <i
                                        class="fas fa-{{ $registrant->gender == 'Laki-laki' ? 'mars' : 'venus' }} me-1"></i>
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
                            <div class="col-md-4 info-label">Asal Sekolah</div>
                            <div class="col-md-8 info-value">{{ $registrant->origin_school }}</div>
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

            {{-- Contact Information --}}
            <div class="card shadow-sm mb-4 info-card">
                <div class="card-body">
                    <h5 class="section-title">Informasi Kontak</h5>

                    <div class="info-row">
                        <div class="row">
                            <div class="col-md-4 info-label">
                                <i class="fas fa-envelope me-2"></i>Email
                            </div>
                            <div class="col-md-8 info-value">
                                <a href="mailto:{{ $registrant->email }}">{{ $registrant->email }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="row">
                            <div class="col-md-4 info-label">
                                <i class="fas fa-phone me-2"></i>No. Telepon
                            </div>
                            <div class="col-md-8 info-value">
                                <a href="tel:{{ $registrant->phone_number }}">{{ $registrant->phone_number }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="row">
                            <div class="col-md-4 info-label">
                                <i class="fas fa-phone-alt me-2"></i>No. Orang Tua/Wali
                            </div>
                            <div class="col-md-8 info-value">
                                <a
                                    href="tel:{{ $registrant->parent_guardian_phone }}">{{ $registrant->parent_guardian_phone }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Physical & Experience --}}
            <div class="card shadow-sm mb-4 info-card">
                <div class="card-body">
                    <h5 class="section-title">Informasi Fisik & Pengalaman</h5>

                    <div class="info-row">
                        <div class="row">
                            <div class="col-md-4 info-label">Tinggi Badan</div>
                            <div class="col-md-8 info-value">{{ $registrant->height_cm }} cm</div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="row">
                            <div class="col-md-4 info-label">Berat Badan</div>
                            <div class="col-md-8 info-value">{{ $registrant->weight_kg }} kg</div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="row">
                            <div class="col-md-4 info-label">Pengalaman Kerja</div>
                            <div class="col-md-8 info-value">{{ $registrant->work_experience ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Documents --}}
            <div class="card shadow-sm mb-4 info-card">
                <div class="card-body">
                    <h5 class="section-title">Dokumen Pendukung</h5>

                    <div class="row g-3">
                        @if ($registrant->scan_ktp)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6 class="card-title"><i class="fas fa-id-card me-2"></i>KTP</h6>
                                        @if (Str::endsWith($registrant->scan_ktp, ['.jpg', '.jpeg', '.png', '.gif']))
                                            <img src="{{ Storage::url($registrant->scan_ktp) }}"
                                                class="document-preview mb-2" alt="KTP"
                                                onclick="window.open('{{ Storage::url($registrant->scan_ktp) }}', '_blank')">
                                        @endif
                                        <a href="{{ Storage::url($registrant->scan_ktp) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary w-100">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($registrant->scan_kk)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6 class="card-title"><i class="fas fa-users me-2"></i>Kartu Keluarga</h6>
                                        @if (Str::endsWith($registrant->scan_kk, ['.jpg', '.jpeg', '.png', '.gif']))
                                            <img src="{{ Storage::url($registrant->scan_kk) }}"
                                                class="document-preview mb-2" alt="KK"
                                                onclick="window.open('{{ Storage::url($registrant->scan_kk) }}', '_blank')">
                                        @endif
                                        <a href="{{ Storage::url($registrant->scan_kk) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary w-100">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($registrant->scan_akta)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6 class="card-title"><i class="fas fa-certificate me-2"></i>Akta Kelahiran
                                        </h6>
                                        @if (Str::endsWith($registrant->scan_akta, ['.jpg', '.jpeg', '.png', '.gif']))
                                            <img src="{{ Storage::url($registrant->scan_akta) }}"
                                                class="document-preview mb-2" alt="Akta"
                                                onclick="window.open('{{ Storage::url($registrant->scan_akta) }}', '_blank')">
                                        @endif
                                        <a href="{{ Storage::url($registrant->scan_akta) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary w-100">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($registrant->scan_ijazah_sd)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6 class="card-title"><i class="fas fa-graduation-cap me-2"></i>Ijazah SD
                                        </h6>
                                        @if (Str::endsWith($registrant->scan_ijazah_sd, ['.jpg', '.jpeg', '.png', '.gif']))
                                            <img src="{{ Storage::url($registrant->scan_ijazah_sd) }}"
                                                class="document-preview mb-2" alt="Ijazah SD"
                                                onclick="window.open('{{ Storage::url($registrant->scan_ijazah_sd) }}', '_blank')">
                                        @endif
                                        <a href="{{ Storage::url($registrant->scan_ijazah_sd) }}" target="_blank"
                                            class="btn btn-sm btn-outline-success w-100">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($registrant->scan_ijazah_smp)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6 class="card-title"><i class="fas fa-graduation-cap me-2"></i>Ijazah SMP
                                        </h6>
                                        @if (Str::endsWith($registrant->scan_ijazah_smp, ['.jpg', '.jpeg', '.png', '.gif']))
                                            <img src="{{ Storage::url($registrant->scan_ijazah_smp) }}"
                                                class="document-preview mb-2" alt="Ijazah SMP"
                                                onclick="window.open('{{ Storage::url($registrant->scan_ijazah_smp) }}', '_blank')">
                                        @endif
                                        <a href="{{ Storage::url($registrant->scan_ijazah_smp) }}" target="_blank"
                                            class="btn btn-sm btn-outline-success w-100">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (
                            !$registrant->scan_ktp &&
                                !$registrant->scan_kk &&
                                !$registrant->scan_akta &&
                                !$registrant->scan_ijazah_sd &&
                                !$registrant->scan_ijazah_smp)
                            <div class="col-12">
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Belum ada dokumen yang diunggah
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="col-lg-4">
            {{-- Status Card --}}
            <div class="card shadow-sm mb-4 info-card">
                <div class="card-body">
                    <h5 class="section-title">Status Pendaftaran</h5>

                    <div class="mb-3">
                        <label class="info-label d-block mb-2">Program</label>
                        <span class="badge bg-info text-dark bg-opacity-10 border border-info fs-6 px-3 py-2">
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
                        <label class="info-label d-block mb-2">Tanggal Pendaftaran</label>
                        <div class="info-value">
                            <i class="fas fa-calendar-alt me-2"></i>
                            {{ $registrant->registration_date->format('d F Y, H:i') }} WIB
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notes Card --}}
            @if ($registrant->notes)
                <div class="card shadow-sm mb-4 info-card">
                    <div class="card-body">
                        <h5 class="section-title">Catatan</h5>
                        <div class="alert alert-light mb-0">
                            <i class="fas fa-sticky-note me-2"></i>
                            {{ $registrant->notes }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Quick Actions --}}
            <div class="card shadow-sm info-card">
                <div class="card-body">
                    <h5 class="section-title">Aksi Cepat</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.registrants.edit', $registrant->id) }}"
                            class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Edit Data
                        </a>
                        <button type="button" class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print me-2"></i>Cetak
                        </button>
                        <a href="mailto:{{ $registrant->email }}" class="btn btn-outline-info">
                            <i class="fas fa-envelope me-2"></i>Kirim Email
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $registrant->phone_number) }}"
                            target="_blank" class="btn btn-outline-success">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
