import Swiper from "swiper/bundle";

export function initSliders() {
    initHeroCarousel();
    initTestimonialsSlider();
}

/**
 * 1. Bootstrap Hero Carousel Indicators
 */
function initHeroCarousel() {
    const indicators = document.querySelectorAll(".carousel-indicators");

    indicators.forEach((indicatorList) => {
        const carousel = indicatorList.closest(".carousel");
        const items = carousel.querySelectorAll(".carousel-item");

        // Clear existing to prevent duplicates if function runs twice
        indicatorList.innerHTML = "";

        items.forEach((item, index) => {
            const li = document.createElement("li");
            li.setAttribute("data-bs-target", `#${carousel.id}`);
            li.setAttribute("data-bs-slide-to", index);

            if (index === 0) {
                li.classList.add("active");
                li.setAttribute("aria-current", "true");
            }

            indicatorList.appendChild(li);
        });
    });
}

/**
 * 2. Swiper Testimonials Configuration
 */
function initTestimonialsSlider() {
    const sliderElement = document.querySelector("#testimonials-slider");

    if (!sliderElement) return;

    const config = {
        loop: true,
        speed: 600,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false, // User touches won't permanently stop autoplay
        },
        slidesPerView: "auto",
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 40,
            },
            1200: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
        },
    };

    new Swiper(sliderElement, config);
}
