import gql from 'graphql-tag'

export const ACTUAL_USER_BY_USERNAME = gql`
    query GetActualUserByUsername($username: String!) {
        user(username: $username) {
            id
            fistname
            lastname
            username
            email
            roles
        }
    }
`;
