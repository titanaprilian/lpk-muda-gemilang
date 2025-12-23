<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') — {{ config('app.name', 'Muda Gemilang') }}</title>

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="{{ asset('assets/css/admin-layout.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <div class="admin-container">

        @include('layouts.partials.admin-sidebar')

        <main class="admin-main">

            @include('layouts.partials.admin-header')

            <div class="admin-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('js/admin-layout.js') }}"></script>

    @stack('scripts')
</body>

</html>
