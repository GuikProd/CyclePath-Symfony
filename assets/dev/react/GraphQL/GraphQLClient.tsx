import { ApolloClient } from 'apollo-client';
import { HttpLink } from 'apollo-link-http';
import { InMemoryCache } from 'apollo-cache-inmemory';

const client = new ApolloClient({
    link: new HttpLink({ uri: 'https://127.0.0.1:8080/api' }),
    cache: new InMemoryCache()
});
