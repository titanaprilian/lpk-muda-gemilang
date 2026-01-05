@extends('layouts.admin')

@section('title', 'Daftar Program')
@section('page-title', 'Daftar Program')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Program</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <livewire:admin.program.program-table />
        </div>
    </div>
@endsection
