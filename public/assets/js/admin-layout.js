document.addEventListener("DOMContentLoaded", function () {
    // Toggle Sidebar on Mobile
    const toggleSidebar = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");

    if (toggleSidebar && sidebar) {
        toggleSidebar.addEventListener("click", function () {
            sidebar.classList.toggle("show");
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener("click", function (event) {
            if (window.innerWidth <= 992) {
                if (
                    !sidebar.contains(event.target) &&
                    !toggleSidebar.contains(event.target)
                ) {
                    sidebar.classList.remove("show");
                }
            }
        });
    }

    // Dropdown functionality
    const dropdowns = document.querySelectorAll(".has-dropdown");
    dropdowns.forEach((dropdown) => {
        const toggle = dropdown.querySelector(".dropdown-toggle");
        const menu = dropdown.querySelector(".nav-dropdown");
        const arrow = dropdown.querySelector(".toggle-dropdown");

        if (toggle && menu) {
            toggle.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();

                // Close other dropdowns
                dropdowns.forEach((other) => {
                    if (other !== dropdown) {
                        other
                            .querySelector(".nav-dropdown")
                            .classList.remove("show");
                        const otherArrow =
                            other.querySelector(".toggle-dropdown");
                        if (otherArrow) otherArrow.classList.remove("rotated");
                    }
                });

                // Toggle current dropdown
                menu.classList.toggle("show");
                if (arrow) arrow.classList.toggle("rotated");
            });
        }
    });

    // Close dropdowns when clicking elsewhere
    document.addEventListener("click", function () {
        dropdowns.forEach((dropdown) => {
            const menu = dropdown.querySelector(".nav-dropdown");
            const arrow = dropdown.querySelector(".toggle-dropdown");
            if (menu) menu.classList.remove("show");
            if (arrow) arrow.classList.remove("rotated");
        });
    });

    // Resize handler
    window.addEventListener("resize", function () {
        if (window.innerWidth > 992 && sidebar) {
            sidebar.classList.remove("show");
        }
    });
});
