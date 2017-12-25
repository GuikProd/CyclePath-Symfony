import * as React from "react";
import * as ReactDOM from "react-dom";

import { HttpLink } from 'apollo-link-http'
import { ApolloClient } from 'apollo-client'
import { ApolloProvider } from 'react-apollo'
import { InMemoryCache } from 'apollo-cache-inmemory'


import { User } from "./../../components/User/User";

const client = new ApolloClient({
    link: new HttpLink({
        uri: 'http://localhost:8080/api/'
    }),
    cache: new InMemoryCache()
});

ReactDOM.render(
    <ApolloProvider client={client}>
        <User username={"Guillaume"} email={"guillaume.loulier@gmail.com"} />
    </ApolloProvider>,
    document.getElementById('user')
);
