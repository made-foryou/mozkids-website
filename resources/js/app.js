import './bootstrap';

import Sidebar from './modules/sidebar';
import HighlightText, { Highlight } from './modules/highlight-text';

window.addEventListener('load', () => {

    Sidebar.initialize();

    const highlights = [];

    const regex = /\[([a-zA-Z0-9\s]*)\]/;

    highlights.push(
        new Highlight('[', ']', 'text-primary', regex)
    );



    HighlightText.initialize(highlights);

});

window.Sidebar = Sidebar;
