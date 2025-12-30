@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@section('page-title', 'Detail Pendaftar')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.registrants.index') }}">Pendaftar</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <livewire:admin.registrant-show :id="$id" />
        </div>
    </div>
@endsection
