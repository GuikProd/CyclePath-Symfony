import React, { Component } from 'react';
import { graphql } from 'react-apollo'
import gql from 'graphql-tag';

class RegisterCheck extends Component {

    constructor(props) {
        super(props);

        this.state = {
            inputValue: props.inputValue
        }
    }

    render () {
        return (
            <div>
                <p>The value { this.state.inputValue } already exist !</p>
            </div>
        );
    }
}

const INPUT_VALUE_CHECK = gql`
    query InputValueCheck {
        user {
            id
            username
            email
        }
    }
`;

export default graphql(INPUT_VALUE_CHECK, { name: 'inputValueCheck' }) (RegisterCheck)
