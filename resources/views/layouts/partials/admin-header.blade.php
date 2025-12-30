<header class="admin-header py-5">
    <div class="header-left">
        {{-- FIXED ID HERE: changed from toggleSidebar to sidebarToggle --}}
        <button class="toggle-sidebar" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <div class="page-title">
            {{-- Title --}}
            <h1>@yield('page-title', 'Dashboard')</h1>

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a>
                    </li>
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
    </div>

    <div class="header-right">
        {{-- Notification --}}
        <button class="header-action position-relative" title="Notifications">
            <i class="fas fa-bell"></i>
            {{-- Badge --}}
            <span class="notification-badge">3</span>
        </button>

        {{-- User Dropdown --}}
        <div class="dropdown">
            <button class="header-action" type="button" id="userDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user-circle fa-lg"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                <li>
                    <h6 class="dropdown-header">Halo, Admin!</h6>
                </li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profil Saya</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Pengaturan</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
