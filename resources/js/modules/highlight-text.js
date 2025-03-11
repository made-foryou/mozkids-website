export class Highlight {
    constructor(
        startingCharacter,
        endingCharacter,
        classes,
        regex,
    ) {
        this.start = startingCharacter;
        this.end = endingCharacter;
        this.classes = classes;
        this.regex = regex;
    }
}

export default class HighlightText {

    /**
     * @var {HTMLElement} element
     * @var {Array<int, Highlight>} highlights
     */
    constructor(element, highlights = []) {
        /**
         * @type {string}
         * @private
         */
        this._element = element;

        /**
         * @type {Array<int, Highlight>}
         * @private
         */
        this._highlights = highlights;

        this.init();
    }

    init() {
        if (this._highlights.length === 0) {
            return;
        }

        let content = this._element.innerHTML;

        for (const highlight of this._highlights) {

            let matches;

            while (content.match(highlight.regex) !== null) {

                matches = content.match(highlight.regex);

                content = content.replace(
                    matches[0],
                    '<span class="' + highlight.classes + '">'
                    + matches[0].replace(highlight.start, '').replace(highlight.end, '')
                    + '</span>',
                );

            }
        }

        this._element.innerHTML = content;
    }

    static initialize(highlights = []) {
        const elements = document.querySelectorAll('[data-highlightable]');

        if (elements.length > 0) {
            for (let i = 0; i < elements.length; i++) {
                new HighlightText(elements[i], highlights);
            }
        }
    }
}
