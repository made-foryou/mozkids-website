import "./bootstrap";

import Sidebar from "./modules/sidebar";
import HighlightText, { Highlight } from "./modules/highlight-text";
import PhotoSlider from "./modules/photo-slider";
import MailchimpForm from "./modules/mailchim-form";
import ButtonRadio from "./modules/button-radio";
import DonationForm from "./modules/donation-form";
import MadeForm from "./modules/form";

import "swiper/css";
import Dependent from "./modules/dependent.module";

window.addEventListener("load", () => {
    Sidebar.initialize();

    PhotoSlider.initialize();

    MailchimpForm.initialize();

    ButtonRadio.initialize();

    const highlights = [];

    const regex = /\[([a-zA-Z0-9\s]*)\]/;

    highlights.push(new Highlight("[", "]", "text-primary-500", regex));

    HighlightText.initialize(highlights);
});

window.addEventListener("DOMContentLoaded", () => {
    const donationForm = document.querySelector("[data-made-donation-form]");

    if (donationForm) {
        new DonationForm(donationForm);
    }
});

window.addEventListener("DOMContentLoaded", () => {
    const contactForm = document.querySelectorAll("[data-made-form]");

    if (contactForm.length > 0) {
        contactForm.forEach((form) => {
            new MadeForm(form);
        });
    }
});

window.addEventListener("DOMContentLoaded", () => {
    const dependentElements = document.querySelectorAll(
        "[data-made-dependent]",
    );

    if (dependentElements.length > 0) {
        dependentElements.forEach((element) => {
            new Dependent(element);
        });
    }
});

window.Sidebar = Sidebar;
