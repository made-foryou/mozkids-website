const HEADER_SELECTOR = '[data-site-header]';
const SCROLLED_CLASS = 'is-scrolled';
const SCROLL_THRESHOLD = 12;

export default class Navigation {
    static initialize() {
        const header = document.querySelector(HEADER_SELECTOR);

        if (!header) {
            return;
        }

        let ticking = false;

        const update = () => {
            const scrolled = window.scrollY > SCROLL_THRESHOLD;
            header.classList.toggle(SCROLLED_CLASS, scrolled);
            ticking = false;
        };

        const onScroll = () => {
            if (!ticking) {
                window.requestAnimationFrame(update);
                ticking = true;
            }
        };

        update();
        window.addEventListener('scroll', onScroll, { passive: true });
    }
}
