document.querySelectorAll(".testimonies").forEach((section) => {
    const slides = section.querySelectorAll(".testimonies__item");
    const previous = section.querySelector('[data-slider-control="previous"]');
    const next = section.querySelector('[data-slider-control="next"]');
    const pagination = section.querySelector(".testimonies__pagination");
    const status = section.querySelector("[data-slider-status]");

    if (slides.length < 2 || !previous || !next || !pagination) {
        return;
    }

    let currentIndex = 0;

    function showSlide() {
        slides.forEach((slide, index) => {
            slide.classList.toggle("active", index === currentIndex);
        });

        previous.disabled = currentIndex === 0;
        next.disabled = currentIndex === slides.length - 1;

        if (status) {
            status.textContent =
                slides[currentIndex].getAttribute("aria-label");
        }
    }

    previous.addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--;
            showSlide();
        }
    });

    next.addEventListener("click", () => {
        if (currentIndex < slides.length - 1) {
            currentIndex++;
            showSlide();
        }
    });

    section.classList.add("testimonies--slider");
    pagination.hidden = false;
    showSlide();
});
