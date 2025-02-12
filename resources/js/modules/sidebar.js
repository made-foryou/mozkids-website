import { v4 as uuidv4 } from 'uuid'

const Selectors = {
    Elements: '.made-sidebar',
    Backdrop: '[data-backdrop]',
    Menu: '[data-menu]',
    CloseButton: '[data-close-button]',
    Closer: '[data-closer]',
    Opener: '[data-opener]',
    Outside: {
        Opener: '[data-made-sidebar-opener]',
        Closer: '[data-made-sidebar-closer]',
    }
};

const Data = {
    Identifier: 'data-made-sidebar',
}

const Classes = {
    Hide: 'hidden',
    Block: 'block',
    Flex: 'flex',
    Opacity0: 'opacity-0',
    Opacity100: 'opacity-100',
    MinusTranslateXFull: '-translate-x-full',
    TranslateX0: 'translate-x-0',
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
        Sidebar.instances[this._identifier] = this;

        /**
         * @var {HTMLElement} _backdrop
         * @private
         */
        this._backdrop = this._element.querySelector(Selectors.Backdrop);

        /**
         * @var {HTMLElement} _menu
         * @private
         */
        this._menu = this._element.querySelector(Selectors.Menu);

        /**
         * @var {HTMLElement} _closeButton
         * @private
         */
        this._closeButton = this._element.querySelector(Selectors.CloseButton);

        /**
         * @var {NodeList} _closers
         * @private
         */
        this._closers = this._element.querySelectorAll(Selectors.Closer);

        /**
         * @var {NodeList} _closers
         * @private
         */
        this._openers = this._element.querySelectorAll(Selectors.Opener);

        /**
         * @var {NodeList} _closers
         * @private
         */
        this._outsideClosers = document.querySelectorAll(Selectors.Outside.Closer);

        /**
         * @var {NodeList} _closers
         * @private
         */
        this._outsideOpeners = document.querySelectorAll(Selectors.Outside.Opener);

        /**
         * @var {Object} _state
         */
        this._state = {
            Open: false,
            Animating: false,
        };


        // Starting the component
        this.init();
    }

    init() {
        this._closers.forEach(closer => {
            closer.addEventListener('click', () => {
                this.close();
            });
        });

        this._outsideClosers.forEach(closer => {
            closer.addEventListener('click', () => {
                this.close();
            });
        });

        this._openers.forEach(opener => {
            opener.addEventListener('click', () => {
                this.open();
            });
        });

        this._outsideOpeners.forEach(opener => {
            opener.addEventListener('click', () => {
                this.open();
            });
        });
    }

    open() {
        if (this.isOpen()) {
            return;
        }

        if (this.isAnimating()) {
            return;
        }

        this.startAnimating();

        this._element.classList.replace(Classes.Hide, Classes.Block);
        this._backdrop.classList.replace(Classes.Hide, Classes.Block);
        this._menu.classList.replace(Classes.Hide, Classes.Flex);
        this._closeButton.classList.replace(Classes.Hide, Classes.Flex);
        
        window.setTimeout(() => {
            this._backdrop.classList.replace(Classes.Opacity0, Classes.Opacity100);
            this._menu.classList.replace(Classes.MinusTranslateXFull, Classes.TranslateX0);
            this._closeButton.classList.replace(Classes.Opacity0, Classes.Opacity100);

            window.setTimeout(() => {
                this._state.Open = true;

                this.stopAnimating();
            }, 300);
        }, 100);
    }

    close() {
        if (this.isClosed()) {
            return;
        }

        if (this.isAnimating()) {
            return;
        }

        this.startAnimating();

        this._backdrop.classList.replace(Classes.Opacity100, Classes.Opacity0);
        this._menu.classList.replace(Classes.TranslateX0, Classes.MinusTranslateXFull);
        this._closeButton.classList.replace(Classes.Opacity100, Classes.Opacity0);

        window.setTimeout(() => {
            this._element.classList.replace(Classes.Block, Classes.Hide);
            this._backdrop.classList.replace(Classes.Block, Classes.Hide);
            this._menu.classList.replace(Classes.Flex, Classes.Hide);
            this._closeButton.classList.replace(Classes.Flex, Classes.Hide);

            window.setTimeout(() => {
                this._state.Open = false;

                this.stopAnimating();
            }, 100);

        }, 300);
    }

    isOpen() {
        return true === this._state.Open;
    }

    isClosed() {
        return false === this._state.Open;
    }

    isAnimating() {
        return this._state.Animating;
    }

    startAnimating() {
        this._state.Animating = true;
    }

    stopAnimating() {
        this._state.Animating = false;
    }

    static initialize() {
        const elements = document.querySelectorAll(Selectors.Elements);

        if (elements.length > 0) {
            for (let i = 0; i < elements.length; i++) {
                new Sidebar(elements[i]);
            }
        }
    }

    static getInstance(element) {
        if (! element.hasAttribute(Data.Identifier)) {
            return null;
        }

        return Sidebar.instances[element.getAttribute(Data.Identifier)];
    }
}