const SELECTOR_ITEM = '.team-member';
const SELECTOR_CONTENT = '[data-team-bio]';
const SELECTOR_INNER = '.team-member__bio-content';
const SELECTOR_TOGGLE = '[data-team-toggle]';
const EXPANDED_CLASS = 'is-expanded';
const NO_COLLAPSE_CLASS = 'is-no-collapse';

export default class TeamBio {
    static initialize() {
        const items = document.querySelectorAll(SELECTOR_ITEM);

        if (!items.length) {
            return;
        }

        items.forEach((item) => TeamBio.bindItem(item));
    }

    static bindItem(item) {
        const wrapper = item.querySelector(SELECTOR_CONTENT);
        const content = wrapper?.querySelector(SELECTOR_INNER);
        const toggle = item.querySelector(SELECTOR_TOGGLE);

        if (!wrapper || !content || !toggle) {
            return;
        }

        // Meet of de content de collapsed-hoogte overschrijdt; zo niet, geen
        // toggle nodig. We meten op de inner content omdat de outer wrapper
        // de visuele max-height draagt.
        const collapsedHeight = wrapper.offsetHeight;
        const fullHeight = content.scrollHeight;

        if (fullHeight <= collapsedHeight + 4) {
            item.classList.add(NO_COLLAPSE_CLASS);
            toggle.hidden = true;
            return;
        }

        const toggleExpand = () => {
            const isExpanded = item.classList.contains(EXPANDED_CLASS);

            if (isExpanded) {
                wrapper.style.maxHeight = content.scrollHeight + 'px';
                // eslint-disable-next-line no-unused-expressions
                wrapper.offsetHeight;
                wrapper.style.maxHeight = '';
                item.classList.remove(EXPANDED_CLASS);
                toggle.setAttribute('aria-expanded', 'false');
            } else {
                wrapper.style.maxHeight = content.scrollHeight + 'px';
                item.classList.add(EXPANDED_CLASS);
                toggle.setAttribute('aria-expanded', 'true');
            }
        };

        toggle.addEventListener('click', (event) => {
            event.stopPropagation();
            toggleExpand();
        });
    }
}
