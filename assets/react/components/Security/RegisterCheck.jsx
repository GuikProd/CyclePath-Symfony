import React, { Component } from 'react';
import gql from "graphql-tag";
import { withApollo } from "react-apollo/index";

class RegisterCheck extends Component
{
    constructor(props) {
        super(props);

        this.state = {
            check: false,
            violation: false,
            inputKey: "",
            value: props.value,
            visible: false
        };
    }

    componentDidMount() {
        this.triggerCheck(true);
        this.checkUserInput(this.props.inputKey, this.props.value);
    }

    componentWillReceiveProps(nextProps) {
        this.triggerCheck(true);
        this.checkUserInput(nextProps.inputKey, nextProps.value);
    }

    triggerCheck(check) {
        this.setState({
            check: check
        });
    }

    triggerViolation(violation) {
        this.setState({
            violation: violation
        });

        this.displayViolation(true);
    }

    displayViolation(visibility) {
        this.setState({
            visible: visibility
        });
    }

    checkUserInput(inputKey, inputValue) {
        switch (inputKey) {
            case 'register_username':
                this.props.client.query({
                    query: gql`
                        query checkUserInput($username: String) {
                            user(username: $username) {
                                username
                                email
                            }
                        }`,
                    variables: {
                        username: inputValue
                    }
                }).then(response => {
                    console.log(response.data.user);

                    switch (response.data.user) {
                        case response.data.user.length > 0 && response.data.user == null:
                            this.triggerViolation(false);
                            break;
                        case response.data.user.length > 0 && response.data.user != null:
                            if (response.data.user[0].username === inputValue) {
                                console.log(response.data.user[0].username);
                                this.triggerViolation(true);
                            }
                            break;
                        default:
                            this.triggerViolation(false);
                            break;
                    }
                });
                break;
            case 'register_email':
                this.props.client.query({
                    query: gql`
                        query checkUserInput($email: String) {
                            user(email: $email) {
                                username
                                email
                            }
                        }`,
                    variables: {
                        email: inputValue
                    }
                }).then(response => {
                    if (response.data.user.length > 0 && response.data.user[0].email === inputValue) {
                        this.triggerViolation(true);
                    }
                });
                break;
            default:
                this.displayViolation(false);
                break;
        }
    }

    render () {
        if (this.state.visible) {
            return (
                <div>
                    <p>The value { this.state.value } already exist !</p>
                </div>
            );
        } else {
            return null;
        }
    }
}

export default withApollo(RegisterCheck)
