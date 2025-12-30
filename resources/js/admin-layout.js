import * as bootstrap from "bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    // --- Sidebar Toggle Logic ---
    const sidebarToggle = document.querySelector("#sidebarToggle");
    const sidebar = document.querySelector(".admin-sidebar");
    const content = document.querySelector(".admin-main");

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener("click", function (e) {
            e.preventDefault();
            document.body.classList.toggle("sidebar-toggled");
            sidebar.classList.toggle("toggled");
        });
    }

    // --- Close sidebar when clicking outside on mobile ---
    document.addEventListener("click", function (e) {
        if (window.innerWidth < 768) {
            if (
                document.body.classList.contains("sidebar-toggled") &&
                !sidebar.contains(e.target) &&
                !sidebarToggle.contains(e.target)
            ) {
                document.body.classList.remove("sidebar-toggled");
                sidebar.classList.remove("toggled");
            }
        }
    });
});
