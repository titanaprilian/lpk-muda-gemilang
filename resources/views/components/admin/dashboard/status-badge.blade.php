@props(['status'])

@php
    $colors = [
        'Aktif' => 'status-active',
        'Tidak Aktif' => 'status-inactive',
        'Pending' => 'status-pending',
    ];
    $class = $colors[$status] ?? 'status-inactive';
@endphp

<span class="status-badge {{ $class }}">{{ $status }}</span>
