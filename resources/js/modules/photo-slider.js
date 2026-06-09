import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import { v4 as uuidv4 } from 'uuid';

const Selector = {
    PhotoSlider: '.made-photo-slider',
    Section: '.photo-slider-section',
    NextElement: '.swiper-button-next',
    PreviousElement: '.swiper-button-prev',
    CounterCurrent: '.photo-counter__current',
    CounterTotal: '.photo-counter__total',
    CounterFill: '.photo-counter__bar-fill',
};

const Data = {
    Identifier: 'data-made-photo-slider',
};

export default class PhotoSlider {

    static instances = {};

    constructor(element) {

        this._element = element;
        this._section = element.closest(Selector.Section) ?? element.parentElement;

        this._identifier = uuidv4();

        this._element.setAttribute(Data.Identifier, this._identifier);
        PhotoSlider.instances[this._identifier] = this;

        this._originalSlideCount = this._element.querySelectorAll('.swiper-slide:not(.swiper-slide-duplicate)').length;

        const next = this._section?.querySelector(Selector.NextElement)
            ?? this._element.querySelector(Selector.NextElement);
        const prev = this._section?.querySelector(Selector.PreviousElement)
            ?? this._element.querySelector(Selector.PreviousElement);

        // Loop heeft genoeg slides nodig om duplicates te maken; met
        // slidesPerView: 'auto' + centeredSlides werkt loop pas vanaf 3 slides
        // betrouwbaar — onder dat aantal vallen we terug op een lineaire slider.
        const enableLoop = this._originalSlideCount >= 3;

        this._instance = new Swiper(this._element, {

            slidesPerView: 'auto',
            centeredSlides: true,
            spaceBetween: 19,

            loop: enableLoop,
            loopAdditionalSlides: enableLoop ? 1 : 0,
            lazyPreloadPrevNext: 1,
            speed: 600,
            watchOverflow: true,

            breakpoints: {
                768: {
                    spaceBetween: 28,
                }
            },

            navigation: {
                nextEl: next,
                prevEl: prev,
                disabledClass: 'photo-nav__btn--disabled',
                lockClass: 'photo-nav__btn--locked',
            },

            modules: [
                Navigation,
            ],
        });

        this.bindCounter();
    }

    bindCounter() {
        const current = this._section?.querySelector(Selector.CounterCurrent);
        const total = this._section?.querySelector(Selector.CounterTotal);
        const fill = this._section?.querySelector(Selector.CounterFill);

        if (!current && !fill) {
            return;
        }

        const totalCount = this._originalSlideCount || 1;

        if (total) {
            total.textContent = String(totalCount).padStart(2, '0');
        }

        const update = () => {
            const index = (this._instance.realIndex ?? 0) + 1;

            if (current) {
                current.textContent = String(index).padStart(2, '0');
            }

            if (fill) {
                fill.style.width = `${(index / totalCount) * 100}%`;
            }
        };

        update();
        this._instance.on('slideChange', update);
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
