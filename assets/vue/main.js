import Vue from 'vue'
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import VueApollo from 'vue-apollo';

import Hello from './components/Hello.vue'

Vue.use(Vuex);
Vue.use(VueApollo);
Vue.use(VueRouter);

new Vue({
    el: '#app',
    render: h => h(Hello)
});
