import { v4 as uuidv4 } from 'uuid';

export default class ButtonRadio {

    static instances = {};

    /**
     * 
     * @param {HTMLElement} element 
     */
    constructor(element) {

        /**
         * The HTML element that this object is bound to.
         * 
         * @type {HTMLElement}
         * @private
         */
        this._element = element;

        /**
         * The name of the radio button group.
         * 
         * @type {string}
         * @private
         */
        this._name = this._element.getAttribute('data-button-radio');

        /**
         * @type {NodeListOf<HTMLInputElement>}
         * @private
         */
        this._items = this._element.querySelectorAll('input[type="radio"][name="' + this._name + '"]');

        if (this._items.length === 0) {
            throw new Error('No radio buttons found insid the element.');
        }

        /**
         * The other input element that is shown when the "other" radio button is selected.
         * 
         * @type {HTMLElement}
         * @private
         */
        this._otherElement = this._element.closest('form').querySelector('[data-button-radio-other]');

        /**
         * Shows whether the "other" input is visible or not.
         * 
         * @type {boolean}
         * @private 
         */
        this._otherVisible = false;

        /**
         * The Identifier of the instance of this object.
         * 
         * @type {string}
         * @private
         */
        this._id = uuidv4();
        this._element.setAttribute('data-button-radio-instance', this._id);
        ButtonRadio.instances[this._id] = this;

        this.setup();
    }

    setup() {
        this._items.forEach(item => {
            item.addEventListener('change', (event) => {
                this.onRadioChange(event);
            });

            item.addEventListener('button-radio-change', (event) => {
                if (event.detail.checked) {
                    this.check(event.target);

                    if (event.detail.value === 'other') {
                        this.showOther();
                    }

                } else {
                    this.uncheck(event.target);

                    if (event.detail.value === 'other') {
                        this.hideOther();
                    }
                }
            });
        });
    }

    onRadioChange(event) {
        const target = event.target;
        const checked = target.checked;

        if (checked) {
            this._items.forEach(item => {
                if (item !== target) {
                    item.dispatchEvent(new CustomEvent('button-radio-change', {
                        detail: {
                            name: this._name,
                            value: item.value,
                            checked: false,
                        }
                    }));
                }
            });
        }

        target.dispatchEvent(new CustomEvent('button-radio-change', {
            detail: {
                name: this._name,
                value: target.value,
                checked: true,
            }
        }));
    }

    check(item) {
        const classList = item.closest('label').classList;

        classList.remove('ring-1', 'ring-secondary-500', 'bg-secondary-200', 'text-gray-900', 'hover:bg-secondary-400');
        classList.add('ring-0', 'bg-primary-500', 'text-white');
    }

    uncheck(item) {
        const classList = item.closest('label').classList;

        classList.remove('ring-0', 'bg-primary-500', 'text-white');
        classList.add('ring-1', 'ring-secondary-500', 'bg-secondary-200', 'text-gray-900', 'hover:bg-secondary-400');
    }

    showOther() {
        if (this._otherVisible) {
            return;
        }

        const input = this._otherElement.querySelector('input');

        if (input) {
            input.disabled = false;
        }

        this._otherElement.classList.replace('max-h-0', 'max-h-96');
        this._otherElement.classList.replace('scale-y-0', 'scale-y-100');
        this._otherElement.classList.replace('opacity-0', 'opacity-100');
        this._otherElement.classList.add('mt-8');
        this._otherElement.setAttribute('aria-hidden', 'false');
        this._otherVisible = true;
    }

    hideOther() {
        if (!this._otherVisible) {
            return;
        }

        const input = this._otherElement.querySelector('input');

        if (input) {
            input.disabled = true;
        }

        this._otherElement.classList.replace('max-h-96', 'max-h-0');
        this._otherElement.classList.replace('scale-y-100', 'scale-y-0');
        this._otherElement.classList.replace('opacity-100', 'opacity-0');
        this._otherElement.classList.remove('mt-8');
        this._otherElement.setAttribute('aria-hidden', 'true');
        this._otherVisible = false;

        window.setTimeout(() => {

        }, 300)
    }

    static initialize() {
        const elements = document.querySelectorAll('[data-button-radio]');

        elements.forEach(element => {
            new ButtonRadio(element);
        });
    }
}