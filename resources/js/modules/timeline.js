const SELECTOR_ITEM = '.timeline-item';
const SELECTOR_CARD = '.timeline-item__card';
const SELECTOR_CONTENT = '[data-timeline-content]';
const SELECTOR_TOGGLE = '[data-timeline-toggle]';
const INTERACTIVE_SELECTOR = 'a, button, input, textarea, select, [role="button"]';
const EXPANDED_CLASS = 'is-expanded';
const NO_COLLAPSE_CLASS = 'is-no-collapse';

export default class Timeline {
    static initialize() {
        const items = document.querySelectorAll(SELECTOR_ITEM);

        if (!items.length) {
            return;
        }

        items.forEach((item) => Timeline.bindItem(item));
    }

    static bindItem(item) {
        const card = item.querySelector(SELECTOR_CARD);
        const content = item.querySelector(SELECTOR_CONTENT);
        const toggle = item.querySelector(SELECTOR_TOGGLE);

        if (!content || !toggle) {
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
                // Inklappen: zet expliciet de huidige hoogte (voor smooth
                // transition vanuit het uitgebreide formaat), forceer reflow,
                // en herstel dan de CSS-default door inline style te wissen.
                content.style.maxHeight = content.scrollHeight + 'px';
                // eslint-disable-next-line no-unused-expressions
                content.offsetHeight;
                content.style.maxHeight = '';
                item.classList.remove(EXPANDED_CLASS);
                toggle.setAttribute('aria-expanded', 'false');
            } else {
                // Uitklappen: zet max-height naar gemeten scrollHeight zodat
                // de transition glad loopt van CSS-default → echte hoogte.
                content.style.maxHeight = content.scrollHeight + 'px';
                item.classList.add(EXPANDED_CLASS);
                toggle.setAttribute('aria-expanded', 'true');
            }
        };

        toggle.addEventListener('click', (event) => {
            event.stopPropagation();
            toggleExpand();
        });

        // Maak de hele kaart klikbaar — handig op mobile waar gebruikers
        // vaak ergens op de kaart tappen. Links/knoppen in de content worden
        // gerespecteerd zodat ze hun eigen actie blijven uitvoeren.
        if (card) {
            card.addEventListener('click', (event) => {
                if (event.target.closest(INTERACTIVE_SELECTOR)) {
                    return;
                }

                // Voorkom dat tekst-selectie de toggle triggert.
                const selection = window.getSelection();
                if (selection && selection.toString().length > 0) {
                    return;
                }

                toggleExpand();
            });
        }
    }
}
