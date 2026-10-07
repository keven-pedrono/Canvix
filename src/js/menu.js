const burger = document.querySelector(".menu__burger");
const menu = document.querySelector(".header__navigation");

if (burger && menu) {
    const firstMenuLink = menu.querySelector(".menu__list a");

    function openMenu() {
        menu.classList.add("active");
        burger.setAttribute("aria-expanded", "true");
        firstMenuLink?.focus();
    }

    function closeMenu(restoreFocus = true) {
        menu.classList.remove("active");
        burger.setAttribute("aria-expanded", "false");

        if (restoreFocus) {
            burger.focus();
        }
    }

    burger.addEventListener("click", () => {
        const isOpen = burger.getAttribute("aria-expanded") === "true";

        if (isOpen) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    document.addEventListener("keydown", (event) => {
        const isOpen = burger.getAttribute("aria-expanded") === "true";

        if (event.key === "Escape" && isOpen) {
            closeMenu();
        }
    });

    const mobileViewport = window.matchMedia("(max-width: 800px)");

    mobileViewport.addEventListener("change", (event) => {
        if (!event.matches) {
            closeMenu(false);
        }
    });
}
