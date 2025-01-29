import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
// import * as bootstrap from 'bootstrap';
window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();


import Vue from 'vue';
window.Vue = Vue;
import dashboard from './components/dashboard-home.vue';
import amchartbarra from './components/amcharts/bar.vue';
import amchartlinea from './components/amcharts/line.vue';
import amchartpie from './components/amcharts/pie.vue';

Vue.component('dashboard', dashboard);
Vue.component('amchart-barra', amchartbarra);
Vue.component('amchart-linea', amchartlinea);
Vue.component('amchart-torta',amchartpie);


// window.Vue = require('vue').default;
// window.Vue.prototype.$eventBus = new Vue();
// //graficos componentes padres
// Vue.component('mainapp', require('./components/MainApp.vue').default);

const app = new Vue({
    el:'#app'
});
