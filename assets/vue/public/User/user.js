import Vue from "vue";
import VueApollo from 'vue-apollo'
import { ApolloClient } from 'apollo-client'
import { HttpLink } from 'apollo-link-http';
import { InMemoryCache } from 'apollo-cache-inmemory';

import User from "../../components/User/User";

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

Vue.use(VueApollo);

new Vue({
    el: "#user",
    apolloProvider,
    render: h => h(User)
});
