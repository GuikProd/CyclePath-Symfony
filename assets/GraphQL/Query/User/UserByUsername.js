import gql from 'graphql-tag'

export const USER_BY_USERNAME = gql`
    query GetUserByUsername($username: String!) {
        user(username: $username) {
            username
            email
        }
    }
`;
