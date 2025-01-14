import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
// import * as bootstrap from 'bootstrap';
window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();


import Vue from 'vue';
window.Vue = Vue;
import MainApp from './components/MainApp.vue';
Vue.component('mainapp', MainApp);

// window.Vue = require('vue').default;
// window.Vue.prototype.$eventBus = new Vue();
// //graficos componentes padres
// Vue.component('mainapp', require('./components/MainApp.vue').default);

const app = new Vue({
    el:'#app'
});
