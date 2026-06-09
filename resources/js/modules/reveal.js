const SELECTOR = '[data-reveal]';
const IN_CLASS = 'is-revealed';

export default class Reveal {
    static initialize() {
        const elements = document.querySelectorAll(SELECTOR);

        if (!elements.length) {
            return;
        }

        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (prefersReducedMotion || !('IntersectionObserver' in window)) {
            elements.forEach((el) => el.classList.add(IN_CLASS));
            return;
        }

        const observer = new IntersectionObserver(
            (entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add(IN_CLASS);
                        obs.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.12,
                rootMargin: '0px 0px -6% 0px',
            },
        );

        elements.forEach((el) => observer.observe(el));
    }
}
