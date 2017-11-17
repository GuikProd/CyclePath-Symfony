import React, { Component } from 'react';

import gql from 'graphql-tag'
import { graphql } from 'react-apollo'

import { Path } from "./Path";

class PathsLists extends Component {

    constructor(props) {
        super(props);
    }

    render () {
        if (this.props.allPathsQuery && this.props.allPathsQuery.loading) {
            return <div>Loading</div>
        }

        // 2
        if (this.props.allPathsQuery && this.props.allPathsQuery.error) {
            return <div>Error</div>
        }

        const pathsToRender = this.props.allPathsQuery.path;

        return (
            <div>
                <ul>
                    { pathsToRender.map(path => (
                        <li>
                            <Path key={path.id} path={path}/>
                        </li>
                    ))}
                </ul>
            </div>
        );
    }
}

const ALL_PATHS_QUERY = gql`
  query AllPaths {
    path {
      id
      startingDate
      endingDate
      duration
      distance
    }
  }
`;

export default graphql(ALL_PATHS_QUERY, { name: 'allPathsQuery' }) (PathsLists)
