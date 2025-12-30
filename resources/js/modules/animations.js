import AOS from "aos";
import PureCounter from "@srexi/purecounterjs";

export function initAnimations() {
    // 1. Preloader
    const preloader = document.querySelector("#preloader");
    if (preloader) {
        window.addEventListener("load", () => preloader.remove());
    }

    // 2. Animation on Scroll (AOS)
    const aosInit = () => {
        AOS.init({
            duration: 600,
            easing: "ease-in-out",
            once: true,
            mirror: false,
        });
    };
    window.addEventListener("load", aosInit);

    // 3. Pure Counter
    new PureCounter();
}
