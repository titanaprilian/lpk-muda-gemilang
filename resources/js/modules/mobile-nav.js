export function initMobileNav() {
    const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");
    if (!mobileNavToggleBtn) return;

    const mobileNavToggle = () => {
        document.querySelector("body").classList.toggle("mobile-nav-active");
        mobileNavToggleBtn.classList.toggle("bi-list");
        mobileNavToggleBtn.classList.toggle("bi-x");
    };

    mobileNavToggleBtn.addEventListener("click", mobileNavToggle);

    // Hide mobile nav on same-page/hash links
    document.querySelectorAll("#navmenu a").forEach((navmenu) => {
        navmenu.addEventListener("click", () => {
            if (document.querySelector(".mobile-nav-active")) {
                mobileNavToggle();
            }
        });
    });

    // Dropdowns
    document
        .querySelectorAll(".navmenu .toggle-dropdown")
        .forEach((navmenu) => {
            navmenu.addEventListener("click", function (e) {
                e.preventDefault();
                this.parentNode.classList.toggle("active");
                this.parentNode.nextElementSibling.classList.toggle(
                    "dropdown-active",
                );
                e.stopImmediatePropagation();
            });
        });
}
