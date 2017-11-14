import * as React from "react";
import * as ReactDOM from "react-dom";

import { HttpLink } from 'apollo-link-http';
import { ApolloClient } from 'apollo-client';
import { InMemoryCache } from 'apollo-cache-inmemory';
import ApolloProvider from 'react-apollo/ApolloProvider';

import { HomeComponent } from './components/HomeComponent';
import { Configuration } from './Configuration/Configuration';

let configuration = new Configuration('http://127.0.0.1:8080/api');

const client = new ApolloClient({
    link: new HttpLink({ uri: configuration.getApiEntryPoint() }),
    cache: new InMemoryCache()
});

ReactDOM.render(
    <ApolloProvider client={client}>
        <HomeComponent text="Hello World from react !"/>
    </ApolloProvider>,
    document.getElementById("react")
);
