import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import { v4 as uuidv4 } from 'uuid';

const Selector = {
    Slider: '.made-team-slider',
    Section: '.board-members-strip',
    NextElement: '.team-slider__next',
    PreviousElement: '.team-slider__prev',
    CounterCurrent: '.team-slider__counter-current',
    CounterTotal: '.team-slider__counter-total',
    CounterFill: '.team-slider__counter-fill',
};

const Data = {
    Identifier: 'data-made-team-slider',
};

// Media query: Swiper alleen actief onder lg (mobile + portrait tablets).
const SLIDER_MEDIA_QUERY = '(max-width: 1023.98px)';

export default class TeamSlider {

    static instances = {};

    constructor(element) {
        this._element = element;
        this._section = element.closest(Selector.Section) ?? element.parentElement;

        this._identifier = uuidv4();
        this._element.setAttribute(Data.Identifier, this._identifier);
        TeamSlider.instances[this._identifier] = this;

        this._originalSlideCount = this._element
            .querySelectorAll('.swiper-slide:not(.swiper-slide-duplicate)').length;

        // Reageer op breakpoint-veranderingen (bv. tablet draait van portrait
        // naar landscape) zodat we Swiper netjes wisselen tussen actief en
        // uitgeschakeld zonder een page reload.
        this._mediaQuery = window.matchMedia(SLIDER_MEDIA_QUERY);
        this._mediaQuery.addEventListener('change', () => this.evaluate());

        this._instance = null;

        this.evaluate();
    }

    evaluate() {
        if (this._mediaQuery.matches) {
            this.initSwiper();
        } else {
            this.destroySwiper();
        }
    }

    initSwiper() {
        if (this._instance) {
            return;
        }

        const next = this._section?.querySelector(Selector.NextElement)
            ?? this._element.querySelector(Selector.NextElement);
        const prev = this._section?.querySelector(Selector.PreviousElement)
            ?? this._element.querySelector(Selector.PreviousElement);

        this._instance = new Swiper(this._element, {
            slidesPerView: 1.1,
            spaceBetween: 18,
            loop: false,
            speed: 500,
            watchOverflow: true,

            breakpoints: {
                640: {
                    slidesPerView: 1.8,
                    spaceBetween: 22,
                },
                768: {
                    slidesPerView: 2.4,
                    spaceBetween: 24,
                },
            },

            navigation: {
                nextEl: next,
                prevEl: prev,
                disabledClass: 'team-slider__btn--disabled',
                lockClass: 'team-slider__btn--locked',
            },

            modules: [Navigation],
        });

        this.bindCounter();
    }

    destroySwiper() {
        if (!this._instance) {
            return;
        }

        // Tweede argument `cleanStyles: true` zorgt dat alle door Swiper
        // toegevoegde inline styles (transform, width, transition) verdwijnen,
        // zodat de CSS-grid fallback netjes overneemt op lg+.
        this._instance.destroy(true, true);
        this._instance = null;
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
            if (!this._instance) {
                return;
            }

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
        const sliders = document.querySelectorAll(Selector.Slider);

        if (sliders.length === 0) {
            return;
        }

        sliders.forEach((slider) => new TeamSlider(slider));
    }
}
