
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueQrcodeReader from 'vue-qrcode-reader';
import VueQrcode from '@xkeshi/vue-qrcode';

Vue.use(VueQrcodeReader);
Vue.component(VueQrcode.name, VueQrcode);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('notices-carousel', require('./components/NoticesCarousel.vue'));
Vue.component('notices-carousel-editor', require('./components/NoticesCarouselEditor.vue'));
Vue.component('events-component', require('./components/EventsComponent.vue'));
Vue.component('admin-events', require('./components/AdminEventsComponent.vue'));
Vue.component('notices-component', require('./components/NoticesComponent.vue'));
Vue.component('admin-notices', require('./components/AdminNoticesComponent.vue'));
Vue.component('create-tournament', require('./components/CreateTournamentComponent.vue'));
Vue.component('date-format', require('./components/DateFormatComponent.vue'));
Vue.component('complete-signup', require('./components/CompleteSignUp.vue'));


const app = new Vue({
    el: '#app'
});