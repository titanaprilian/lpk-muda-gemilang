import * as bootstrap from "bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    // 1. Password Toggle Logic
    const toggleBtn = document.querySelector(".password-toggle");
    const passwordInput = document.querySelector('input[name="password"]');

    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener("click", function () {
            const type =
                passwordInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            passwordInput.setAttribute("type", type);

            const icon = this.querySelector("i");
            if (icon) {
                icon.classList.toggle("fa-eye");
                icon.classList.toggle("fa-eye-slash");
            }
        });
    }

    // 2. Loading State for Login Button
    const loginForm = document.querySelector("form");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            const btn = this.querySelector(".btn-login");
            if (btn) {
                const originalText = btn.innerHTML;
                btn.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                btn.disabled = true;

                // Fallback reset (in case validation fails via AJAX or similar)
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
