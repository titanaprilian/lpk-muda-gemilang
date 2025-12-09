@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/program.css') }}">
@endpush

@section('title', 'Beranda - LPK Muda Gemilang')

@section('content')
    <section class="hero-section" id="hero">
        <img src="{{ asset('assets/img/jepang.jpg') }}" alt="Gambar Jepang">
        <div class="hero-text">Program Pemagangan Jepang</div>
    </section>

    <section id="pendidikan-bahasa-jepang" class="content">
        <h2>Program Pemagangan Jepang</h2>

        <h4>Persyaratan Umum:</h4>
        <p>Persyaratan Calon Peserta Didik:</p>
        <ul>
            <li><i class="bi bi-check2-circle"></i> Minimal lulusan SMK/SMA sederajat.</li>
            <li><i class="bi bi-check2-circle"></i> Laki-laki atau Perempuan.</li>
            <li><i class="bi bi-check2-circle"></i> Usia minimal 17 tahun, dan maksimal 35 tahun.</li>
            <li><i class="bi bi-check2-circle"></i> Tidak ada bekas tato/tindik/sedang bertato.</li>
            <li><i class="bi bi-check2-circle"></i> Tidak mempunyai riwayat patah tulang.</li>
            <li><i class="bi bi-check2-circle"></i> Tidak mempunyai riwayat penyakit parah.</li>
            <li><i class="bi bi-check2-circle"></i> Tidak ada riwayat buta warna.</li>
        </ul>
    </section>

@endsection
