import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import { v4 as uuidv4 } from 'uuid';

const Selector = {
    PhotoSlider: '.made-photo-slider',
    NextElement: '.swiper-button-next',
    PreviousElement: '.swiper-button-prev',
};

const Data = {
    Identifier: 'data-made-photo-slider',
};

export default class PhotoSlider {

    static instances = {};

    constructor(element) {

        this._element = element;

        /**
         * @var {string} _identifier
         * @private
         */
        this._identifier = uuidv4();

        this._element.setAttribute(Data.Identifier, this._identifier);
        PhotoSlider.instances[this._identifier] = this;

        this._instance = new Swiper(this._element, {

            slidesPerView: 'auto',

            spaceBetween: 19,

            loop: true,
            lazyPreloadPrevNext: 1,

            breakpoints: {
                768: {
                    spaceBetween: 22,
                }
            },

            navigation: {
                nextEl: this._element.querySelector(Selector.NextElement),
                prevEl: this._element.querySelector(Selector.PreviousElement),
                disabledClass: 'opacity-0',
            },

            modules: [
                Navigation,
            ],
        });
    }

    static initialize() {
        const sliders = document.querySelectorAll(Selector.PhotoSlider);

        if (sliders.length > 0) {

            for (let i = 0; i < sliders.length; i++) {
                new PhotoSlider(sliders[i]);
            }

        }
    }
}