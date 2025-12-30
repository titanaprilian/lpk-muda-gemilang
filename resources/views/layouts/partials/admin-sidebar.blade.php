<aside class="admin-sidebar" id="sidebar">
    <div class="sidebar-header d-flex align-items-center py-5">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <img src="{{ asset('assets/img/LPK MUDA GEMILANG.jpeg') }}" alt="Logo">
            <div class="brand-text">
                <h2>Muda Gemilang</h2>
                <span>Admin Panel</span>
            </div>
        </a>
    </div>

    <nav class="sidebar-nav">

        {{-- Loop through Sections --}}
        @foreach (config('sidebar') as $section)
            <div class="nav-section">
                <div class="nav-title">{{ $section['title'] }}</div>

                <ul class="nav-menu">
                    {{-- Loop through Menus in that Section --}}
                    @foreach ($section['menus'] as $menu)
                        <li class="nav-item">
                            {{-- Check if route exists to prevent crashes during development --}}
                            @php
                                $url = Route::has($menu['route']) ? route($menu['route']) : '#';
                                $isActive = request()->routeIs($menu['active_route']);
                            @endphp

                            <a href="{{ $url }}" class="nav-link {{ $isActive ? 'active' : '' }}">
                                <i class="{{ $menu['icon'] }}"></i>
                                <span>{{ $menu['title'] }}</span>

                                {{-- Optional Badge --}}
                                @if (isset($menu['badge']))
                                    <span class="nav-badge">{{ $menu['badge'] }}</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach

    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="user-details">
                <h4>{{ Auth::user()->name ?? 'Guest' }}</h4>
                <small>Administrator</small>
            </div>
        </div>
    </div>
</aside>
