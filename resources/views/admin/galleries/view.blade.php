@extends('layouts.admin')

@section('title', 'Detail Gambar')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            {{-- Pass the ID from the route controller --}}
            @livewire('admin.gallery.gallery-show', ['id' => $id])
        </div>
    </div>
@endsection
