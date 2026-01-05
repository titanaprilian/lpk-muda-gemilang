<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        {{-- Logo Section --}}
        <a href="/" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('assets/img/logo lpk.png') }}" alt="Logo Muda Gemilang" class="img-fluid logo-img">
        </a>

        {{-- Navigation Menu --}}
        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="/#hero" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                </li>
                <li>
                    <a href="/#about" class="{{ Request::is('*about*') ? 'active' : '' }}">Tentang
                        Kami</a>
                </li>
                {{-- DYNAMIC PROGRAM DROPDOWN --}}
                <li class="dropdown">
                    <a href="#services" class="{{ Request::routeIs('public.program.show') ? 'active' : '' }}">
                        <span>Program</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        @foreach ($globalPrograms as $navProgram)
                            <li>
                                {{-- 
                                    1. Route: Points to the dynamic show page
                                    2. Active Class: Checks if current URL matches this specific program slug
                                --}}
                                <a href="{{ route('public.program.show', $navProgram->slug) }}"
                                    class="{{ Request::is('program/' . $navProgram->slug) ? 'active' : '' }}">
                                    {{ $navProgram->program_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="/#galeri">Galeri</a></li>
                <li><a href="/#contact">Kontak</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="/pendaftaran">Daftar</a>
    </div>
</header>
