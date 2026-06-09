import './bootstrap';

import Sidebar from './modules/sidebar';
import Navigation from './modules/navigation';
import Reveal from './modules/reveal';
import HighlightText, { Highlight } from './modules/highlight-text';
import PhotoSlider from './modules/photo-slider';
import MailchimpForm from './modules/mailchim-form';
import ButtonRadio from './modules/button-radio';
import DonationForm from './modules/donation-form';
import MadeForm from './modules/form';

import 'swiper/css';

function init() {
    Sidebar.initialize();
    Navigation.initialize();
    Reveal.initialize();
    PhotoSlider.initialize();
    MailchimpForm.initialize();
    ButtonRadio.initialize();

    const highlights = [];
    const regex = /\[([a-zA-Z0-9\s]*)\]/;

    highlights.push(
        new Highlight('[', ']', 'text-primary-500', regex)
    );

    HighlightText.initialize(highlights);

    const donationForm = document.querySelector('[data-made-donation-form]');

    if (donationForm) {
        new DonationForm(donationForm);
    }

    document.querySelectorAll('[data-made-form]').forEach(form => {
        new MadeForm(form);
    });
}

if (document.readyState !== 'loading') {
    init();
} else {
    window.addEventListener('DOMContentLoaded', init);
}

window.Sidebar = Sidebar;
