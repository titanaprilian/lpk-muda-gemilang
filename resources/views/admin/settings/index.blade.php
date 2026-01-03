@extends('layouts.admin')
@section('title', 'Pengaturan') @section('page-title', 'Pengaturan')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Pengaturan</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mt-4">
                <div class="card-body text-center py-5">
                    {{-- Ikon (menggunakan FontAwesome) --}}
                    <div class="mb-4 text-warning">
                        <i class="fas fa-hard-hat fa-4x"></i>
                    </div>

                    <h3 class="mb-3">Sedang Dalam Pengembangan</h3>

                    <p class="text-muted mb-4">
                        Kami sedang mengembangkan fitur <strong>Pengaturan</strong>.
                        <br>
                        Modul ini akan tersedia pada pembaruan selanjutnya.
                    </p>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
