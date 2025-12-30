export function initScrollEffects() {
    // 1. Toggle .scrolled class on body
    const toggleScrolled = () => {
        const selectBody = document.querySelector("body");
        const selectHeader = document.querySelector("#header");
        if (!selectHeader) return;

        if (
            !selectHeader.classList.contains("scroll-up-sticky") &&
            !selectHeader.classList.contains("sticky-top") &&
            !selectHeader.classList.contains("fixed-top")
        )
            return;

        window.scrollY > 100
            ? selectBody.classList.add("scrolled")
            : selectBody.classList.remove("scrolled");
    };

    document.addEventListener("scroll", toggleScrolled);
    window.addEventListener("load", toggleScrolled);

    // 2. Scroll Top Button
    const scrollTop = document.querySelector(".scroll-top");
    if (scrollTop) {
        const toggleScrollTop = () => {
            window.scrollY > 100
                ? scrollTop.classList.add("active")
                : scrollTop.classList.remove("active");
        };

        scrollTop.addEventListener("click", (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: "smooth" });
        });

        window.addEventListener("load", toggleScrollTop);
        document.addEventListener("scroll", toggleScrollTop);
    }

    // 3. Scrollspy (Active link highlighting)
    const navmenulinks = document.querySelectorAll(".navmenu a");
    const navmenuScrollspy = () => {
        navmenulinks.forEach((navmenulink) => {
            if (!navmenulink.hash) return;
            const section = document.querySelector(navmenulink.hash);
            if (!section) return;

            const position = window.scrollY + 200;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                document
                    .querySelectorAll(".navmenu a.active")
                    .forEach((link) => link.classList.remove("active"));
                navmenulink.classList.add("active");
            } else {
                navmenulink.classList.remove("active");
            }
        });
    };
    window.addEventListener("load", navmenuScrollspy);
    document.addEventListener("scroll", navmenuScrollspy);
}
