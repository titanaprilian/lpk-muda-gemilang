@extends('layouts.admin')

@section('title', 'Data Pendaftar')
@section('page-title', 'Data Pendaftar')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pendaftar</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <livewire:admin.registrant.registrant-table />
        </div>
    </div>
@endsection
