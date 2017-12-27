import React, { Component } from 'react';
import { withApollo } from "react-apollo/index";
import { USER_BY_USERNAME } from "../../../../GraphQL/Query/User/UserByUsername";
import { USER_BY_EMAIL } from "../../../../GraphQL/Query/User/UserByEmail";

class RegisterCheck extends Component {

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
        this.triggerViolation(false);
        this.displayViolation(false);
        this.checkUserInput(this.props.inputKey, this.props.value);
    }

    componentWillReceiveProps(nextProps) {
        this.triggerCheck(true);
        this.triggerViolation(false);
        this.displayViolation(false);
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
                    query: USER_BY_USERNAME,
                    variables: {
                        username: inputValue
                    }
                }).then(response => {
                    switch (response.loading) {
                        case false:
                            if (response.data.user === null || response.data.user[0] === null) {
                                this.triggerViolation(false);
                                this.displayViolation(false);
                            } else if (response.data.user[0].username === inputValue) {
                                this.triggerViolation(true);
                                this.displayViolation(true);
                            } else {
                                this.triggerViolation(false);
                                this.displayViolation(false);
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
                    query: USER_BY_EMAIL,
                    variables: {
                        email: inputValue
                    }
                }).then(response => {
                    switch (response.loading) {
                        case false:
                            if (response.data.user === null || response.data.user[0] === null) {
                                this.triggerViolation(false);
                                this.displayViolation(false);
                            } else if (response.data.user[0].email === inputValue) {
                                this.triggerViolation(true);
                                this.displayViolation(true);
                            } else {
                                this.triggerViolation(false);
                                this.displayViolation(false);
                            }
                            break;
                        default:
                            this.triggerViolation(false);
                            break;
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
                    <p>The value { this.props.value } already exist !</p>
                </div>
            );
        } else if (this.props.value === "" || this.props.inputKey === "register_plainPassword") {
            return null;
        } else {
            return (
                <div>
                    <p>The value { this.props.value } is free !</p>
                </div>
            );
        }
    }
}

export default withApollo(RegisterCheck)
