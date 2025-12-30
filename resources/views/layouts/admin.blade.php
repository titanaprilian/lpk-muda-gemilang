<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') — {{ config('app.name', 'Muda Gemilang') }}</title>

    {{-- Favicon --}}
    <link href="{{ asset('assets/img/LPK MUDA GEMILANG.jpeg') }}" rel="icon">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- VITE ASSETS --}}
    {{-- We load app.css for basic bootstrap/utilities, and admin-layout.css for specific dashboard styles --}}
    @vite(['resources/css/app.css', 'resources/css/admin-layout.css', 'resources/js/admin-layout.js'])

    @stack('styles')
</head>

<body>
    <div class="admin-container">

        {{-- Sidebar Component --}}
        @include('layouts.partials.admin-sidebar')

        <main class="admin-main">
            {{-- Header/Navbar Component --}}
            @include('layouts.partials.admin-header')

            <div class="admin-content p-4">
                {{-- Flash Messages (Toast/Alerts) --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>

            {{-- Toast Logic --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    @if (session('success'))
                        Toast.success("{{ session('success') }}");
                    @endif
                    @if (session('error'))
                        Toast.error("{{ session('error') }}");
                    @endif
                    @if (session('warning'))
                        Toast.warning("{{ session('warning') }}");
                    @endif
                    @if (session('info'))
                        Toast.info("{{ session('info') }}");
                    @endif
                });

                document.addEventListener('livewire:init', () => {
                    Livewire.on('trigger-toast', (event) => {
                        // event is an array in Livewire v3, usually [0] contains the payload
                        // or strictly mapped properties depending on dispatch method. 
                        // We'll handle the generic object style:

                        // Allow access to payload whether it comes as object or array
                        let data = event[0] || event;

                        if (window.Toast && window.Toast[data.type]) {
                            window.Toast[data.type](data.message);
                        }
                    });
                });
            </script>
        </main>
    </div>

    @stack('scripts')
</body>

</html>
