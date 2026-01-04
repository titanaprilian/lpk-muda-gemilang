@extends('layouts.admin')

@section('title', 'Galeri Kegiatan')
@section('page-title', 'Galeri Kegiatan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Galeri Kegiatan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <livewire:admin.gallery.gallery-table />
        </div>
    </div>
@endsection
