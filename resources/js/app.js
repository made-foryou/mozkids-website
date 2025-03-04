import './bootstrap';

import Sidebar from './modules/sidebar';
import HighlightText, { Highlight } from './modules/highlight-text';
import PhotoSlider from './modules/photo-slider';

import 'swiper/css';

window.addEventListener('load', () => {

    Sidebar.initialize();

    PhotoSlider.initialize();

    const highlights = [];

    const regex = /\[([a-zA-Z0-9\s]*)\]/;

    highlights.push(
        new Highlight('[', ']', 'text-primary', regex)
    );

    HighlightText.initialize(highlights);

});

window.Sidebar = Sidebar;
