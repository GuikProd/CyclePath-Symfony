import gql from 'graphql-tag'

export const USER_BY_EMAIL = gql`
    query GetUserByUsername($email: String!) {
        user(email: $email) {
            username
            email
        }
    }
`;
