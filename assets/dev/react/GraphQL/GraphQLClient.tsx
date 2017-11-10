import { ApolloClient } from 'apollo-client';
import { HttpLink } from 'apollo-link-http';
import { InMemoryCache } from 'apollo-cache-inmemory';
import { GraphQLClientInterface } from './Interfaces/GraphQLClientInterface';

export class GraphQLClient implements GraphQLClientInterface
{
    private apiEntryPoint: string;

    /**
     * @param {string} apiEntryPoint
     */
    constructor(apiEntryPoint: string) {
        this.apiEntryPoint = apiEntryPoint;
    }

    /**
     * @returns {HttpLink}
     */
    getHTTPLink() : HttpLink {
        return new HttpLink({ uri: this.apiEntryPoint })
    }

    /**
     * @returns {ApolloClient}
     */
    getClient() : ApolloClient {
        return new ApolloClient({
            link: this.getHTTPLink(),
            cache: new InMemoryCache()
        })
    }
}
