@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pendaftaran.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endpush

@section('title', 'Beranda - LPK Muda Gemilang')

@section('content')
    <div class="page-wrapper">
        <div class="form-container" data-aos="fade-up">
            <div class="form-header">

                <h2>Pendaftaran Peserta</h2>
                <p>Bergabunglah bersama LPK Muda Gemilang</p>
            </div>

            <form action="{{ route('public.pendaftaran.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <div class="fw-bold">Registration Failed!</div>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-section">
                    <h3 class="form-section-title">Data Pribadi</h3>
                    <div class="input-grid">
                        <div class="input-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" placeholder="Sesuai KTP" required>
                        </div>

                        <div class="input-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>

                        <div class="input-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Sesuai KTP" required>
                        </div>

                        <div class="input-group full-width">
                            <label>Tinggi & Berat Badan</label>
                            <div class="dual-input-group">
                                <div class="dual-input">
                                    <input type="number" id="tinggi_badan" name="tinggi_badan" placeholder="170"
                                        min="50" max="250" step="0.1" required>
                                    <span class="dual-unit">cm</span>
                                </div>
                                <div class="divider">/</div>
                                <div class="dual-input">
                                    <input type="number" id="berat_badan" name="berat_badan" placeholder="60"
                                        min="20" max="200" step="0.1" required>
                                    <span class="dual-unit">kg</span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="usia">Usia</label>
                            <input type="number" id="usia" name="usia" placeholder="Akan terhitung otomatis"
                                readonly>
                            <small class="hint-text">Diisi otomatis berdasarkan tanggal lahir</small>
                        </div>


                        <div class="input-group">
                            <label for="hobi">Hobi</label>
                            <input type="text" id="hobi" name="hobi" placeholder="Hobi Anda" required>
                        </div>

                        <div class="input-group full-width">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" placeholder="Nama Jalan, RT/RW, Desa, Kecamatan, Kota" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Kontak & Latar Belakang</h3>
                    <div class="input-grid">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="email@contoh.com" required>
                        </div>

                        <div class="input-group">
                            <label for="telepon">Nomor WhatsApp</label>
                            <input type="text" id="telepon" name="telepon" placeholder="08xx-xxxx-xxxx" required>
                        </div>

                        <div class="input-group">
                            <label for="telepon_ortu">No. Telp Orang Tua/Wali</label>
                            <input type="text" id="telepon_ortu" name="telepon_ortu" placeholder="Nomor Darurat"
                                required>
                        </div>

                        <div class="input-group">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" id="asal_sekolah" name="asal_sekolah"
                                placeholder="Nama Sekolah Terakhir" required>
                        </div>

                        <div class="input-group full-width">
                            <label for="kerja">Pengalaman Kerja</label>
                            <textarea id="kerja" name="kerja" placeholder="Tulis '-' jika belum ada"></textarea>
                        </div>

                        <div class="input-group full-width">
                            <label class="form-label">Minat Program <span class="text-danger">*</span></label>

                            @error('program_id')
                                <small class="text-danger d-block mb-2">{{ $message }}</small>
                            @enderror

                            <div class="radio-card-group">
                                @if ($programs->count() > 0)
                                    @foreach ($programs as $program)
                                        <label class="radio-card">
                                            <input type="radio" name="program_id" value="{{ $program->id }}"
                                                {{ old('program_id') == $program->id ? 'checked' : '' }} required>

                                            <div class="card-content">
                                                <span class="card-title">{{ $program->program_name }}</span>

                                                {{-- USE SUBTITLE HERE (Short Text) --}}
                                                @if ($program->subtitle)
                                                    <span class="card-sub">{{ $program->subtitle }}</span>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                @else
                                    <div class="alert alert-warning w-100">
                                        Mohon maaf, belum ada program yang dibuka saat ini.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Upload Dokumen</h3>
                    <p class="section-subtitle">Format: PDF/JPG/PNG (Maks. 2MB)</p>

                    <div class="file-grid">
                        <div class="file-upload-card">
                            <div class="file-header">
                                <span class="file-icon">📄</span>
                                <span class="file-label">Kartu Keluarga (KK)</span>
                            </div>
                            <div class="file-preview" id="preview-kk"></div>
                            <input type="file" id="scan_kk" name="scan_kk" accept="image/*,.pdf"
                                onchange="previewImage(event, 'preview-kk')" required>
                        </div>

                        <div class="file-upload-card">
                            <div class="file-header">
                                <span class="file-icon">🆔</span>
                                <span class="file-label">KTP</span>
                            </div>
                            <div class="file-preview" id="preview-ktp"></div>
                            <input type="file" id="scan_ktp" name="scan_ktp" accept="image/*,.pdf"
                                onchange="previewImage(event, 'preview-ktp')" required>
                        </div>

                        <div class="file-upload-card">
                            <div class="file-header">
                                <span class="file-icon">👶</span>
                                <span class="file-label">Akta Kelahiran</span>
                            </div>
                            <div class="file-preview" id="preview-akta"></div>
                            <input type="file" id="scan_akta" name="scan_akta" accept="image/*,.pdf"
                                onchange="previewImage(event, 'preview-akta')" required>
                        </div>

                        <div class="file-upload-card">
                            <div class="file-header">
                                <span class="file-icon">🎓</span>
                                <span class="file-label">Ijazah SD</span>
                            </div>
                            <div class="file-preview" id="preview-sd"></div>
                            <input type="file" id="scan_ijazah_sd" name="scan_ijazah_sd" accept="image/*,.pdf"
                                onchange="previewImage(event, 'preview-sd')" required>
                        </div>

                        <div class="file-upload-card">
                            <div class="file-header">
                                <span class="file-icon">🎓</span>
                                <span class="file-label">Ijazah SMP</span>
                            </div>
                            <div class="file-preview" id="preview-smp"></div>
                            <input type="file" id="scan_ijazah_smp" name="scan_ijazah_smp" accept="image/*,.pdf"
                                onchange="previewImage(event, 'preview-smp')" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="cta-btn">
                    <span>Kirim Pendaftaran</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tanggalLahirInput = document.getElementById('tanggal_lahir');
                const usiaInput = document.getElementById('usia');

                // Function to calculate age
                function calculateAge(birthDate) {
                    const today = new Date();
                    const birth = new Date(birthDate);

                    let age = today.getFullYear() - birth.getFullYear();
                    const monthDiff = today.getMonth() - birth.getMonth();

                    // Adjust age if birthday hasn't occurred yet this year
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                        age--;
                    }

                    return age;
                }

                // Update age when date changes
                tanggalLahirInput.addEventListener('change', function() {
                    if (this.value) {
                        const age = calculateAge(this.value);
                        usiaInput.value = age;

                        // Optional: Add validation for reasonable age
                        if (age < 0 || age > 150) {
                            usiaInput.style.borderColor = '#dc3545';
                            usiaInput.style.backgroundColor = '#fff5f5';
                        } else {
                            usiaInput.style.borderColor = '';
                            usiaInput.style.backgroundColor = '';
                        }
                    } else {
                        usiaInput.value = '';
                    }
                });

                // Also update age if page loads with a pre-filled date (for edit forms)
                if (tanggalLahirInput.value) {
                    const age = calculateAge(tanggalLahirInput.value);
                    usiaInput.value = age;
                }

                // Prevent manual editing of usia field
                usiaInput.addEventListener('keydown', function(e) {
                    e.preventDefault();
                    return false;
                });

                usiaInput.addEventListener('click', function() {
                    tanggalLahirInput.focus();
                    tanggalLahirInput.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                });
            });

            function previewImage(event, previewId) {
                const input = event.target;
                const previewContainer = document.getElementById(previewId);

                // Clear previous preview
                previewContainer.innerHTML = '';

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const fileType = file.type;

                    // Check if it is an image
                    if (fileType.startsWith('image/')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            previewContainer.appendChild(img);
                        }

                        reader.readAsDataURL(file);
                    } else {
                        // Fallback for PDFs or other files
                        const msg = document.createElement('p');
                        msg.textContent = "📄 File PDF terpilih: " + file.name;
                        previewContainer.appendChild(msg);
                    }
                }
            }
        </script>
    @endpush
@endsection
