const SELECTOR = '.donation-fab';
const ACTIVE_CLASS = 'is-active';
const INITIAL_DELAY = 1400;
const SETTLE_DELAY = 700;
const SCROLL_TOLERANCE = 6;

export default class DonationButton {
    static initialize() {
        const fab = document.querySelector(SELECTOR);

        if (!fab) {
            return;
        }

        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        let lastY = window.scrollY;
        let settleTimer = null;

        const show = () => fab.classList.add(ACTIVE_CLASS);
        const hide = () => fab.classList.remove(ACTIVE_CLASS);

        const queueShow = (delay) => {
            window.clearTimeout(settleTimer);
            settleTimer = window.setTimeout(show, delay);
        };

        if (prefersReducedMotion) {
            show();
            return;
        }

        queueShow(INITIAL_DELAY);

        const onScroll = () => {
            const currentY = window.scrollY;

            if (Math.abs(currentY - lastY) < SCROLL_TOLERANCE) {
                return;
            }

            lastY = currentY;
            hide();
            queueShow(SETTLE_DELAY);
        };

        window.addEventListener('scroll', onScroll, { passive: true });
    }
}
