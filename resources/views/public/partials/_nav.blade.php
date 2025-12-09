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
                <li class="dropdown">
                    @php
                        $programActive =
                            Request::is('pemagangan-jepang') || Request::is('tokutei-ginou') || Request::is('im-japan');
                    @endphp
                    <a href="#services" class="{{ $programActive ? 'active' : '' }}">
                        <span>Program</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="/pemagangan-jepang"
                                class="{{ Request::is('pemagangan-jepang') ? 'active' : '' }}">Program Pemagangan
                                Jepang</a></li>
                        <li><a href="/tokutei-ginou" class="{{ Request::is('tokutei-ginou') ? 'active' : '' }}">Program
                                Visa Kerja (Tokutei
                                Ginou)</a></li>
                        <li><a href="/im-japan" class="{{ Request::is('im-japan') ? 'active' : '' }}">Program IM
                                Japan</a></li>
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
