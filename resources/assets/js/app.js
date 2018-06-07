/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Scrollspy from 'vue2-scrollspy';

Vue.use(Scrollspy);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app', require('./pages/App.vue'));

const app = new Vue({
    el: '#app'
});

window.onscroll = function () {
    sticky()
};
let navbar = document.getElementById('sticky');
let offset = navbar.offsetTop;

function sticky() {
    if (window.pageYOffset > offset) {
        navbar.classList.add('sticky');
    } else {
        navbar.classList.remove('sticky');
    }
}
