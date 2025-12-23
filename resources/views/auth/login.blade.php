@extends('layouts.admin-auth')

@section('content')
    <div class="login-header">
        <div class="logo">
            <i class="fas fa-lock"></i>
        </div>
        <h3>Masuk ke Sistem</h3>
        <p>Gunakan akun Anda untuk mengakses panel admin</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('status') }}</div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf

        {{-- EMAIL FIELD --}}
        <div class="mb-3">
            <label class="form-label small text-muted mb-1">EMAIL</label>
            <div class="input-group">
                {{-- Added conditional error classes to the icon span --}}
                <span class="input-group-text @error('email') border-danger text-danger bg-danger-subtle @enderror">
                    <i class="fas fa-envelope"></i>
                </span>

                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="email@domain.com" required autofocus value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="text-danger small mt-1">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        {{-- PASSWORD FIELD --}}
        <div class="mb-3">
            <label class="form-label small text-muted mb-1">KATA SANDI</label>
            <div class="input-group">
                {{-- Added conditional error classes to the icon span --}}
                <span class="input-group-text @error('password') border-danger text-danger bg-danger-subtle @enderror">
                    <i class="fas fa-lock"></i>
                </span>

                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••••" required>

                {{-- Added conditional border to the toggle button as well --}}
                <button type="button"
                    class="password-toggle btn btn-outline-secondary @error('password') border-danger text-danger @enderror"
                    style="border-left: 0;">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger small mt-1">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Ingat saya
                </label>
            </div>
            <a href="{{ route('admin.password.request') }}" class="forgot-link">
                Lupa sandi?
            </a>
        </div>

        <button class="btn btn-login mb-3 text-white" type="submit">
            <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
        </button>

        <div class="text-center mb-2">
            <small class="text-muted">
                <i class="fas fa-shield-alt me-1"></i>
                Sesi akan berakhir dalam 2 jam
            </small>
        </div>

        <div class="footer">
            <div class="mb-1">
                <small>
                    &copy; {{ date('Y') }} {{ config('app.name') }}
                </small>
            </div>
            <div>
                <small>
                    v{{ config('app.version', '1.0.0') }}
                </small>
            </div>
        </div>
    </form>
@endsection
