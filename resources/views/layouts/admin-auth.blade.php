<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Admin — {{ config('app.name') }}</title>

    {{-- Favicon --}}
    <link href="{{ asset('assets/img/LPK MUDA GEMILANG.jpeg') }}" rel="icon">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- VITE ASSETS (Loads Bootstrap, FontAwesome, and Custom CSS/JS) --}}
    @vite(['resources/css/app.css', 'resources/css/admin-auth.css', 'resources/js/admin-auth.js'])
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- Left Sidebar --}}
            <div class="col-lg-6 d-none d-lg-block auth-sidebar">
                <div class="px-3">
                    <div class="logo-container">
                        <img src="{{ asset('assets/img/LPK MUDA GEMILANG.jpeg') }}" alt="Logo LPK"
                            class="w-100 rounded">
                    </div>

                    <h1 class="text-white">Panel Administrator</h1>
                    <p>Sistem manajemen terpadu untuk pengelolaan data dan operasional</p>

                    <ul class="features-list">
                        <li>Dashboard analitik real-time</li>
                        <li>Manajemen pengguna terpusat</li>
                        <li>Keamanan multi-lapis</li>
                        <li>Laporan otomatis</li>
                    </ul>
                </div>
            </div>

            {{-- Right Login Form --}}
            <div class="col-lg-6 login-container">
                <div class="login-card">
                    {{-- Content from the Login View --}}
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>
