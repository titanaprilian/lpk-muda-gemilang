<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin — {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="{{ asset('assets/css/admin-auth.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block auth-sidebar">
                <div class="px-3">
                    <div class="logo-container">
                        <img src="{{ asset('assets/img/LPK MUDA GEMILANG.jpeg') }}" alt="Logo"
                            class="w-100 rounded">
                    </div>

                    <h1>Panel Administrator</h1>
                    <p>Sistem manajemen terpadu untuk pengelolaan data dan operasional</p>

                    <ul class="features-list">
                        <li>Dashboard analitik real-time</li>
                        <li>Manajemen pengguna terpusat</li>
                        <li>Keamanan multi-lapis</li>
                        <li>Laporan otomatis</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 login-container">
                <div class="login-card">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle logic
            const toggleBtn = document.querySelector('.password-toggle');
            const passwordInput = document.querySelector('input[name="password"]');

            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('fa-eye');
                        icon.classList.toggle('fa-eye-slash');
                    }
                });
            }

            // Loading state for login button
            const loginForm = document.querySelector('form');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const btn = this.querySelector('.btn-login');
                    if (btn) {
                        const originalText = btn.innerHTML;
                        btn.innerHTML =
                            '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                        btn.disabled = true;

                        // Fallback reset
                        setTimeout(() => {
                            if (btn.disabled) {
                                btn.innerHTML = originalText;
                                btn.disabled = false;
                            }
                        }, 5000);
                    }
                });
            }
        });
    </script>
</body>

</html>
