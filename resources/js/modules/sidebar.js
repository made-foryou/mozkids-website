import { v4 as uuidv4 } from 'uuid'

const Selectors = {
    Elements: '.made-sidebar',
};

const Data = {
    Identifier: 'data-made-sidebar',
}

export default class Sidebar {
    /**
     * @type {Object<string, Sidebar>}
     */
    static instances = {};

    /**
     * @param {HTMLElement} element 
     */
    constructor(element) {
        /**
         * @var {HTMLElement} _element
         * @private
         */
        this._element = element;

        /**
         * @var {string} _identifier
         * @private
         */
        this._identifier = uuidv4();

        this._element.setAttribute(Data.Identifier, this._identifier);
    }

    static initialize() {
        const elements = document.querySelectorAll(Selectors.Elements);

        if (elements.length > 0) {
            for (let i = 0; i < elements.length; i++) {
                new Sidebar(elements[i]);
            }
        }
    }
}