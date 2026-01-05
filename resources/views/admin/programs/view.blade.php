@extends('layouts.admin')

@section('title', 'Detail Program')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            {{-- Pass the ID to the Livewire component --}}
            @livewire('admin.program.program-show', ['id' => $id])
        </div>
    </div>
@endsection
