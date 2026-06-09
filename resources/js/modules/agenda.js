const SELECTOR_ITEM = '.agenda-item';
const SELECTOR_CONTENT = '[data-agenda-content]';
const SELECTOR_TOGGLE = '[data-agenda-toggle]';
const INTERACTIVE_SELECTOR = 'a, button, input, textarea, select, [role="button"]';
const EXPANDED_CLASS = 'is-expanded';
const NO_COLLAPSE_CLASS = 'is-no-collapse';

export default class Agenda {
    static initialize() {
        const items = document.querySelectorAll(SELECTOR_ITEM);

        if (!items.length) {
            return;
        }

        items.forEach((item) => Agenda.bindItem(item));
    }

    static bindItem(item) {
        const content = item.querySelector(SELECTOR_CONTENT);
        const toggle = item.querySelector(SELECTOR_TOGGLE);

        if (!content || !toggle) {
            // Item zonder collapsible content: niets te doen.
            return;
        }

        // Meet of de content de collapsed-hoogte overschrijdt; zo niet, geen
        // toggle nodig. Marge van 4px voor sub-pixel/rendering verschillen.
        const collapsedHeight = content.offsetHeight;
        const fullHeight = content.scrollHeight;

        if (fullHeight <= collapsedHeight + 4) {
            item.classList.add(NO_COLLAPSE_CLASS);
            toggle.hidden = true;
            return;
        }

        const toggleExpand = () => {
            const isExpanded = item.classList.contains(EXPANDED_CLASS);

            if (isExpanded) {
                content.style.maxHeight = content.scrollHeight + 'px';
                // eslint-disable-next-line no-unused-expressions
                content.offsetHeight;
                content.style.maxHeight = '';
                item.classList.remove(EXPANDED_CLASS);
                toggle.setAttribute('aria-expanded', 'false');
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                item.classList.add(EXPANDED_CLASS);
                toggle.setAttribute('aria-expanded', 'true');
            }
        };

        toggle.addEventListener('click', (event) => {
            event.stopPropagation();
            toggleExpand();
        });

        // De rest van het item is ook klikbaar (handig op mobiel) — maar
        // respecteer links/buttons/inputs en tekst-selectie zodat normaal
        // klikken niet wordt overgeschreven.
        item.addEventListener('click', (event) => {
            if (event.target.closest(INTERACTIVE_SELECTOR)) {
                return;
            }

            const selection = window.getSelection();
            if (selection && selection.toString().length > 0) {
                return;
            }

            toggleExpand();
        });
    }
}
