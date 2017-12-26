import gql from 'graphql-tag'

export const ALL_PATHS = gql`
    query allPaths {
        path {
            id
            startingDate
            endingDate
            duration
            distance
        }
    }
`;
