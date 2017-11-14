import Vue from 'vue'
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import VueApollo from 'vue-apollo'

import { ApolloClient } from 'apollo-client'
import { HttpLink } from 'apollo-link-http';
import { InMemoryCache } from 'apollo-cache-inmemory'

import Main from './components/Main.vue'

const apolloClient = new ApolloClient({
    link: new HttpLink({
        uri: 'http://localhost:8080/api/',
    }),
    cache: new InMemoryCache(),
    connectToDevTools: true,
});

const apolloProvider = new VueApollo({
    defaultClient: apolloClient,
});

Vue.use(Vuex);
Vue.use(VueApollo);
Vue.use(VueRouter);

new Vue({
    el: '#app',
    apolloProvider,
    render: h => h(Main)
});
