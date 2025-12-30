import GLightbox from "glightbox";
import Isotope from "isotope-layout";
import imagesLoaded from "imagesloaded";

export function initGallery() {
    // 1. GLightbox
    GLightbox({ selector: ".glightbox" });

    // 2. Isotope Layout
    document.querySelectorAll(".isotope-layout").forEach((isotopeItem) => {
        const layout = isotopeItem.getAttribute("data-layout") ?? "masonry";
        const filter = isotopeItem.getAttribute("data-default-filter") ?? "*";
        const sort = isotopeItem.getAttribute("data-sort") ?? "original-order";
        const container = isotopeItem.querySelector(".isotope-container");

        let initIsotope;

        // Wait for images to load before organizing layout
        imagesLoaded(container, function () {
            initIsotope = new Isotope(container, {
                itemSelector: ".isotope-item",
                layoutMode: layout,
                filter: filter,
                sortBy: sort,
            });
        });

        // Filter buttons
        isotopeItem
            .querySelectorAll(".isotope-filters li")
            .forEach((filters) => {
                filters.addEventListener("click", function () {
                    isotopeItem
                        .querySelector(".isotope-filters .filter-active")
                        .classList.remove("filter-active");
                    this.classList.add("filter-active");

                    initIsotope.arrange({
                        filter: this.getAttribute("data-filter"),
                    });

                    // Re-trigger AOS if it exists
                    if (typeof AOS !== "undefined") AOS.init();
                });
            });
    });
}
