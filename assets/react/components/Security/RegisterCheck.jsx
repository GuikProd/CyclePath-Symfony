import React, { Component } from 'react';

import { graphql } from "react-apollo/index";
import gql from "graphql-tag";

class RegisterCheck extends Component
{
    constructor(props) {
        super(props);

        this.state = {
            violation: false,
            value: this.props.inputValue
        };

        this.checkForViolation(this.state.value);
    }

    checkForViolation(entry) {
        console.log(entry);
    }

    render () {

        const inputValues = this.props.inputValueCheck.user;

        console.log(inputValues);

        if (this.state.visible) {
            return (
                <div>
                    <p>The value { this.state.value } already exist !</p>
                </div>
            );
        } else {
            return (
                <div>
                </div>
            );
        }
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
