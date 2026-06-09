const SELECTOR_ITEM = '.faq-item';
const SELECTOR_CONTENT = '[data-faq-content]';
const SELECTOR_TOGGLE = '[data-faq-toggle]';
const OPEN_CLASS = 'is-open';

export default class Faq {
    static initialize() {
        const items = document.querySelectorAll(SELECTOR_ITEM);

        if (!items.length) {
            return;
        }

        items.forEach((item) => Faq.bindItem(item));
    }

    static bindItem(item) {
        const content = item.querySelector(SELECTOR_CONTENT);
        const toggle = item.querySelector(SELECTOR_TOGGLE);

        if (!content || !toggle) {
            return;
        }

        // Default state: helemaal dichtgeklapt.
        content.style.maxHeight = '0px';
        content.style.overflow = 'hidden';
        content.style.transition = 'max-height 0.5s cubic-bezier(0.22, 1, 0.36, 1)';

        toggle.addEventListener('click', () => {
            const isOpen = item.classList.contains(OPEN_CLASS);

            if (isOpen) {
                // Inklappen: zet huidige hoogte, forceer reflow, zet naar 0.
                content.style.maxHeight = content.scrollHeight + 'px';
                // eslint-disable-next-line no-unused-expressions
                content.offsetHeight;
                content.style.maxHeight = '0px';
                item.classList.remove(OPEN_CLASS);
                toggle.setAttribute('aria-expanded', 'false');
            } else {
                // Uitklappen: zet max-height naar de echte scrollHeight.
                content.style.maxHeight = content.scrollHeight + 'px';
                item.classList.add(OPEN_CLASS);
                toggle.setAttribute('aria-expanded', 'true');
            }
        });
    }
}
