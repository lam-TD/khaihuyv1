require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import Element from 'element-ui';
import VueNumeric from 'vue-numeric';
import VeeValidate from 'vee-validate';

import 'nprogress/nprogress.css';
import 'element-ui/lib/theme-chalk/index.css';

Vue.config.productionTip = false;

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Element);
Vue.use(VueNumeric);
Vue.use(VeeValidate);

import StoreData from './store';
import {routes} from "./routes";
import {initialize} from './helper/general';

const store = new Vuex.Store(StoreData);
const router = new VueRouter({routes});



initialize(store, router);

import MainApp from './components/Main';

const app = new Vue({
    el: '#app',
    router,
    store,
    components: { MainApp }
});
