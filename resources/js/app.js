
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'

import VueQrcodeReader from 'vue-qrcode-reader';
import VueQrcode from '@xkeshi/vue-qrcode';

Vue.use(VueQrcodeReader);
Vue.component(VueQrcode.name, VueQrcode);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('notices-carousel', require('./components/NoticesCarousel.vue').default);
Vue.component('notices-carousel-editor', require('./components/NoticesCarouselEditor.vue').default);
Vue.component('events-component', require('./components/EventsComponent.vue').default);
Vue.component('admin-events', require('./components/AdminEventsComponent.vue').default);
Vue.component('notices-component', require('./components/NoticesComponent.vue').default);
Vue.component('admin-notices', require('./components/AdminNoticesComponent.vue').default);
Vue.component('date-format', require('./components/DateFormatComponent.vue').default);
Vue.component('create-tournament', require('./components/CreateTournamentComponent.vue').default);
Vue.component('edit-tournament', require('./components/EditTournamentComponent.vue').default);
Vue.component('complete-signup', require('./components/CompleteSignUp.vue').default);
Vue.component('profile-avatar-input', require('./components/ProfileAvatarInput.vue').default);
Vue.component('tournament-historic', require('./components/TournamentHistoric.vue').default);
Vue.component('team-index', require('./components/TeamIndexComponent.vue').default);

const app = new Vue({
    el: '#app'
});
