@extends('layouts.app')

@section('title', $program->program_name)

@section('content')

    {{-- 1. Hero / Header Section --}}
    {{-- UPDATED: Overlay darkened slightly to 0.7 for better contrast --}}
    <section class="program-hero position-relative d-flex align-items-center justify-content-center text-white"
        style="min-height: 400px; background-size: cover; background-position: center;
                    background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ $program->image ? asset('storage/' . $program->image) : asset('assets/img/hero-bg.jpg') }}');">

        <div class="container text-center position-relative" data-aos="fade-up">
            <span class="badge text-uppercase ls-1 mb-3 px-3 py-2" style="background-color: var(--accent-color)">Program
                Kami</span>

            {{-- UPDATED: Added 'text-shadow-hero' class --}}
            <h1 class="display-4 fw-bold text-shadow-hero text-white">{{ $program->program_name }}</h1>

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="d-flex justify-content-center mt-3">
                <ol class="breadcrumb mb-0" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                    <li class="breadcrumb-item"><a href="{{ route('public.home') }}"
                            class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $program->program_name }}</li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- 2. Content Section --}}
    <section class="section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5" style="margin-top: -80px; z-index: 10;">
                        <div class="card-body">

                            {{-- Short Description --}}
                            <div class="lead text-muted mb-4 fst-italic border-start border-4 ps-4"
                                style="border-color: var(--accent-color) !important;">
                                {{ $program->description }}
                            </div>

                            <hr class="opacity-10 my-4">

                            {{-- Main HTML Content (Trix Output) --}}
                            <div class="program-content trix-content">
                                {!! $program->content !!}
                            </div>

                            {{-- Call to Action / Register Button --}}
                            <div class="mt-5 text-center">
                                <a href="{{ route('public.pendaftaran.form') }}?program={{ $program->id }}"
                                    class="btn btn-lg rounded-pill px-5 shadow-sm text-white"
                                    style="background-color: var(--accent-color)">
                                    <i class="fas fa-paper-plane me-2"></i> Daftar Program Ini
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        /* NEW: Text Shadow for better visibility on hero images */
        .text-shadow-hero {
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
        }

        /* Existing Trix Styles */
        .program-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Added subtle shadow to content images */
        }

        .program-content h2,
        .program-content h3 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: #2c3e50;
            font-weight: bold;
        }

        .program-content ul,
        .program-content ol {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .program-content p {
            margin-bottom: 1rem;
            line-height: 1.7;
        }
    </style>
@endpush
