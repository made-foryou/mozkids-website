import { v4 as uuidv4 } from 'uuid';

export default class ButtonRadio {

    static instances = {};

    /**
     * @param {HTMLElement} element
     */
    constructor(element) {
        this._element = element;
        this._name = this._element.getAttribute('data-button-radio');
        this._items = this._element.querySelectorAll('input[type="radio"][name="' + this._name + '"]');

        if (this._items.length === 0) {
            throw new Error('No radio buttons found inside the element.');
        }

        const form = this._element.closest('form');
        this._otherElement = form ? form.querySelector('[data-button-radio-other]') : null;
        this._otherVisible = false;

        this._id = uuidv4();
        this._element.setAttribute('data-button-radio-instance', this._id);
        ButtonRadio.instances[this._id] = this;

        this.setup();
    }

    setup() {
        this._items.forEach((item) => {
            item.addEventListener('change', () => {
                if (!item.checked) {
                    return;
                }

                if (item.value === 'other') {
                    this.showOther();
                } else {
                    this.hideOther();
                }
            });

            // Initialiseer met de juiste "other"-state als de checked-radio reeds
            // bestaat (bv. via @if checked in de blade).
            if (item.checked && item.value === 'other') {
                this.showOther();
            }
        });
    }

    showOther() {
        if (!this._otherElement || this._otherVisible) {
            return;
        }

        const input = this._otherElement.querySelector('input');
        if (input) {
            input.disabled = false;
        }

        this._otherElement.classList.remove('max-h-0', 'opacity-0', 'scale-y-0');
        this._otherElement.classList.add('max-h-96', 'opacity-100', 'scale-y-100', 'mt-2');
        this._otherElement.setAttribute('aria-hidden', 'false');
        this._otherVisible = true;
    }

    hideOther() {
        if (!this._otherElement || !this._otherVisible) {
            return;
        }

        const input = this._otherElement.querySelector('input');
        if (input) {
            input.disabled = true;
        }

        this._otherElement.classList.remove('max-h-96', 'opacity-100', 'scale-y-100', 'mt-2');
        this._otherElement.classList.add('max-h-0', 'opacity-0', 'scale-y-0');
        this._otherElement.setAttribute('aria-hidden', 'true');
        this._otherVisible = false;
    }

    static initialize() {
        const elements = document.querySelectorAll('[data-button-radio]');
        elements.forEach((element) => new ButtonRadio(element));
    }
}
