import { ApolloClient } from 'apollo-client';
import { HttpLink } from 'apollo-link-http';

export interface GraphQLClientInterface {
    /**
     * @returns {HttpLink}
     */
    getHTTPLink(): HttpLink;

    /**
     * @returns {ApolloClient}
     */
    getClient(): ApolloClient;
}
