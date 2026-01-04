@extends('layouts.admin')

@section('title', isset($id) ? 'Edit Gambar' : 'Tambah Gambar Baru')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.galleries.index') }}">Galeri Kegiatan</a></li>
    <li class="breadcrumb-item active">{{ isset($id) ? 'Edit' : 'Tambah Baru' }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        {{-- Adjusted column width since Gallery form is simpler than Registrant form --}}
        <div class="col-12">
            {{-- We pass the ID if it exists (for Edit mode) --}}
            @livewire('admin.gallery.gallery-form', ['id' => $id ?? null])
        </div>
    </div>
@endsection
