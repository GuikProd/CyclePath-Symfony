import gql from 'graphql-tag';

export const ALL_PATHS = gql`
  query AllPaths {
    path {
      id
      startingDate
      endingDate
      distance
      duration
    }
  }
`;
