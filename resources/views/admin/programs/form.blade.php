@extends('layouts.admin')

@section('title', isset($id) ? 'Edit Program' : 'Tambah Program')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.programs.index') }}">Program</a></li>
    <li class="breadcrumb-item active">{{ isset($id) ? 'Edit' : 'Tambah Baru' }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            @livewire('admin.program.program-form', ['id' => $id ?? null])
        </div>
    </div>
@endsection
