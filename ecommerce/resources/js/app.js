require('./bootstrap');
import Vue from 'vue';
import MainApp from './components/MainApp.vue';

import VueRouter from 'vue-router';
import {routes} from "./routes";
Vue.use(VueRouter);
const router = new VueRouter({
    routes,
    mode: 'history'
});


import Vuex from 'vuex';
import StoreData from './store';
Vue.use(Vuex);
const store = new Vuex.Store(StoreData);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
