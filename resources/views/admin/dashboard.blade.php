@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
    <link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">Overview</li>
@endsection

@section('content')
    <livewire:admin.stats-overview />

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card fade-in">
                <div class="card-header">
                    <h5 class="card-title mb-2">Statistik Pendaftaran</h5>

                    <livewire:admin.registration-chart />
                </div>
                <div class="card-body">
                    <div class="chart-placeholder">
                        <div class="text-center">
                            <i class="fas fa-chart-line fa-3x mb-3 opacity-50"></i>
                            <p class="mb-1">Grafik Pendaftaran Peserta</p>
                            <small class="text-muted">Menampilkan tren pendaftar baru per bulan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card fade-in" style="animation-delay: 0.2s">
                <div class="card-header">
                    <h5 class="card-title mb-0">Menu Utama</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <x-admin.action-card icon="fas fa-clipboard-list" color="primary" title="Data Pendaftar"
                            subtitle="Kelola & Verifikasi Peserta" link="#" />

                        <x-admin.action-card icon="fas fa-file-pdf" color="danger" title="Export PDF"
                            subtitle="Unduh Laporan Pendaftaran" link="#" />

                        <x-admin.action-card icon="fas fa-camera" color="info" title="Kelola Galeri"
                            subtitle="Upload Foto Kegiatan" link="#" />

                        <x-admin.action-card icon="fas fa-cog" color="secondary" title="Pengaturan"
                            subtitle="Konfigurasi Website" link="#" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        console.log('LPK Dashboard loaded');
    </script>
@endpush
