import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import $ from 'jquery';
import dt from 'datatables.net-dt'; // inclut JS et CSS
window.$ = window.jQuery = $;
dt(window, $);
