// Import Modules
import { initScrollEffects } from "./modules/scroll-effects";
import { initMobileNav } from "./modules/mobile-nav";
import { initAnimations } from "./modules/animations";
import { initSliders } from "./modules/sliders";
import { initGallery } from "./modules/gallery";

// Execute Modules
document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    initScrollEffects();
    initMobileNav();
    initAnimations();
    initSliders();
    initGallery();

    // Hash Link Scroll Correction (Kept here as it's a global util)
    window.addEventListener("load", () => {
        if (
            window.location.hash &&
            document.querySelector(window.location.hash)
        ) {
            setTimeout(() => {
                const section = document.querySelector(window.location.hash);
                const scrollMarginTop =
                    getComputedStyle(section).scrollMarginTop;
                window.scrollTo({
                    top: section.offsetTop - parseInt(scrollMarginTop),
                    behavior: "smooth",
                });
            }, 100);
        }
    });
});
