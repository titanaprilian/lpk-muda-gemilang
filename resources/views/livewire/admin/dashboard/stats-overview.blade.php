<?php

use Livewire\Volt\Component;
use App\Models\Registrant;

new class extends Component {
    public function with(): array
    {
        return [
            'totalPendaftar' => Registrant::count(),
            // Perhatikan Case Sensitive 'Pending' sesuai default migrasi Anda
            'pending' => Registrant::where('status', 'Pending')->count(),
            'diterima' => Registrant::where('status', 'Accepted')->count(),
            // Contoh logic sederhana: ambil pendaftar bulan ini
            'bulanIni' => Registrant::whereMonth('registration_date', now()->month)->count(),
        ];
    }
}; ?>

<div class="row" wire:poll.10s>
    <x-admin.dashboard.stats-card title="Total Pendaftar" :value="$totalPendaftar" percentage="Total Data" :isIncrease="true"
        icon="fas fa-user-graduate" color="primary" />

    <x-admin.dashboard.stats-card title="Menunggu Verifikasi" :value="$pending" percentage="Perlu Tindakan"
        :isIncrease="false" icon="fas fa-clock" color="warning" delay="0.1" />

    <x-admin.dashboard.stats-card title="Peserta Diterima" :value="$diterima" percentage="Siap Berangkat"
        :isIncrease="true" icon="fas fa-check-circle" color="success" delay="0.2" />

    <x-admin.dashboard.stats-card title="Pendaftar Bulan Ini" :value="$bulanIni" percentage="New Leads" :isIncrease="true"
        icon="fas fa-calendar-alt" color="info" delay="0.3" />
</div>
