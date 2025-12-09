@extends('layouts.app')

@section('title', 'Beranda - LPK Muda Gemilang')

@section('content')

    {{-- HERO SECTION --}}
    @include('public.partials._hero')

    {{-- ABOUT SECTION --}}
    @include('public.partials._about')

    {{-- FEATURES SECTION --}}
    @include('public.partials._features')

    {{-- SERVICES SECTION --}}
    @include('public.partials._services')

    {{-- TESTIMONIALS SECTION --}}
    @include('public.partials._testimonials')

    {{-- CTA SECTION --}}
    @include('public.partials._CTA')

    {{-- GALERY SECTION --}}
    @include('public.partials._galery')

    {{-- FAQ SECTION --}}
    @include('public.partials._FAQ')

    {{-- CONTACT SECTION --}}
    @include('public.partials._contact')

@endsection
