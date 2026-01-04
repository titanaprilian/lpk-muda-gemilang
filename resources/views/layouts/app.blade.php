<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>LPK MUDA GEMILANG</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    {{-- Favicons --}}
    <link href="{{ asset('assets/img/LPK MUDA GEMILANG.jpeg') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    {{-- VITE (Loads all CSS and JS) --}}
    @vite(['resources/css/app.css', 'resources/css/main.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="index-page">

    @include('public.partials._nav')

    <main class="main">
        @yield('content')
    </main>

    @include('public.partials._footer')

    {{-- Scroll Top --}}
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

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
    </script>

    @stack('scripts')
</body>

</html>
