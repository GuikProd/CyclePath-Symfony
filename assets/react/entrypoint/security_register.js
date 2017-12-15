import React from "react";
import ReactDOM from "react-dom";

import { HttpLink } from 'apollo-link-http'
import { ApolloClient } from 'apollo-client'
import { ApolloProvider } from 'react-apollo'
import { InMemoryCache } from 'apollo-cache-inmemory'

import { RegisterForm } from "../components/Security/RegisterForm";

const client = new ApolloClient({
    link: new HttpLink({
        uri: 'http://localhost:8080/api/'
    }),
    cache: new InMemoryCache()
});

ReactDOM.render(
    <ApolloProvider client={client}>
        <RegisterForm />
    </ApolloProvider>,
    document.getElementById('registerForm')
);
