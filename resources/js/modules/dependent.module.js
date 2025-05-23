import { animate } from "animejs";

export default class Dependent {
    /**
     *
     * @param {HTMLElement} element
     */
    constructor(element) {
        /**
         * @type {HTMLElement}
         * @private
         */
        this._element = element;

        /**
         * @type {string}
         */
        this._inputName = this._element.getAttribute("data-made-dependent");

        /**
         * @type {array<string>}
         */
        this._values = this._element
            .getAttribute("data-made-dependent-values")
            .split(",");

        /**
         * @type {NodeList<HTMLElement>}
         */
        this._inputs = this._element
            .closest("form")
            .querySelectorAll(
                '[name="' +
                    this._element.getAttribute("data-made-dependent") +
                    '"]',
            );

        this._inputs.forEach((input) => {
            input.addEventListener("change", (e) => {
                const data = new FormData(e.target.closest("form"));
                const value = data.get(this._inputName);

                if (this._values.indexOf(value) >= 0) {
                    this.show();
                } else {
                    this.hide();
                }
            });
        });
    }

    show() {
        animate(this._element, {
            height: "100%",
            opacity: 1,
            display: "flex",
            duration: 245,
        });
    }

    hide() {
        animate(this._element, {
            height: 0,
            opacity: 0,
            duration: 245,
            onComplete: (self) => (self.targets[0].style.display = "none"),
        });
    }
}
