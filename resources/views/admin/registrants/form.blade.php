@extends('layouts.admin')

@section('title', isset($id) ? 'Edit Peserta' : 'Tambah Peserta Baru')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.registrants.index') }}">Pendaftar</a></li>
    <li class="breadcrumb-item active">{{ isset($id) ? 'Edit' : 'Tambah Baru' }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            {{-- We pass the ID if it exists (for Edit mode) --}}
            @livewire('admin.registrant.registrant-form', ['id' => $id ?? null])
        </div>
    </div>
@endsection
